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