@extends('admin.layout')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0; color: #1e293b;">Contact Information & Site Settings</h2>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <thead style="background: #f8fafc;">
                <tr>
                    <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">Setting</th>
                    <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">Value</th>
                    <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($settings as $setting)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 1rem; color: #1f2937; font-weight: 500;">
                        <div style="display: flex; flex-direction: column;">
                            <span style="font-weight: 600;">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</span>
                            @if($setting->description)
                                <small style="color: #6b7280; font-size: 0.875rem;">{{ $setting->description }}</small>
                            @endif
                        </div>
                    </td>
                    <td style="padding: 1rem; color: #6b7280; max-width: 300px; word-wrap: break-word;">
                        @if($setting->type === 'url')
                            <a href="{{ $setting->value }}" target="_blank" style="color: #2dd4bf; text-decoration: none;">{{ $setting->value }}</a>
                        @elseif($setting->type === 'email')
                            <a href="mailto:{{ $setting->value }}" style="color: #2dd4bf; text-decoration: none;">{{ $setting->value }}</a>
                        @elseif($setting->type === 'phone')
                            <a href="tel:{{ $setting->value }}" style="color: #2dd4bf; text-decoration: none;">{{ $setting->value }}</a>
                        @else
                            {{ $setting->value }}
                        @endif
                    </td>
                    <td style="padding: 1rem; text-align: center;">
                        <a href="{{ route('admin.settings.edit', $setting) }}" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding: 2rem; text-align: center; color: #6b7280;">
                        No settings found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
