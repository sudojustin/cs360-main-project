<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $partner_email = ''; // Changed from partner_id to partner_email

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        if (!$user) {
            abort(redirect()->route('login'));
        }

        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        
        // Get partner's email if partner exists
        $this->partner_email = $user->partner ? $user->partner->email : ''; 
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'partner_email' => ['nullable', 'string', 'email', 'max:255', 'different:email'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle partner relationship by email
        $partnerEmail = $validated['partner_email'];
        $partnerId = null;
        
        if (!empty($partnerEmail)) {
            // Find user by email
            $partner = User::where('email', $partnerEmail)->first();
            
            if ($partner) {
                $partnerId = $partner->id;
            } else {
                $this->addError('partner_email', 'User with this email not found.');
                return;
            }
        }

        // Handle partner relationship updates
        if (($partnerId !== $user->partner_id) || ($partnerId === null && $user->partner_id !== null)) {
            // If there was a previous partner, remove the partnership
            if ($user->partner_id) {
                $previousPartner = User::find($user->partner_id);
                if ($previousPartner) {
                    $previousPartner->partner_id = null;
                    $previousPartner->save();
                }
            }

            // If there's a new partner, update both users
            if ($partnerId) {
                $newPartner = User::find($partnerId);
                if ($newPartner) {
                    // First update the new partner's partner_id
                    $newPartner->partner_id = $user->id;
                    $newPartner->save();
                    
                    // Then update the current user's partner_id
                    $user->partner_id = $partnerId;
                    $user->save();
                    
                    return; // Exit early since we've already saved both users
                }
            } else {
                // If no partner is selected, set partner_id to null
                $user->partner_id = null;
            }
        }

        // Save the user's information if no partner changes were made
        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information, email address, and partner.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

        <!-- Partner Email Field -->
        <div class="mt-4">
            <x-input-label for="partner_email" :value="__('Partner Email (Optional)')" />
            <x-text-input wire:model="partner_email" id="partner_email" name="partner_email" type="email" class="mt-1 block w-full" placeholder="Enter your partner's email" />
            <x-input-error class="mt-2" :messages="$errors->get('partner_email')" />
        </div>

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
