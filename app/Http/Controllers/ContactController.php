<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'type' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
        ]);

        $messageContent = $request->message;
        if ($request->company) {
            $messageContent = "Company: " . $request->company . "\n\n" . $messageContent;
        }

        // Save the message to database
        $contactMessage = \App\Models\ContactMessage::create([
            'type' => $request->type ?? 'contact',
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $messageContent,
        ]);

        // Notify staff by email (best-effort — never block the user if mail fails).
        try {
            $adminEmail = config('services.admin.notification_email');
            if ($adminEmail) {
                \Illuminate\Support\Facades\Mail::to($adminEmail)
                    ->send(new \App\Mail\ContactMessageReceived($contactMessage));
            }
        } catch (\Throwable $e) {
            \Log::error('Contact notification email failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}