<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end mt-4">
            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <!-- Login Button -->
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Divider -->
    <div class="mt-6 text-center text-gray-500">
        <span class="text-sm">{{ __('Or continue with') }}</span>
    </div>

    <!-- Google Login Button -->
    <div class="flex justify-center mt-4">
        <a href="{{ route('redirect.google') }}"
            class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10S2 17.514 2 12 6.486 2 12 2zm0 1.8C7.204 3.8 3.8 7.204 3.8 12c0 4.796 3.404 8.2 8.2 8.2 4.796 0 8.2-3.404 8.2-8.2 0-4.796-3.404-8.2-8.2-8.2zm-.206 5.056h.066c.404 0 .799.15 1.1.419.298.269.476.647.486 1.05v.011a1.53 1.53 0 0 1-1.126 1.53l-.123.024-.002.02c-.017.314-.046.63-.086.944-.057.444-.126.888-.204 1.33l-.024.134c-.2.984-.426 1.972-.68 2.96h.029a1.75 1.75 0 0 1 1.726 1.9h-.07c-.448-.001-.889-.109-1.3-.316-.448-.224-.816-.573-1.062-.996l-.018-.033c-.149-.269-.277-.553-.387-.844-.218-.599-.406-1.211-.566-1.826l-.025-.1a1.533 1.533 0 0 1-.256-.195c-.295-.269-.479-.646-.487-1.05v-.01c.008-.312.045-.618.107-.92l.017-.1a1.531 1.531 0 0 1 1.424-1.157zm.206 2.6a.665.665 0 0 0-.67.659v.007c.001.086.018.17.051.248.061.157.161.295.29.402.083.069.18.121.283.154.095.029.195.043.296.043a.655.655 0 0 0 .67-.66.62.62 0 0 0-.04-.229.659.659 0 0 0-.68-.624zm-1.99 6.13c.06.181.116.364.169.548.09.306.18.61.266.917.063.22.125.442.184.664.092.364.183.725.273 1.09.06.243.12.485.179.73.057.229.113.46.167.692z" />
            </svg>
            {{ __('Login with Google') }}
        </a>
    </div>
</x-guest-layout>
