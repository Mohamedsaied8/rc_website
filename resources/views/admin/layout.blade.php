<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.gtm-head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Robotics Corner</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid #334155;
            margin-bottom: 2rem;
        }

        .sidebar-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2dd4bf;
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }

        .sidebar-nav a {
            display: block;
            padding: 0.75rem 2rem;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: #334155;
            color: #2dd4bf;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
        }

        .header {
            background: white;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 {
            color: #1e293b;
            font-weight: 600;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #2dd4bf;
            color: white;
        }

        .btn-primary:hover {
            background: #0891b2;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2dd4bf;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .table th {
            background: #f8fafc;
            font-weight: 600;
            color: #374151;
        }

        .table tr:hover {
            background: #f8fafc;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-completed {
            background: #dbeafe;
            color: #1e40af;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #2dd4bf;
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            min-height: 100px;
            resize: vertical;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #2dd4bf;
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }

        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: #2dd4bf;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    @include('partials.gtm-body')
    @if(!request()->routeIs('admin.login') && !request()->routeIs('admin.login.store') && Auth::guard('admin')->check())
        <div class="admin-container">
            <div class="sidebar">
                <div class="sidebar-header">
                    <h1>🤖 Admin Panel</h1>
                </div>
                <nav>
                    <ul class="sidebar-nav">
                        <li><a href="{{ route('admin.dashboard') }}"
                                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a></li>
                        <li><a href="{{ route('admin.courses.index') }}"
                                class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">📚 Courses</a></li>
                        <li><a href="{{ route('admin.programs.index') }}"
                                class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">🎯 Programs</a></li>
                        <li><a href="{{ route('admin.enrollments.index') }}"
                                class="{{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">📝 Enrollments</a>
                        </li>
                        <li><a href="{{ route('admin.blog.index') }}"
                                class="{{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">📰 Blog</a></li>
                        <li><a href="{{ route('admin.settings.index') }}"
                                class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">⚙️ Settings</a></li>
                        <li><a href="{{ route('admin.file-manager.index') }}"
                                class="{{ request()->routeIs('admin.file-manager.*') ? 'active' : '' }}">📁 File Manager</a>
                        </li>
                        <li><a href="{{ route('home') }}" target="_blank">🌐 View Site</a></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    style="width: 100%; text-align: left; background: none; border: none; color: #cbd5e1; padding: 0.75rem 2rem;">🚪
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="main-content">
                <div class="header">
                    <h2>@yield('page-title', 'Dashboard')</h2>
                    <div class="user-menu">
                        <span>Welcome, {{ Auth::guard('admin')->user()?->name ?? 'Admin' }}</span>
                    </div>
                </div>
    @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

            @if(!request()->routeIs('admin.login') && !request()->routeIs('admin.login.store') && Auth::guard('admin')->check())
                    </div>
                </div>
            @endif

    {{-- WhatsApp Floating Widget --}}
    <a href="https://wa.me/201111159633" target="_blank" rel="noopener noreferrer" class="whatsapp-float"
        aria-label="Chat on WhatsApp">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor"
                d="M16 0C7.164 0 0 7.164 0 16c0 2.829.737 5.484 2.028 7.785L0 32l8.382-2.003A15.927 15.927 0 0016 32c8.836 0 16-7.164 16-16S24.836 0 16 0zm0 29.467c-2.493 0-4.84-.679-6.847-1.86l-.491-.292-5.104 1.219 1.236-5.021-.32-.508A13.412 13.412 0 012.533 16c0-7.433 6.034-13.467 13.467-13.467S29.467 8.567 29.467 16 23.433 29.467 16 29.467z" />
            <path fill="currentColor"
                d="M23.401 19.188c-.384-.192-2.273-1.121-2.625-1.249-.352-.128-.608-.192-.864.192s-.992 1.249-1.216 1.505c-.224.256-.448.288-.832.096-.384-.192-1.621-.597-3.087-1.904-1.141-.965-1.912-2.157-2.136-2.541-.224-.384-.024-.592.168-.784.173-.173.384-.448.576-.672s.256-.384.384-.64c.128-.256.064-.48-.032-.672-.096-.192-.864-2.08-1.184-2.848-.312-.748-.628-.646-.864-.658-.224-.011-.48-.013-.736-.013s-.672.096-.992.48c-.32.384-1.216 1.121-1.216 2.737s1.216 3.177 1.408 3.433c.192.256 2.784 4.251 6.747 5.964.944.408 1.681.652 2.256.836.948.301 1.808.259 2.488.157.76-.113 2.273-.929 2.593-1.825.32-.896.32-1.664.224-1.825-.096-.173-.352-.277-.736-.469z" />
        </svg>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }

        .whatsapp-float svg {
            width: 32px;
            height: 32px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-float svg {
                width: 26px;
                height: 26px;
            }
        }

        /* Animation */
        @keyframes whatsapp-pulse {
            0% {
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            }

            50% {
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.7), 0 0 0 10px rgba(37, 211, 102, 0.2);
            }

            100% {
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            }
        }

        .whatsapp-float {
            animation: whatsapp-pulse 2s infinite;
        }
    </style>
</body>

</html>