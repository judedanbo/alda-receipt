<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-40" />
            </a> --}}
        </x-slot>

        <!-- Validation Errors -->
        <h2 class="leading-6 text-2xl tracking-wider">Change Password</h2>
        <x-auth-validation-errors class="my-4" :errors="$errors" />

        <form method="POST" action="{{ route('save.password') }}">
            @csrf
            <!-- Current Password -->
            <div class="mt-8">
                <x-label for="current_password" :value="__('Current Password')" />

                <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required
                    autocomplete="current_password" autofocus />
            </div>
            <!-- Password -->

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button.primary class="ml-4">
                    {{ __('Submit') }}
                </x-button.primary>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
