@extends('admin.layout')

@section('title', 'Logo & Favicon Manager')
@section('page-title', 'Brand Assets')
@section('page-subtitle', 'Manage your site\'s logo and favicon.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    
    <!-- Logo Upload -->
    <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-bl-full -z-10"></div>
        
        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
            <i class="fa-solid fa-image text-cyan-400"></i> Primary Logo
        </h3>

        <div class="mb-8 flex flex-col items-center justify-center p-8 border-2 border-dashed border-white/10 rounded-xl bg-white/[0.01]">
            @if($logoExists && $logoUrl)
                <div class="relative group/img">
                    <img src="{{ $logoUrl }}" alt="Current Logo" class="max-w-[200px] max-h-[100px] object-contain drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">
                    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center rounded-lg">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Active Logo</span>
                    </div>
                </div>
            @else
                <div class="text-slate-500 flex flex-col items-center gap-2">
                    <i class="fa-regular fa-image text-4xl mb-2 opacity-50"></i>
                    <p class="text-sm">No logo uploaded yet</p>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('admin.file-manager.upload') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="type" value="logo">
            
            <div class="relative">
                <input type="file" name="file" id="logo-file" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                    onchange="document.getElementById('logo-file-name').textContent = this.files[0].name">
                <div class="w-full py-3 px-4 bg-slate-900/50 border border-white/10 rounded-xl text-slate-400 text-sm flex items-center justify-between group-hover:border-cyan-500/50 transition-colors">
                    <span id="logo-file-name">Choose new logo file...</span>
                    <i class="fa-solid fa-cloud-arrow-up text-cyan-400"></i>
                </div>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold rounded-xl hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-upload"></i> Upload Logo
            </button>
        </form>

        @if($logoExists)
        <form method="POST" action="{{ route('admin.file-manager.delete') }}" class="mt-4">
            @csrf
            <input type="hidden" name="type" value="logo">
            <button type="submit" onclick="return confirm('Are you sure you want to delete the logo? The default text will be shown instead.')" 
                class="w-full py-3 px-4 bg-red-500/10 text-red-400 font-bold rounded-xl border border-red-500/20 hover:bg-red-500/20 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-trash-can"></i> Delete Logo
            </button>
        </form>
        @endif
        
        <p class="text-slate-500 text-xs text-center mt-4">Supported formats: PNG, JPG, SVG (Max 2MB)</p>
    </div>

    <!-- Favicon Upload -->
    <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 shadow-xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-bl-full -z-10"></div>
        
        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
            <i class="fa-solid fa-icons text-purple-400"></i> Browser Favicon
        </h3>

        <div class="mb-8 flex flex-col items-center justify-center p-8 border-2 border-dashed border-white/10 rounded-xl bg-white/[0.01]">
            @if($faviconExists && $faviconUrl)
                <div class="relative group/img">
                    <div class="w-16 h-16 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center p-2">
                        <img src="{{ $faviconUrl }}" alt="Current Favicon" class="max-w-[48px] max-h-[48px] object-contain">
                    </div>
                </div>
            @else
                <div class="text-slate-500 flex flex-col items-center gap-2">
                    <i class="fa-solid fa-globe text-4xl mb-2 opacity-50"></i>
                    <p class="text-sm">No favicon uploaded</p>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('admin.file-manager.upload') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="type" value="favicon">
            
            <div class="relative">
                <input type="file" name="file" id="favicon-file" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                    onchange="document.getElementById('favicon-file-name').textContent = this.files[0].name">
                <div class="w-full py-3 px-4 bg-slate-900/50 border border-white/10 rounded-xl text-slate-400 text-sm flex items-center justify-between group-hover:border-purple-500/50 transition-colors">
                    <span id="favicon-file-name">Choose new favicon...</span>
                    <i class="fa-solid fa-cloud-arrow-up text-purple-400"></i>
                </div>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-purple-400 to-indigo-400 text-slate-900 font-bold rounded-xl hover:shadow-[0_0_20px_rgba(168,85,247,0.4)] hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-upload"></i> Upload Favicon
            </button>
        </form>

        @if($faviconExists)
        <form method="POST" action="{{ route('admin.file-manager.delete') }}" class="mt-4">
            @csrf
            <input type="hidden" name="type" value="favicon">
            <button type="submit" onclick="return confirm('Are you sure you want to delete the favicon?')" 
                class="w-full py-3 px-4 bg-red-500/10 text-red-400 font-bold rounded-xl border border-red-500/20 hover:bg-red-500/20 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-trash-can"></i> Delete Favicon
            </button>
        </form>
        @endif
        
        <p class="text-slate-500 text-xs text-center mt-4">Supported formats: ICO, PNG (Max 2MB)</p>
    </div>

</div>

<!-- System Info -->
<div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 shadow-xl">
    <h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
        <i class="fa-solid fa-server text-slate-400"></i> File Storage Info
    </h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5">
            <strong class="block text-sm text-slate-300 mb-2">Logo Lookups:</strong>
            <ul class="text-xs text-slate-500 font-mono space-y-1">
                <li><i class="fa-solid fa-angle-right text-cyan-500 mr-2"></i>public/images/logo.png</li>
                <li><i class="fa-solid fa-angle-right text-cyan-500 mr-2"></i>public/images/logo.jpg</li>
                <li><i class="fa-solid fa-angle-right text-cyan-500 mr-2"></i>public/images/logo.svg</li>
            </ul>
        </div>
        <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5">
            <strong class="block text-sm text-slate-300 mb-2">Favicon Lookups:</strong>
            <ul class="text-xs text-slate-500 font-mono space-y-1">
                <li><i class="fa-solid fa-angle-right text-purple-500 mr-2"></i>public/favicon.ico</li>
                <li><i class="fa-solid fa-angle-right text-purple-500 mr-2"></i>public/favicon.png</li>
            </ul>
        </div>
    </div>
</div>

@endsection
