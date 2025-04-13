<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-gradient-to-br from-emerald-800 via-emerald-600 to-stone-700 flex justify-center items-center p-6">
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white opacity-5 rounded-full mix-blend-overlay animate-pulse"></div>
        <div class="absolute top-3/4 left-2/3 w-48 h-48 bg-white opacity-5 rounded-full mix-blend-overlay"></div>
        <div class="absolute top-1/2 right-1/4 w-72 h-72 bg-emerald-300 opacity-5 rounded-full mix-blend-overlay animate-pulse" style="animation-delay: 1s"></div>
        
        <!-- Decorative pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.2\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
    </div>

    <div class="w-full max-w-5xl">
        <!-- Card with diagonal design -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                <!-- Left content area -->
                <div class="lg:col-span-5 p-8 md:p-12 relative">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Welcome Back</h2>
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    
                    <form wire:submit="login" class="space-y-6">
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <x-text-input wire:model="form.email" id="email" class="block w-full pl-10 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg" type="email" name="email" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input wire:model="form.password" id="password" class="block w-full pl-10 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                            </div>
                            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <a class="text-sm text-emerald-600 hover:text-emerald-800 font-medium transition-colors duration-200" href="{{ route('register') }}" wire:navigate>
                                {{ __("Create an account") }}
                            </a>
                            
                            <x-primary-button class="ml-3 px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-800 hover:from-emerald-700 hover:to-emerald-900 border-0 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                                {{ __('Sign In') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
                
                <!-- Right decorative area -->
                <div class="hidden lg:block lg:col-span-7 bg-gradient-to-br from-emerald-600 to-emerald-800 relative">
                    <!-- Decorative circles -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mt-10 -mr-10"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-white opacity-10 rounded-full -mb-10 -ml-10"></div>
                    
                    <div class="h-full flex flex-col justify-center items-center p-12 text-white relative z-10">
                        <h3 class="text-3xl font-bold mb-4">BarterDB Exchange</h3>
                        <p class="mb-8 text-emerald-50 text-center text-lg max-w-md">Trade goods and services with trusted partners in our secure marketplace.</p>
                        
                        <!-- Decorative icons -->
                        <div class="grid grid-cols-2 gap-6 w-full max-w-lg">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-6 text-center transform transition-all hover:scale-105 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                                </svg>
                                <span class="text-lg font-medium">Fair Trading</span>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-6 text-center transform transition-all hover:scale-105 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-lg font-medium">Secure</span>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-6 text-center transform transition-all hover:scale-105 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                <span class="text-lg font-medium">Community</span>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-6 text-center transform transition-all hover:scale-105 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-lg font-medium">Global</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
