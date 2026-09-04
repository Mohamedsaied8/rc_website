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

        @php
            $selectedProgram = null;
            $selectedCohort = null;
            
            if(request('program')) {
                $selectedProgram = \App\Models\Program::where('slug', request('program'))->first();
            }
            if(request('cohort')) {
                $selectedCohort = \App\Models\ProgramCohort::find(request('cohort'));
            }
            $fees = $selectedCohort ? $selectedCohort->fees : ($selectedProgram ? $selectedProgram->price : 0);
            $walletNumber = \App\Models\SiteSetting::get('mobile_wallet_number', config('services.manual_payment.wallet_number', '01156800621')) ?: '01156800621';
            $instapayAddress = \App\Models\SiteSetting::get('instapay_number', config('services.manual_payment.instapay_address', '01156800621')) ?: '01156800621';
            $rawWa = \App\Models\SiteSetting::get('whatsapp_number', '+201156800621');
            $waPhoneClean = preg_replace('/[^0-9]/', '', $rawWa);
        @endphp

        <form action="{{ route('enroll.store') }}" method="POST" enctype="multipart/form-data" 
              class="grid grid-cols-1 lg:grid-cols-12 gap-10"
              x-data="{
                  paymentMethod: '{{ old('payment_method', 'card') }}',
                  fileName: '',
                  filePreview: null,
                  copied: false,
                  copyNumber(num) {
                      navigator.clipboard.writeText(num);
                      this.copied = true;
                      setTimeout(() => this.copied = false, 2000);
                  },
                  handleFile(event) {
                      const file = event.target.files[0];
                      if (file) {
                          this.fileName = file.name;
                          if (file.type.startsWith('image/')) {
                              const reader = new FileReader();
                              reader.onload = (e) => { this.filePreview = e.target.result; };
                              reader.readAsDataURL(file);
                          } else {
                              this.filePreview = null;
                          }
                      } else {
                          this.fileName = '';
                          this.filePreview = null;
                      }
                  }
              }">
            @csrf
            <input type="hidden" name="program" value="{{ request('program') }}">
            <input type="hidden" name="cohort_id" value="{{ request('cohort') }}">

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
                <div class="bg-white border-2 border-slate-200 shadow-xl rounded-2xl p-6 md:p-8 sticky top-28 space-y-6">
                    
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight uppercase border-b border-slate-100 pb-4">
                        Your Order
                    </h2>
                    
                    @if($selectedProgram)
                        <!-- Order Product Details -->
                        <div class="space-y-3 border-b border-slate-100 pb-4">
                            <div class="flex justify-between items-start font-bold text-slate-900">
                                <span>{{ $selectedProgram->title }} × 1</span>
                                <span class="whitespace-nowrap">EGP {{ number_format($fees) }}</span>
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
                                <span class="font-bold text-slate-900">EGP {{ number_format($fees) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-base font-extrabold text-slate-900 pt-1">
                                <span>Total Due</span>
                                <span class="text-cyan-700 text-xl font-black">EGP {{ number_format($fees) }}</span>
                            </div>
                        </div>

                        <!-- 3 Payment Options -->
                        <div class="space-y-3 pt-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                                Select Payment Method
                            </label>

                            <!-- Option 1: Card Payment -->
                            <label class="relative flex items-start gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all"
                                   :class="paymentMethod === 'card' ? 'border-cyan-600 bg-cyan-50/40 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                <input type="radio" name="payment_method" value="card" x-model="paymentMethod" class="mt-1 w-4 h-4 text-cyan-600 focus:ring-cyan-500">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-900 text-sm">Pay by Card</span>
                                        <div class="flex items-center gap-1.5">
                                            <i class="fa-brands fa-cc-visa text-blue-800 text-xl"></i>
                                            <i class="fa-brands fa-cc-mastercard text-red-600 text-xl"></i>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">Instant checkout with Credit or Debit Card</p>
                                    <p class="text-[11px] text-slate-400 mt-1">
                                        <i class="fa-solid fa-lock text-emerald-500"></i> Secured by {{ config('services.payments.display_name', 'Kashier') }}
                                    </p>
                                </div>
                            </label>

                            <!-- Option 2: InstaPay / Mobile Wallet -->
                            <label class="relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all"
                                   :class="paymentMethod === 'instapay' ? 'border-cyan-600 bg-cyan-50/40 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                <div class="flex items-start gap-3">
                                    <input type="radio" name="payment_method" value="instapay" x-model="paymentMethod" class="mt-1 w-4 h-4 text-cyan-600 focus:ring-cyan-500">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-slate-900 text-sm">InstaPay / Mobile Wallet</span>
                                            <div class="flex items-center gap-1">
                                                <span class="px-2 py-0.5 text-[10px] font-extrabold bg-purple-100 text-purple-700 rounded-md border border-purple-200">InstaPay</span>
                                                <span class="px-2 py-0.5 text-[10px] font-extrabold bg-red-100 text-red-700 rounded-md border border-red-200">Vodafone Cash</span>
                                            </div>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1">Transfer money and upload proof of receipt</p>
                                    </div>
                                </div>

                                <!-- Expanded Details when InstaPay is chosen -->
                                <div x-show="paymentMethod === 'instapay'" x-cloak class="mt-4 pt-4 border-t border-slate-200 space-y-4" @click.stop>
                                    
                                    <!-- Transfer Destination Info Box -->
                                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white p-4 rounded-xl shadow-inner space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-semibold text-cyan-300 uppercase tracking-wider flex items-center gap-1.5">
                                                <i class="fa-solid fa-money-bill-transfer"></i> Transfer Account
                                            </span>
                                            <span class="text-xs bg-cyan-500/20 text-cyan-300 px-2 py-0.5 rounded font-mono font-bold">
                                                EGP {{ number_format($fees) }}
                                            </span>
                                        </div>

                                        <div class="space-y-2 text-xs">
                                            <div class="flex items-center justify-between bg-white/10 p-2.5 rounded-lg">
                                                <div>
                                                    <span class="text-slate-400 block text-[10px]">InstaPay Number:</span>
                                                    <span class="font-mono text-sm font-bold text-white tracking-wider">{{ $instapayAddress }}</span>
                                                </div>
                                                <button type="button" @click="copyNumber('{{ $instapayAddress }}')" class="px-3 py-1.5 bg-cyan-500 text-slate-900 hover:bg-cyan-400 rounded-md font-bold text-xs flex items-center gap-1 transition-all">
                                                    <i class="fa-solid fa-copy"></i>
                                                    <span>Copy</span>
                                                </button>
                                            </div>
                                            <div class="flex items-center justify-between bg-white/10 p-2.5 rounded-lg">
                                                <div>
                                                    <span class="text-slate-400 block text-[10px]">Mobile Wallet Number:</span>
                                                    <span class="font-mono text-sm font-bold text-white tracking-wider">{{ $walletNumber }}</span>
                                                </div>
                                                <button type="button" @click="copyNumber('{{ $walletNumber }}')" class="px-3 py-1.5 bg-cyan-500 text-slate-900 hover:bg-cyan-400 rounded-md font-bold text-xs flex items-center gap-1 transition-all">
                                                    <i class="fa-solid fa-copy"></i>
                                                    <span>Copy</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div x-show="copied" x-transition class="text-emerald-400 text-xs font-semibold text-center">
                                            <i class="fa-solid fa-check"></i> Copied to clipboard!
                                        </div>
                                    </div>

                                    <!-- Upload Proof Section -->
                                    <div class="space-y-2">
                                        <label class="block text-xs font-bold text-slate-700">
                                            Upload Proof of Payment <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative border-2 border-dashed border-slate-300 hover:border-cyan-500 rounded-xl p-4 text-center transition-colors bg-white">
                                            <input type="file" name="payment_screenshot" id="payment_screenshot" accept="image/jpeg,image/png,image/jpg,image/webp" 
                                                   @change="handleFile($event)"
                                                   :required="paymentMethod === 'instapay'"
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                            
                                            <template x-if="filePreview">
                                                <div class="space-y-2">
                                                    <img :src="filePreview" alt="Receipt preview" class="max-h-32 mx-auto rounded-lg border border-slate-200 shadow-sm object-contain">
                                                    <p class="text-xs font-semibold text-emerald-600 flex items-center justify-center gap-1">
                                                        <i class="fa-solid fa-check-circle"></i> <span x-text="fileName"></span>
                                                    </p>
                                                    <span class="text-[11px] text-slate-400 underline">Click to change image</span>
                                                </div>
                                            </template>

                                            <template x-if="!filePreview">
                                                <div class="space-y-1 py-2">
                                                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-400 mb-1"></i>
                                                    <p class="text-xs font-semibold text-slate-700">Click to upload transfer receipt / screenshot</p>
                                                    <p class="text-[10px] text-slate-400">PNG, JPG, or WEBP up to 4MB</p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Reference Number -->
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">
                                            Reference / Sender Phone Number <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="reference_number" value="{{ old('reference_number') }}" 
                                               :required="paymentMethod === 'instapay'"
                                               placeholder="e.g. 01156800621 or Transaction Ref ID" 
                                               class="w-full bg-white border border-slate-200 rounded-lg px-3.5 py-2 text-slate-900 text-sm focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500">
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="w-full py-4 px-6 bg-slate-900 text-white font-extrabold rounded-xl hover:bg-slate-800 hover:shadow-lg transition-all text-center uppercase tracking-wider text-sm mt-4 flex items-center justify-center gap-2 cursor-pointer">
                            <span x-show="paymentMethod === 'card'">PROCEED TO CARD PAYMENT</span>
                            <span x-show="paymentMethod === 'instapay'" x-cloak>SUBMIT PAYMENT FOR REVIEW</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>

                        <!-- Contact Sales (WhatsApp) - Option 3 -->
                        @php
                            $waMessage = 'Hello, I would like to purchase the "' . ($selectedProgram->title ?? '') . '"'
                                . ($selectedCohort ? ' (' . $selectedCohort->group_name . ')' : '')
                                . ' course through your sales team. Could you help me complete the payment?';
                            $waUrl = 'https://wa.me/' . ($waPhoneClean ?: '201156800621') . '?text=' . rawurlencode($waMessage);
                        @endphp
                        <div class="flex items-center gap-3 my-3">
                            <div class="flex-1 h-px bg-slate-200"></div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">or</span>
                            <div class="flex-1 h-px bg-slate-200"></div>
                        </div>
                        
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer"
                           class="w-full flex items-center justify-center gap-2 py-3.5 px-6 bg-emerald-600 text-white font-extrabold rounded-xl hover:bg-emerald-700 hover:shadow-lg transition-all text-center uppercase tracking-wider text-sm">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            Buy via Sales (WhatsApp)
                        </a>

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
