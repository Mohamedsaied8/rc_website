@extends('components.layout')

@section('title', 'Checkout - Robotics Corner')

@section('content')
<div class="min-h-screen pt-28 pb-20 bg-slate-50 text-slate-800 font-sans selection:bg-cyan-500/30">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Breadcrumb / Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">
                Checkout Details
            </h1>
            <p class="text-sm font-medium text-slate-500 uppercase tracking-widest">
                Complete your information to secure your spot
            </p>
        </div>

        @if(session('success'))
            <div class="mb-8 p-6 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-center shadow-sm max-w-4xl mx-auto">
                <svg class="w-12 h-12 mx-auto mb-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-xl font-bold mb-2">Enrollment Successful!</h3>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 p-6 bg-red-50 border border-red-200 rounded-2xl text-red-700 shadow-sm max-w-4xl mx-auto">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Have a Coupon Section -->
        <div class="mb-8 max-w-7xl">
            <p class="text-sm font-medium text-slate-600 mb-2">Have a coupon?</p>
            <div class="border-2 border-dashed border-red-500/40 rounded-xl p-4 bg-white/50 backdrop-blur-sm">
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <input type="text" id="coupon_code" name="coupon_code" placeholder="Coupon code" class="flex-1 w-full bg-white border border-slate-300 rounded-lg px-4 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500">
                    <button type="button" onclick="alert('Coupon feature is ready to be connected!')" class="w-full sm:w-auto px-6 py-2.5 bg-red-700 hover:bg-red-800 text-white font-bold text-xs uppercase tracking-wider rounded-lg transition-colors shadow-sm whitespace-nowrap">
                        APPLY COUPON
                    </button>
                </div>
            </div>
        </div>

        <form action="{{ route('enroll.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            @csrf
            <input type="hidden" name="program" value="{{ request('program') }}">
            <input type="hidden" name="cohort_id" value="{{ request('cohort') }}">
            <input type="hidden" name="payment_method" value="paymob_card">

            <!-- Left Column: Billing Details (7 Columns) -->
            <div class="lg:col-span-7 space-y-6">
                
                <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 md:p-8 space-y-6">
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight uppercase border-b border-slate-100 pb-4">
                        Billing Details
                    </h2>
                    
                    <!-- Row 1: First Name, Second Name, Last Name -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">First name <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->name ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Second name <span class="text-red-500">*</span></label>
                            <input type="text" name="second_name" value="{{ old('second_name') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Last name <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                        </div>
                    </div>

                    <!-- Row 2: Phone Number -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                    </div>

                    <!-- Row 3: Email Address -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="w-full bg-slate-100 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-500 text-sm cursor-not-allowed" readonly required>
                        <p class="text-xs text-slate-400 mt-1">Email cannot be modified.</p>
                    </div>

                    <!-- Row 4: State / City & Country -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">City / State <span class="text-red-500">*</span></label>
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="e.g. Cairo" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Country <span class="text-red-500">*</span></label>
                            <input type="text" name="country" value="{{ old('country', 'Egypt') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                        </div>
                    </div>

                    <!-- Row 5: Educational Level -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Educational Level <span class="text-red-500">*</span></label>
                        <select name="education_level" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                            <option value="" class="text-slate-400">Select Educational Level</option>
                            <option value="Undergraduate" {{ old('education_level') == 'Undergraduate' ? 'selected' : '' }}>Undergraduate (Student)</option>
                            <option value="Graduate" {{ old('education_level') == 'Graduate' ? 'selected' : '' }}>Graduate (Bachelor's)</option>
                            <option value="Postgraduate" {{ old('education_level') == 'Postgraduate' ? 'selected' : '' }}>Postgraduate (Master's/PhD)</option>
                        </select>
                    </div>

                    <!-- Row 6: University & College -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">University <span class="text-red-500">*</span></label>
                            <input type="text" name="university" value="{{ old('university') }}" placeholder="e.g. Cairo University" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">College / Faculty <span class="text-red-500">*</span></label>
                            <input type="text" name="college" value="{{ old('college') }}" placeholder="e.g. Engineering" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                        </div>
                    </div>

                    <!-- Row 7: Graduation Year -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Graduation Year <span class="text-red-500">*</span></label>
                        <input type="text" name="graduation_year" value="{{ old('graduation_year') }}" placeholder="YYYY" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                    </div>

                    <!-- Row 8: Technical Experience -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Technical Experience</label>
                        <textarea name="experience" rows="2" placeholder="Briefly describe any relevant background or skills" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors">{{ old('experience') }}</textarea>
                    </div>

                    <!-- Row 9: Motivation -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Motivation</label>
                        <textarea name="motivation" rows="2" placeholder="Why do you want to join this program?" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2.5 text-slate-900 text-sm focus:border-cyan-500 focus:bg-white focus:ring-1 focus:ring-cyan-500 transition-colors">{{ old('motivation') }}</textarea>
                    </div>
                </div>

            </div>

            <!-- Right Column: Your Order (5 Columns) -->
            <div class="lg:col-span-5">
                <div class="bg-white border-2 border-red-500/20 shadow-lg rounded-2xl p-6 md:p-8 sticky top-28 space-y-6">
                    
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight uppercase border-b border-slate-100 pb-4">
                        Your Order
                    </h2>
                    
                    @php
                        $selectedProgram = null;
                        $selectedCohort = null;
                        
                        if(request('program')) {
                            $selectedProgram = \App\Models\Program::where('slug', request('program'))->first();
                        }
                        if(request('cohort')) {
                            $selectedCohort = \App\Models\ProgramCohort::find(request('cohort'));
                        }
                    @endphp
                    
                    @if($selectedProgram)
                        <!-- Order Product Details -->
                        <div class="space-y-3 border-b border-slate-100 pb-4">
                            <div class="flex justify-between items-start font-bold text-slate-900">
                                <span>{{ $selectedProgram->title }} × 1</span>
                                <span class="whitespace-nowrap">EGP {{ number_format($selectedCohort ? $selectedCohort->fees : $selectedProgram->price) }}</span>
                            </div>
                            
                            @if($selectedCohort)
                                <div class="text-xs text-slate-500 space-y-1 bg-slate-50 p-3 rounded-lg border border-slate-100">
                                    <p><strong class="text-slate-700">Group Name:</strong> {{ $selectedCohort->group_name }}</p>
                                    <p><strong class="text-slate-700">Start Date:</strong> {{ \Carbon\Carbon::parse($selectedCohort->start_date)->format('M d, Y') }}</p>
                                    <p><strong class="text-slate-700">Schedule:</strong> {{ $selectedCohort->schedule }}</p>
                                    <p><strong class="text-slate-700">Location:</strong> {{ $selectedCohort->location }}</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Totals -->
                        <div class="space-y-2 border-b border-slate-100 pb-4 text-sm font-semibold text-slate-700">
                            <div class="flex justify-between items-center">
                                <span>Subtotal</span>
                                <span class="font-bold text-slate-900">EGP {{ number_format($selectedCohort ? $selectedCohort->fees : $selectedProgram->price) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-base font-extrabold text-slate-900 pt-1">
                                <span>Total</span>
                                <span class="text-slate-900 text-lg">EGP {{ number_format($selectedCohort ? $selectedCohort->fees : $selectedProgram->price) }}</span>
                            </div>
                        </div>

                        <!-- Card Only Payment Section -->
                        <div class="space-y-3 pt-2">
                            <div class="flex items-center gap-3 p-3 bg-slate-50 border border-slate-200 rounded-xl">
                                <input type="radio" checked class="w-4 h-4 text-cyan-600 focus:ring-cyan-500">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-900 text-sm">Card</span>
                                        <div class="flex items-center gap-1">
                                            <i class="fa-brands fa-cc-visa text-blue-800 text-lg"></i>
                                            <i class="fa-brands fa-cc-mastercard text-red-600 text-lg"></i>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">Pay with your Credit or Debit Card</p>
                                </div>
                            </div>
                            <p class="text-[11px] text-slate-400 text-right">
                                <i class="fa-solid fa-lock text-emerald-500"></i> Secured by Paymob
                            </p>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="w-full py-4 px-6 bg-slate-900 text-white font-extrabold rounded-xl hover:bg-slate-800 hover:shadow-lg transition-all text-center uppercase tracking-wider text-sm mt-4">
                            PLACE ORDER
                        </button>

                    @else
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-800 text-sm">
                            Please select a program from the <a href="{{ route('programs.index') }}" class="underline font-bold">Programs</a> page first.
                        </div>
                    @endif

                    <p class="text-[11px] text-slate-400 text-center leading-relaxed">
                        Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
