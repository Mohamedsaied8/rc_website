<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::query();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search by name or email
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $enrollments = $query->latest()->paginate(15);
        
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function show(Enrollment $enrollment)
    {
        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function updateStatus(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $status = $request->status;
        $adminNotes = $request->admin_notes;

        $enrollment->status = $status;
        $enrollment->admin_notes = $adminNotes;

        if ($status === 'approved') {
            $enrollment->payment_status = 'paid';
            $enrollment->paid_at = $enrollment->paid_at ?? now();

            $enrollment->manualPayments()
                ->where('status', 'pending')
                ->update([
                    'status' => 'approved',
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now(),
                ]);
        } elseif ($status === 'rejected') {
            $enrollment->payment_status = 'failed';

            $enrollment->manualPayments()
                ->where('status', 'pending')
                ->update([
                    'status' => 'rejected',
                    'reject_reason' => $adminNotes,
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now(),
                ]);
        } elseif ($status === 'completed') {
            $enrollment->payment_status = 'paid';
            $enrollment->paid_at = $enrollment->paid_at ?? now();

            $enrollment->manualPayments()
                ->where('status', 'pending')
                ->update([
                    'status' => 'approved',
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now(),
                ]);
        } elseif ($status === 'pending') {
            $enrollment->payment_status = 'unpaid';

            $enrollment->manualPayments()
                ->update([
                    'status' => 'pending',
                ]);
        }

        $enrollment->save();

        return redirect()->route('admin.enrollments.show', $enrollment)
            ->with('success', 'Enrollment status updated successfully.');
    }
}
