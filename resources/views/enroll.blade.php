@extends('components.layout')

@section('title', 'Enroll - Robotics Corner')
@section('description', 'Enroll in our comprehensive robotics and software engineering programs.')

@section('content')
<section class="hero compact">
    <div class="container">
        <h1 class="section-title">Enroll in Our Programs</h1>
        <p class="section-subtitle">Start your journey to becoming a technical expert</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="enrollment-form" style="max-width: 800px; margin: 0 auto; background: #fff; padding: 2rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <!-- Progress Indicator -->
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span style="font-weight: 600; color: #374151;">Step <span id="current-step-number">1</span> of 5</span>
                    <span style="color: #64748b; font-size: 0.9rem;" id="progress-percentage">20%</span>
                </div>
                <div style="background: #e2e8f0; height: 8px; border-radius: 4px; overflow: hidden;">
                    <div id="progress-bar" style="background: #2dd4bf; height: 100%; width: 20%; transition: width 0.3s ease;"></div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('enroll.store') }}" id="enrollmentForm"  enctype="multipart/form-data">
                @csrf
                
                <!-- Step 1: Program Selection -->
                <div class="form-step active" id="step1">
                    <h2 style="margin-bottom: 1.5rem; color: #1e293b;">Step 1: Choose Your Program</h2>
                    <div class="program-selection" style="display: grid; gap: 1rem;">
                        @foreach($programs as $program)
                        <label class="program-option" style="display: flex; align-items: center; padding: 1rem; border: 2px solid #e2e8f0; border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                            <input type="radio" name="selected_program" value="{{ $program->title }}" {{ (old('selected_program') === $program->title || $selectedProgram === $program->slug) ? 'checked' : '' }} style="margin-right: 1rem;">
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                                    <span style="font-weight: 600; color: #1e293b;">{{ $program->title }}</span>
                                    <span style="color: #2dd4bf; font-weight: 600;">${{ number_format($program->price, 0) }}</span>
                                </div>
                                <p style="color: #64748b; margin: 0 0 0.5rem 0;">{{ $program->short_description }}</p>
                                <div style="display: flex; gap: 1rem; font-size: 0.9rem; color: #64748b;">
                                    <span>⏱️ {{ $program->duration }}</span>
                                    <span>📚 {{ $program->courses->count() }} courses</span>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    <button type="button" class="btn-primary" onclick="nextStep()" style="margin-top: 1.5rem;">Next Step</button>
                </div>
                
                <!-- Step 2: Personal Information -->
                <div class="form-step" id="step2">
                    <h2 style="margin-bottom: 1.5rem; color: #1e293b;">Step 2: Personal Information</h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label for="first_name" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">First Name *</label>
                            <input type="text" id="first_name" name="first_name" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('first_name') }}">
                            @error('first_name')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('last_name') }}">
                            @error('last_name')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label for="email" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Email *</label>
                            <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('email') }}">
                            @error('email')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="phone" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('phone') }}">
                            @error('phone')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label for="country" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Country *</label>
                            <input type="text" id="country" name="country" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('country') }}">
                            @error('country')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="city" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">City *</label>
                            <input type="text" id="city" name="city" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('city') }}">
                            @error('city')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label for="education_level" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Education Level *</label>
                        <select id="education_level" name="education_level" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                            <option value="">Select your education level</option>
                            <option value="high_school" {{ old('education_level') === 'high_school' ? 'selected' : '' }}>High School</option>
                            <option value="bachelor" {{ old('education_level') === 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                            <option value="master" {{ old('education_level') === 'master' ? 'selected' : '' }}>Master's Degree</option>
                            <option value="phd" {{ old('education_level') === 'phd' ? 'selected' : '' }}>PhD</option>
                            <option value="other" {{ old('education_level') === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('education_level')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button type="button" class="btn-secondary" onclick="prevStep()">Previous</button>
                        <button type="button" class="btn-primary" onclick="nextStep()">Next Step</button>
                    </div>
                </div>
                
                <!-- Step 3: Technical Assessment -->
                <div class="form-step" id="step3">
                    <h2 style="margin-bottom: 1.5rem; color: #1e293b;">Step 3: Technical Background</h2>
                    <div style="margin-bottom: 1rem;">
                        <label for="experience" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Technical Experience *</label>
                        <textarea id="experience" name="experience" rows="4" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;" placeholder="Describe your technical background, programming languages, projects, etc.">{{ old('experience') }}</textarea>
                        @error('experience')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label for="motivation" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Why do you want to join this program? *</label>
                        <textarea id="motivation" name="motivation" rows="4" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;" placeholder="Tell us about your goals and what you hope to achieve...">{{ old('motivation') }}</textarea>
                        @error('motivation')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button type="button" class="btn-secondary" onclick="prevStep()">Previous</button>
                        <button type="button" class="btn-primary" onclick="nextStep()">Next Step</button>
                    </div>
                </div>
                
                <!-- Step 4: Schedule & Additional Info -->
                <div class="form-step" id="step4">
                    <h2 style="margin-bottom: 1.5rem; color: #1e293b;">Step 4: Schedule & Additional Information</h2>
                    <div style="margin-bottom: 1rem;">
                        <label for="preferred_schedule" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Preferred Schedule *</label>
                        <select id="preferred_schedule" name="preferred_schedule" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                            <option value="">Select your preferred schedule</option>
                            <option value="weekdays" {{ old('preferred_schedule') === 'weekdays' ? 'selected' : '' }}>Weekdays (9 AM - 5 PM)</option>
                            <option value="evenings" {{ old('preferred_schedule') === 'evenings' ? 'selected' : '' }}>Evenings (6 PM - 9 PM)</option>
                            <option value="weekends" {{ old('preferred_schedule') === 'weekends' ? 'selected' : '' }}>Weekends</option>
                            <option value="flexible" {{ old('preferred_schedule') === 'flexible' ? 'selected' : '' }}>Flexible</option>
                        </select>
                        @error('preferred_schedule')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label for="additional_notes" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Additional Notes</label>
                        <textarea id="additional_notes" name="additional_notes" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;" placeholder="Any additional information or special requirements...">{{ old('additional_notes') }}</textarea>
                        @error('additional_notes')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button type="button" class="btn-secondary" onclick="prevStep()">Previous</button>
                        <button type="button" class="btn-primary" onclick="nextStep()">Next Step</button>
                    </div>
                </div>
                
                <!-- Step 5: Complete Your Enrollment -->
                <div class="form-step" id="step5">
                    <h2 style="margin-bottom: 1.5rem; color: #1e293b;">Complete Your Enrollment</h2>
                    <p style="color: #64748b; margin-bottom: 2rem;">Choose your preferred payment method to finalize your enrollment.</p>
                    
                    <!-- Selected Program Summary -->
                    <div id="program-summary" style="background: #f0fdfa; padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; border-left: 4px solid #2dd4bf;">
                        <h3 style="color: #065f46; margin-bottom: 1rem;">Selected Program:</h3>
                        <div id="program-details" style="color: #374151;">
                            <!-- Program details will be populated by JavaScript -->
                        </div>
                    </div>
                    
                    <!-- Payment Methods -->
                    <div style="margin-bottom: 2rem;">
                        <h3 style="color: #1e293b; margin-bottom: 1rem;">Choose Payment Method *</h3>
                        <div style="display: grid; gap: 1rem;">
                            <!-- InstaPay Option -->
                            <label class="payment-option" style="display: flex; align-items: center; padding: 1.5rem; border: 2px solid #e2e8f0; border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                                <input type="radio" name="payment_method" value="instapay" {{ old('payment_method') === 'instapay' ? 'checked' : '' }} style="margin-right: 1rem;">
                                <div style="flex: 1;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                        <span style="font-weight: 600; color: #1e293b;">Mobile Wallet / InstaPay</span>
                                        <span style="background: #2dd4bf; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">Recommended</span>
                                    </div>
                                    <p style="color: #64748b; margin: 0 0 0.5rem 0;">Pay instantly via mobile wallet or InstaPay</p>
                                    <div style="background: #f8fafc; padding: 0.75rem; border-radius: 8px; font-family: monospace; font-size: 0.9rem; color: #374151;">
                                        <strong>Number:</strong> 01111159633
                                    </div>
                                </div>
                            </label>
                            
                            <!-- Contact Sales Team Option -->
                            <label class="payment-option" style="display: flex; align-items: center; padding: 1.5rem; border: 2px solid #e2e8f0; border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                                <input type="radio" name="payment_method" value="contact_sales" {{ old('payment_method') === 'contact_sales' ? 'checked' : '' }} style="margin-right: 1rem;">
                                <div style="flex: 1;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                        <span style="font-weight: 600; color: #1e293b;">Contact Sales Team</span>
                                        <span style="background: #64748b; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">Personal</span>
                                    </div>
                                    <p style="color: #64748b; margin: 0 0 0.5rem 0;">Speak with our sales team for payment assistance</p>
                                    <div style="background: #f8fafc; padding: 0.75rem; border-radius: 8px; font-family: monospace; font-size: 0.9rem; color: #374151;">
                                        <strong>WhatsApp:</strong> +0201111159633
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('payment_method')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Payment Screenshot Upload (only for Mobile Wallet/InstaPay) -->
                    <div id="screenshot-upload" style="margin-bottom: 2rem; display: none;">
                        <h3 style="color: #1e293b; margin-bottom: 1rem;">Upload Payment Screenshot</h3>
                        <p style="color: #64748b; margin-bottom: 1rem;">Please upload a screenshot of your payment confirmation for Mobile Wallet or InstaPay.</p>
                        <div style="border: 2px dashed #d1d5db; border-radius: 8px; padding: 2rem; text-align: center; background: #f9fafb;">
                            <input type="file" id="payment_screenshot" name="payment_screenshot" accept="image/*" style="display: none;">
                            <label for="payment_screenshot" style="cursor: pointer; display: block;">
                                <div style="font-size: 2rem; margin-bottom: 1rem;">📷</div>
                                <div style="color: #374151; font-weight: 600; margin-bottom: 0.5rem;">Click to upload payment screenshot</div>
                                <div style="color: #64748b; font-size: 0.9rem;">PNG, JPG, or JPEG (Max 5MB)</div>
                            </label>
                        </div>
                        <div id="file-preview" style="margin-top: 1rem; display: none;">
                            <img id="preview-image" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 1px solid #d1d5db;">
                            <div style="margin-top: 0.5rem;">
                                <button type="button" onclick="removeFile()" style="background: #dc2626; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer;">Remove</button>
                            </div>
                        </div>
                        @error('payment_screenshot')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div style="display: flex; gap: 1rem;">
                        <button type="button" class="btn-secondary" onclick="prevStep()">← Back</button>
                        <button type="button" class="btn-primary" onclick="submitForm()" style="background: #2dd4bf; color: white; padding: 0.75rem 2rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">Complete Enrollment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
let currentStep = 1;
const totalSteps = 5;

function showStep(step) {
    // Hide all steps
    for (let i = 1; i <= totalSteps; i++) {
        document.getElementById(`step${i}`).style.display = 'none';
    }
    
    // Show current step
    document.getElementById(`step${step}`).style.display = 'block';
    
    // Update progress indicator
    const progressBar = document.getElementById('progress-bar');
    const currentStepNumber = document.getElementById('current-step-number');
    const progressPercentage = document.getElementById('progress-percentage');
    
    if (progressBar) {
        const percentage = (step / totalSteps) * 100;
        progressBar.style.width = `${percentage}%`;
        progressBar.style.background = '#2dd4bf'; // Reset to normal color
        currentStepNumber.textContent = step;
        progressPercentage.textContent = `${Math.round(percentage)}%`;
    }
}

function nextStep() {
    // Validate current step before proceeding
    if (!validateCurrentStep()) {
        // If validation fails, don't proceed to next step
        // Add visual feedback
        const nextButton = document.querySelector('button[onclick="nextStep()"]');
        if (nextButton) {
            nextButton.style.background = '#dc2626';
            nextButton.textContent = 'Please fix errors above';
            setTimeout(() => {
                nextButton.style.background = '';
                nextButton.textContent = 'Next Step';
            }, 2000);
        }
        return false;
    }
    
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
        
        // Store current step in session storage
        sessionStorage.setItem('enrollment_current_step', currentStep);
        
        // Update program details on step 5
        if (currentStep === 5) {
            // First restore program selection if needed
            restoreProgramSelection();
            updateProgramDetails();
        }
    }
    
    return true;
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        
        // Store current step in session storage
        sessionStorage.setItem('enrollment_current_step', currentStep);
    }
}

function validateCurrentStep() {
    const currentStepElement = document.getElementById(`step${currentStep}`);
    let isValid = true;
    let firstErrorField = null;
    
    // Clear previous error messages
    currentStepElement.querySelectorAll('.field-error').forEach(error => error.remove());
    
    // Special validation for Step 1 (program selection)
    if (currentStep === 1) {
        const selectedProgram = currentStepElement.querySelector('input[name="selected_program"]:checked');
        if (!selectedProgram) {
            // Add error message for program selection
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error';
            errorDiv.style.color = '#dc2626';
            errorDiv.style.fontSize = '0.875rem';
            errorDiv.style.marginTop = '1rem';
            errorDiv.style.fontWeight = '600';
            errorDiv.textContent = '⚠️ Please select a program to continue.';
            
            currentStepElement.appendChild(errorDiv);
            
            // Add visual feedback to program options
            document.querySelectorAll('.program-option').forEach(option => {
                option.style.borderColor = '#dc2626';
                option.style.backgroundColor = '#fef2f2';
            });
            
            isValid = false;
        } else {
            // Clear any previous error styling
            document.querySelectorAll('.program-option').forEach(option => {
                option.style.borderColor = '#e2e8f0';
                option.style.backgroundColor = '#fff';
            });
        }
        return isValid;
    }
    
    // Special validation for Step 5 (payment method)
    if (currentStep === 5) {
        const selectedPayment = currentStepElement.querySelector('input[name="payment_method"]:checked');
        if (!selectedPayment) {
            // Add error message for payment method
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error';
            errorDiv.style.color = '#dc2626';
            errorDiv.style.fontSize = '0.875rem';
            errorDiv.style.marginTop = '1rem';
            errorDiv.textContent = 'Please select a payment method to continue.';
            
            currentStepElement.appendChild(errorDiv);
            isValid = false;
        }
        return isValid;
    }
    
    // Regular validation for other steps
    const requiredFields = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
    
    for (let field of requiredFields) {
        const fieldContainer = field.closest('div');
        const fieldName = field.getAttribute('name') || field.getAttribute('id');
        const fieldLabel = fieldContainer.querySelector('label')?.textContent?.replace('*', '').trim() || fieldName;
        
        if (!field.value.trim()) {
            // Add error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error';
            errorDiv.style.color = '#dc2626';
            errorDiv.style.fontSize = '0.875rem';
            errorDiv.style.marginTop = '0.25rem';
            errorDiv.textContent = `${fieldLabel} is required.`;
            
            fieldContainer.appendChild(errorDiv);
            field.style.borderColor = '#dc2626';
            
            if (!firstErrorField) {
                firstErrorField = field;
            }
            isValid = false;
        } else {
            field.style.borderColor = '#d1d5db';
        }
    }
    
    // Additional validation for specific fields
    if (currentStep === 2) {
        // Validate email format
        const emailField = currentStepElement.querySelector('input[name="email"]');
        if (emailField && emailField.value.trim()) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailField.value.trim())) {
                const fieldContainer = emailField.closest('div');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'field-error';
                errorDiv.style.color = '#dc2626';
                errorDiv.style.fontSize = '0.875rem';
                errorDiv.style.marginTop = '0.25rem';
                errorDiv.textContent = 'Please enter a valid email address.';
                
                fieldContainer.appendChild(errorDiv);
                emailField.style.borderColor = '#dc2626';
                if (!firstErrorField) firstErrorField = emailField;
                isValid = false;
            }
        }
        
        // Validate phone format
        const phoneField = currentStepElement.querySelector('input[name="phone"]');
        if (phoneField && phoneField.value.trim()) {
            const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
            if (!phoneRegex.test(phoneField.value.replace(/[\s\-\(\)]/g, ''))) {
                const fieldContainer = phoneField.closest('div');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'field-error';
                errorDiv.style.color = '#dc2626';
                errorDiv.style.fontSize = '0.875rem';
                errorDiv.style.marginTop = '0.25rem';
                errorDiv.textContent = 'Please enter a valid phone number.';
                
                fieldContainer.appendChild(errorDiv);
                phoneField.style.borderColor = '#dc2626';
                if (!firstErrorField) firstErrorField = phoneField;
                isValid = false;
            }
        }
    }
    
    if (!isValid && firstErrorField) {
        firstErrorField.focus();
        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    
    return isValid;
}

function updateProgramDetails() {
    const selectedProgram = document.querySelector('input[name="selected_program"]:checked');
    const programDetails = document.getElementById('program-details');
    
    if (selectedProgram) {
        const programTitle = selectedProgram.value;
        
        // Get program data from the page
        const programs = @json($programs);
        console.log('Available programs:', programs);
        console.log('Selected program title:', programTitle);
        
        const program = programs.find(p => p.title === programTitle);
        console.log('Found program:', program);
        
        if (program) {
            programDetails.innerHTML = `
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <strong>Program:</strong> ${program.title}
                    </div>
                    <div>
                        <strong>Total Price:</strong> $${parseInt(program.price).toLocaleString()}
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <strong>Duration:</strong> ${program.duration}
                    </div>
                    <div>
                        <strong>Next Start:</strong> Jan 8, 2025
                    </div>
                </div>
            `;
        } else {
            // Fallback if program not found
            programDetails.innerHTML = `
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <strong>Program:</strong> ${programTitle}
                    </div>
                    <div>
                        <strong>Status:</strong> Selected
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <strong>Next Start:</strong> Jan 8, 2025
                    </div>
                    <div>
                        <strong>Format:</strong> Online
                    </div>
                </div>
            `;
        }
    } else {
        // No program selected
        programDetails.innerHTML = `
            <div style="color: #dc2626; font-weight: 600;">
                ⚠️ No program selected. Please go back to Step 1 to select a program.
            </div>
        `;
    }
}

function submitForm() {
    // First check if a program is selected
    const selectedProgram = document.querySelector('input[name="selected_program"]:checked');
    if (!selectedProgram) {
        alert('Please select a program first. Go back to Step 1 to choose your program.');
        return;
    }
    
    // Validate the current step (step 5) before submitting
    if (validateCurrentStep()) {
        // Clear session storage before submitting
        sessionStorage.removeItem('enrollment_current_step');
        
        // Submit the form
        document.getElementById('enrollmentForm').submit();
    }
}

// Function to determine which step has validation errors
function getStepWithErrors() {
    const errors = @json($errors->any());
    if (!errors) return null;
    
    const errorFields = @json($errors->keys());
    
    // Map field names to steps
    const step2Fields = ['first_name', 'last_name', 'email', 'phone', 'country', 'city', 'education_level'];
    const step3Fields = ['experience', 'motivation'];
    const step4Fields = ['preferred_schedule', 'additional_notes'];
    const step5Fields = ['payment_method'];
    
    // Check which step has errors
    if (errorFields.some(field => step2Fields.includes(field))) return 2;
    if (errorFields.some(field => step3Fields.includes(field))) return 3;
    if (errorFields.some(field => step4Fields.includes(field))) return 4;
    if (errorFields.some(field => step5Fields.includes(field))) return 5;
    
    return null;
}

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    // Check if we need to restore a specific step (from validation errors)
    const urlParams = new URLSearchParams(window.location.search);
    const currentStepParam = urlParams.get('step') || sessionStorage.getItem('enrollment_current_step');
    const hasValidationErrors = @json($errors->any());
    
    let stepToShow = 1;
    
    if (hasValidationErrors) {
        // Determine which step has errors
        const errorStep = getStepWithErrors();
        if (errorStep) {
            stepToShow = errorStep;
        } else if (currentStepParam) {
            stepToShow = parseInt(currentStepParam);
        }
    } else if (currentStepParam) {
        stepToShow = parseInt(currentStepParam);
    }
    
    currentStep = stepToShow;
    showStep(currentStep);
    
    // Add visual indicator for steps with errors
    if (hasValidationErrors) {
        const errorStep = getStepWithErrors();
        if (errorStep) {
            // Add error indicator to the progress bar
            const progressBar = document.getElementById('progress-bar');
            if (progressBar) {
                progressBar.style.background = '#dc2626'; // Red color for error
            }
        }
    }
    
    // Update program details if we're on step 5
    if (currentStep === 5) {
        // First restore program selection if needed
        restoreProgramSelection();
        updateProgramDetails();
    }
    
    // Restore program selection if there are validation errors
    if (hasValidationErrors) {
        restoreProgramSelection();
    }
    
    // Add event listeners for program selection
    document.querySelectorAll('input[name="selected_program"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.program-option').forEach(option => {
                option.style.borderColor = '#e2e8f0';
                option.style.backgroundColor = '#fff';
            });
            
            if (this.checked) {
                this.closest('.program-option').style.borderColor = '#2dd4bf';
                this.closest('.program-option').style.backgroundColor = '#f0fdfa';
            }
        });
    });
    
    // Add event listeners for payment option selection
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-option').forEach(option => {
                option.style.borderColor = '#e2e8f0';
                option.style.backgroundColor = '#fff';
            });
            
            if (this.checked) {
                this.closest('.payment-option').style.borderColor = '#2dd4bf';
                this.closest('.payment-option').style.backgroundColor = '#f0fdfa';
            }
            
            // Show/hide screenshot upload based on payment method
            const screenshotUpload = document.getElementById('screenshot-upload');
            if (this.value === 'instapay') {
                screenshotUpload.style.display = 'block';
            } else {
                screenshotUpload.style.display = 'none';
            }
        });
    });
    
    // File upload functionality
    const fileInput = document.getElementById('payment_screenshot');
    const filePreview = document.getElementById('file-preview');
    const previewImage = document.getElementById('preview-image');
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                this.value = '';
                return;
            }
            
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                this.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                filePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Remove file function
    window.removeFile = function() {
        fileInput.value = '';
        filePreview.style.display = 'none';
    };
    
    // Add real-time validation for form fields
    const form = document.getElementById('enrollmentForm');
    const inputs = form.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
        // Clear errors on input
        input.addEventListener('input', function() {
            clearFieldError(this);
            this.style.borderColor = '#d1d5db';
        });
        
        // Validate on blur
        input.addEventListener('blur', function() {
            validateField(this);
        });
    });
});

function clearFieldError(field) {
    const fieldContainer = field.closest('div');
    const existingError = fieldContainer.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

function validateField(field) {
    const fieldContainer = field.closest('div');
    const fieldName = field.getAttribute('name') || field.getAttribute('id');
    const fieldLabel = fieldContainer.querySelector('label')?.textContent?.replace('*', '').trim() || fieldName;
    
    // Clear previous error
    clearFieldError(field);
    
    // Check if field is required and empty
    if (field.hasAttribute('required') && !field.value.trim()) {
        showFieldError(field, fieldLabel + ' is required.');
        return false;
    }
    
    // Additional validations
    if (fieldName === 'email' && field.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value.trim())) {
            showFieldError(field, 'Please enter a valid email address.');
            return false;
        }
    }
    
    if (fieldName === 'phone' && field.value.trim()) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        if (!phoneRegex.test(field.value.replace(/[\s\-\(\)]/g, ''))) {
            showFieldError(field, 'Please enter a valid phone number.');
            return false;
        }
    }
    
    if (fieldName === 'first_name' && field.value.trim() && field.value.trim().length < 2) {
        showFieldError(field, 'First name must be at least 2 characters.');
        return false;
    }
    
    if (fieldName === 'last_name' && field.value.trim() && field.value.trim().length < 2) {
        showFieldError(field, 'Last name must be at least 2 characters.');
        return false;
    }
    
    if (fieldName === 'experience' && field.value.trim() && field.value.trim().length < 10) {
        showFieldError(field, 'Please provide at least 10 characters describing your experience.');
        return false;
    }
    
    if (fieldName === 'motivation' && field.value.trim() && field.value.trim().length < 10) {
        showFieldError(field, 'Please provide at least 10 characters describing your motivation.');
        return false;
    }
    
    return true;
}

function showFieldError(field, message) {
    const fieldContainer = field.closest('div');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.color = '#dc2626';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    errorDiv.textContent = message;
    
    fieldContainer.appendChild(errorDiv);
    field.style.borderColor = '#dc2626';
}

function restoreProgramSelection() {
    // Get the old selected program from the form
    const oldSelectedProgram = @json(old('selected_program'));
    console.log('Restoring program selection:', oldSelectedProgram);
    
    if (oldSelectedProgram) {
        // Find the radio button with the matching value
        const programRadio = document.querySelector(`input[name="selected_program"][value="${oldSelectedProgram}"]`);
        console.log('Found program radio:', programRadio);
        
        if (programRadio) {
            programRadio.checked = true;
            
            // Update visual styling
            document.querySelectorAll('.program-option').forEach(option => {
                option.style.borderColor = '#e2e8f0';
                option.style.backgroundColor = '#fff';
            });
            
            programRadio.closest('.program-option').style.borderColor = '#2dd4bf';
            programRadio.closest('.program-option').style.backgroundColor = '#f0fdfa';
            
            console.log('Program selection restored:', oldSelectedProgram);
        } else {
            console.log('Program radio not found for:', oldSelectedProgram);
        }
    } else {
        console.log('No old selected program found');
    }
}
</script>

<style>
.form-step {
    display: none;
}

.form-step.active {
    display: block;
}

.program-option:hover {
    border-color: #2dd4bf !important;
    background-color: #f0fdfa !important;
}

body.dark .enrollment-form {
    background: #0f172a !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2) !important;
}

body.dark .enrollment-form h2 {
    color: #e2e8f0 !important;
}

body.dark .enrollment-form label {
    color: #cbd5e1 !important;
}

body.dark .enrollment-form input,
body.dark .enrollment-form select,
body.dark .enrollment-form textarea {
    background: #1e293b !important;
    border-color: #334155 !important;
    color: #e2e8f0 !important;
}

body.dark .program-option {
    background: #0f172a !important;
    border-color: #1e293b !important;
}

body.dark .program-option span {
    color: #e2e8f0 !important;
}

body.dark .program-option:hover {
    border-color: #2dd4bf !important;
    background-color: #0f172a !important;
}

/* Progress indicator dark mode */
body.dark .enrollment-form .progress-indicator {
    color: #e2e8f0 !important;
}

body.dark .enrollment-form .progress-indicator span {
    color: #cbd5e1 !important;
}

/* Error styling */
.field-error {
    color: #dc2626 !important;
    font-size: 0.875rem !important;
    margin-top: 0.25rem !important;
    display: block;
}

input.error, select.error, textarea.error {
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important;
}

/* Success styling */
input.success, select.success, textarea.success {
    border-color: #10b981 !important;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
}

/* Payment option styling */
.payment-option:hover {
    border-color: #2dd4bf !important;
    background-color: #f0fdfa !important;
}

body.dark .payment-option {
    background: #0f172a !important;
    border-color: #1e293b !important;
}

body.dark .payment-option span {
    color: #e2e8f0 !important;
}

body.dark .payment-option p {
    color: #cbd5e1 !important;
}

body.dark .payment-option:hover {
    border-color: #2dd4bf !important;
    background-color: #0f172a !important;
}
</style>
@endsection
