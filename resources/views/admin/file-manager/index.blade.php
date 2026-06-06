@extends('admin.layout')

@section('title', 'Logo & Favicon Manager')
@section('page-title', 'Logo & Favicon Manager')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0; color: #1e293b;">Upload Logo & Favicon</h2>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Upload Forms -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <!-- Logo Upload -->
        <div style="border: 2px dashed #d1d5db; border-radius: 12px; padding: 2rem; text-align: center; background: #f9fafb;">
            <h3 style="color: #1e293b; margin-bottom: 1rem;">Upload Logo</h3>
            @if($logoExists && $logoUrl)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ $logoUrl }}" alt="Current Logo" style="max-width: 200px; max-height: 100px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">Current Logo</p>
                </div>
            @else
                <div style="margin-bottom: 1rem; padding: 2rem; background: #f3f4f6; border-radius: 8px;">
                    <p style="color: #6b7280; font-size: 0.875rem;">No logo uploaded yet</p>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.file-manager.upload') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="logo">
                <input type="file" name="file" accept="image/*" required style="margin-bottom: 1rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Upload Logo</button>
            </form>
            @if($logoExists)
            <form method="POST" action="{{ route('admin.file-manager.delete') }}" style="margin-top: 0.5rem;">
                @csrf
                <input type="hidden" name="type" value="logo">
                <button type="submit" onclick="return confirm('Are you sure you want to delete the logo?')" 
                        style="background: #dc2626; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem; width: 100%;">
                    Delete Logo
                </button>
            </form>
            @endif
            <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">PNG, JPG, SVG (Max 2MB)</p>
        </div>

        <!-- Favicon Upload -->
        <div style="border: 2px dashed #d1d5db; border-radius: 12px; padding: 2rem; text-align: center; background: #f9fafb;">
            <h3 style="color: #1e293b; margin-bottom: 1rem;">Upload Favicon</h3>
            @if($faviconExists && $faviconUrl)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ $faviconUrl }}" alt="Current Favicon" style="max-width: 64px; max-height: 64px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">Current Favicon</p>
                </div>
            @else
                <div style="margin-bottom: 1rem; padding: 2rem; background: #f3f4f6; border-radius: 8px;">
                    <p style="color: #6b7280; font-size: 0.875rem;">No favicon uploaded yet</p>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.file-manager.upload') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="favicon">
                <input type="file" name="file" accept="image/*" required style="margin-bottom: 1rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Upload Favicon</button>
            </form>
            @if($faviconExists)
            <form method="POST" action="{{ route('admin.file-manager.delete') }}" style="margin-top: 0.5rem;">
                @csrf
                <input type="hidden" name="type" value="favicon">
                <button type="submit" onclick="return confirm('Are you sure you want to delete the favicon?')" 
                        style="background: #dc2626; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem; width: 100%;">
                    Delete Favicon
                </button>
            </form>
            @endif
            <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">ICO, PNG (Max 2MB)</p>
        </div>
    </div>

    <!-- File Information -->
    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 8px; border-left: 4px solid #3b82f6;">
        <h4 style="color: #1e293b; margin-bottom: 1rem;">File Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.875rem;">
            <div>
                <strong>Logo Files:</strong><br>
                <code>/images/logo.png</code><br>
                <code>/images/logo.jpg</code><br>
                <code>/images/logo.svg</code>
            </div>
            <div>
                <strong>Favicon Files:</strong><br>
                <code>/favicon.ico</code><br>
                <code>/favicon.png</code>
            </div>
        </div>
        <p style="margin-top: 1rem; color: #64748b; font-size: 0.875rem;">
            Files are stored directly in the <code>public/images/</code> and <code>public/</code> directories and accessible via direct URLs.
        </p>
    </div>
</div>
@endsection
