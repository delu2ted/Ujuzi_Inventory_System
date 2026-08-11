<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        We've sent a 6-digit code to your email. Enter it below to verify your account.
    </div>

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.confirm') }}">
        @csrf
        <x-input-label for="otp_code" value="Verification Code" />
        <x-text-input id="otp_code" class="block mt-1 w-full" type="text" name="otp_code" maxlength="6" required autofocus />
        <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Resend code
                </button>
            </form>

            <x-primary-button>Verify</x-primary-button>
        </div>
    </form>
</x-guest-layout>