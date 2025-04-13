<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-gradient-to-br from-stone-800 via-emerald-700 to-emerald-500 flex justify-center items-center p-6">
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Floating shapes -->
        <div class="absolute top-5 left-1/4 w-32 h-32 bg-emerald-300 opacity-10 rounded-xl rotate-12 animate-float"></div>
        <div class="absolute bottom-10 right-1/4 w-40 h-40 bg-stone-300 opacity-10 rounded-xl -rotate-12 animate-float-delay"></div>
        <div class="absolute top-1/3 right-1/3 w-24 h-24 bg-white opacity-5 rounded-full animate-pulse"></div>
        
        <!-- Decorative pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z\' fill=\'%23ffffff\' fill-opacity=\'0.25\' fill-rule=\'evenodd\'/%3E%3C/svg%3E');"></div>
        </div>
    </div>

    <div class="w-full max-w-6xl">
        <!-- Main card with split design -->
        <div class="bg-white rounded-xl overflow-hidden shadow-2xl mx-auto">
            <div class="md:flex">
                <!-- Left side - promotional content -->
                <div class="relative md:w-5/12 bg-gradient-to-br from-emerald-600 to-emerald-800 p-8 md:p-12 text-white flex flex-col justify-center">
                    <!-- Decorative circles -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mt-10 -mr-10"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-white opacity-10 rounded-full -mb-10 -ml-10"></div>
                    
                    <h2 class="text-3xl font-bold mb-6 relative">Join Our Barter Community</h2>
                    <p class="mb-8 text-emerald-50 text-lg">Connect with trusted partners and exchange goods and services in our secure marketplace.</p>
                    
                    <div class="space-y-6 relative">
                        <div class="flex items-center">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Secure Transactions</h3>
                                <p class="text-sm text-emerald-100">All exchanges are verified and secured</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Fair Value Exchange</h3>
                                <p class="text-sm text-emerald-100">Find the right match for your needs</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Community Trust</h3>
                                <p class="text-sm text-emerald-100">Join a network of verified members</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-8 border-t border-emerald-500 text-center hidden md:block">
                        <p class="text-sm text-emerald-100">Already have an account?</p>
                        <a href="{{ route('login') }}" class="mt-2 inline-block px-6 py-2 bg-white text-emerald-700 rounded-lg font-medium hover:bg-emerald-50 transition-colors duration-300 transform hover:scale-105" wire:navigate>
                            Sign In
                        </a>
                    </div>
                </div>
                
                <!-- Right side - form -->
                <div class="md:w-7/12 p-8 md:p-12">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">Create Your Account</h3>
                        <p class="text-gray-600">Enter your information to get started</p>
                    </div>
                    
                    <form wire:submit="register" class="space-y-5">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input wire:model="name" id="name" class="block w-full pl-10 rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" type="text" name="name" required autofocus autocomplete="name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <x-text-input wire:model="email" id="email" class="block w-full pl-10 rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" type="email" name="email" required autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input wire:model="password" id="password" class="block w-full pl-10 rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full pl-10 rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-8">
                            <x-primary-button class="w-full py-3 bg-gradient-to-r from-emerald-600 to-emerald-800 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1 hover:from-emerald-700 hover:to-emerald-900 flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Create Account') }}
                            </x-primary-button>
                        </div>
                        
                        <div class="mt-6 text-center text-sm text-gray-600 md:hidden">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-800 font-medium" wire:navigate>Sign In</a>
                        </div>
                    </form>
                    
                    <div class="mt-6 text-center text-sm text-gray-600 hidden md:block">
                        By creating an account, you agree to our
                        <a href="#" class="text-emerald-600 hover:text-emerald-800">Terms</a> and
                        <a href="#" class="text-emerald-600 hover:text-emerald-800">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(12deg); }
            50% { transform: translateY(-20px) rotate(12deg); }
            100% { transform: translateY(0px) rotate(12deg); }
        }
        @keyframes float-delay {
            0% { transform: translateY(0px) rotate(-12deg); }
            50% { transform: translateY(-15px) rotate(-12deg); }
            100% { transform: translateY(0px) rotate(-12deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delay {
            animation: float-delay 5s ease-in-out infinite;
            animation-delay: 1s;
        }
    </style>
</div>
