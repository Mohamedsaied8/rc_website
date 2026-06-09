import os

file_path = r'C:\Users\alima\OneDrive\Desktop\rc_website\rc_website\resources\views\home.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

start_marker = '<div class="grid md:grid-cols-4 gap-6">'
end_marker = '</div>\n        </div>\n    </section>'

start_idx = content.find(start_marker)
end_idx = content.find(end_marker, start_idx)

if start_idx != -1 and end_idx != -1:
    new_services = '''<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- R&D -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-cyan-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('services.show', 'rnd') }}" class="absolute inset-0 z-20"><span class="sr-only">Research & Development</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.rnd_img', asset('images/rnd_service.png'), true) }}" data-cms-image="home.services.rnd_img" alt="R&D" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors">{{ cms('home.services.rnd_title', 'Research & Development') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.rnd_desc', 'Pioneering intelligent robotics solutions, from autonomous driving to advanced software platforms.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-cyan-600 group-hover:text-cyan-700 transition-colors">
                            {{ cms('home.services.rnd_link', 'Discover R&D') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div>

                <!-- Consultation -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-blue-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('services.index') }}" class="absolute inset-0 z-20"><span class="sr-only">Engineering Consultation</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.consultation_img', asset('images/consultation_service.png'), true) }}" data-cms-image="home.services.consultation_img" alt="Consultation" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">{{ cms('home.services.consultation_title', 'Engineering Consultation') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.consultation_desc', 'Expert guidance on system architecture, embedded systems, and robotic deployments.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-blue-600 group-hover:text-blue-700 transition-colors">
                            {{ cms('home.services.consultation_link', 'Learn more') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div>

                <!-- Training -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-emerald-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('programs.index') }}" class="absolute inset-0 z-20"><span class="sr-only">Professional Training</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.training_img', asset('images/training_service.png'), true) }}" data-cms-image="home.services.training_img" alt="Training" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors">{{ cms('home.services.training_title', 'Corporate Training') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.training_desc', 'Industry-leading educational programs bridging the gap between academia and real-world tech.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-emerald-600 group-hover:text-emerald-700 transition-colors">
                            {{ cms('home.services.training_link', 'View programs') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div>

                <!-- Outsourcing -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-purple-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('services.index') }}" class="absolute inset-0 z-20"><span class="sr-only">Outsourcing</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.outsourcing_img', asset('images/outsourcing_service.png'), true) }}" data-cms-image="home.services.outsourcing_img" alt="Outsourcing" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-purple-600 transition-colors">{{ cms('home.services.outsourcing_title', 'Outsourcing') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.outsourcing_desc', 'Dedicated teams of elite engineers ready to accelerate your project development cycle.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-purple-600 group-hover:text-purple-700 transition-colors">
                            {{ cms('home.services.outsourcing_link', 'Learn more') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div>'''
    content = content[:start_idx] + new_services + content[end_idx:]
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)
    print('Home page services reinvented successfully!')
else:
    print('Could not find marker')
