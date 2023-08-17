<h3 class="card-title">Update Password</h3>
<p class="card-subtitle">Ensure your account is using a long. random password to stay secure</p>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('put')
    <div class="mb-4">
        <div class="form-label">Current Password</div>
        <input type="password" class="form-control {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}" id="current_password" name="current_password" autocomplete="current-password">

        @if($errors->updatePassword->has('current_password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->updatePassword->get('current_password')[0] }}</strong>
            </span>
        @endif
    </div>
    <div class="mb-4">
        <div class="form-label">New Password</div>
        <input type="password" class="form-control {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}"  id="password" name="password" autocomplete="new-password" >

        @if($errors->updatePassword->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->updatePassword->get('password')[0] }}</strong>
            </span>
        @endif
    </div>
    <div class="mb-4">
        <div class="form-label">Confirm Password</div>
        <input type="password" class="form-control {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" autocomplete="new-password">

        @if($errors->updatePassword->has('password_confirmation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->updatePassword->get('password_confirmation')[0] }}</strong>
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    @if (session('status') === 'password-updated')
        <p>Saved!</p>
    @endif
</form>

<!-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
 -->