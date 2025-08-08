<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <input
            wire:model="email"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="{{ __('Email Address') }}"
            class="border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-white dark:bg-neutral-900 text-black dark:text-white focus:outline-none focus:ring"
        >

        <input
            wire:model="password"
            type="password"
            required
            autocomplete="current-password"
            placeholder="{{ __('Password') }}"
            viewable
            class="border border-gray-300 dark:border-gray-700 rounded px-3 py-2 bg-white dark:bg-neutral-900 text-black dark:text-white focus:outline-none focus:ring"

        >

        @if (Route::has('password.request'))
            <a class="end-0 top-0 text-sm" href="{{ route('password.request') }}" wire:navigate>
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <!-- Remember me -->
        <div class="flex items-center gap-2">
            <input
                wire:model="remember"
                id="remember_me"
                type="checkbox"
            >
            <label for="remember_me" class="cursor-pointer select-none text-sm text-gray-600 dark:text-gray-400">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="flex items-center justify-end">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring w-full"
            >
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    @if(Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline" wire:navigate>
                {{ __('Don\'t have an account? Register') }}
            </a>
        </div>
    @endif
</div>
