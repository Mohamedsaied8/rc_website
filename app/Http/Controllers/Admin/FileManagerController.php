<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileManagerController extends Controller
{
    public function index()
    {
        // Check if logo and favicon files exist in public/images
        $logoExists = file_exists(public_path('images/logo.png')) || 
                     file_exists(public_path('images/logo.jpg')) || 
                     file_exists(public_path('images/logo.svg'));
        $faviconExists = file_exists(public_path('favicon.ico')) || 
                        file_exists(public_path('favicon.png'));
        
        // Get logo URL if exists
        $logoUrl = null;
        if (file_exists(public_path('images/logo.png'))) {
            $logoUrl = '/images/logo.png';
        } elseif (file_exists(public_path('images/logo.jpg'))) {
            $logoUrl = '/images/logo.jpg';
        } elseif (file_exists(public_path('images/logo.svg'))) {
            $logoUrl = '/images/logo.svg';
        }
        
        // Get favicon URL if exists
        $faviconUrl = null;
        if (file_exists(public_path('favicon.ico'))) {
            $faviconUrl = '/favicon.ico';
        } elseif (file_exists(public_path('favicon.png'))) {
            $faviconUrl = '/favicon.png';
        }
        
        return view('admin.file-manager.index', compact('logoUrl', 'faviconUrl', 'logoExists', 'faviconExists'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
            'type' => 'required|in:logo,favicon'
        ]);

        $file = $request->file('file');
        $type = $request->type;
        
        // Delete old files first
        if ($type === 'logo') {
            File::delete([
                public_path('images/logo.png'),
                public_path('images/logo.jpg'),
                public_path('images/logo.svg')
            ]);
        } else {
            File::delete([
                public_path('favicon.ico'),
                public_path('favicon.png')
            ]);
        }
        
        // Get file extension
        $extension = $file->getClientOriginalExtension();
        
        // Set filename and path based on type
        if ($type === 'logo') {
            $filename = 'logo.' . $extension;
            $destinationPath = public_path('images');
        } else {
            $filename = 'favicon.' . $extension;
            $destinationPath = public_path();
        }
        
        // Move file to public directory
        $file->move($destinationPath, $filename);

        return redirect()->back()->with('success', ucfirst($type) . ' uploaded successfully!');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'type' => 'required|in:logo,favicon'
        ]);

        $type = $request->type;
        
        if ($type === 'logo') {
            File::delete([
                public_path('images/logo.png'),
                public_path('images/logo.jpg'),
                public_path('images/logo.svg')
            ]);
        } else {
            File::delete([
                public_path('favicon.ico'),
                public_path('favicon.png')
            ]);
        }

        return redirect()->back()->with('success', ucfirst($type) . ' deleted successfully!');
    }
}
