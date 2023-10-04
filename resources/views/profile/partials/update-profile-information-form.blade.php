<h3 class="card-title">Profile Information</h3>
<p class="card-subtitle">Update your account's profile information and email address.</p>
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>
<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')
    <!-- <div class="row align-items-center">
        <div class="col-auto">
            <span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
        </div>
        <div class="col-auto">
            <a href="#" class="btn">Change avatar</a>
        </div>
        <div class="col-auto">
            <a href="#" class="btn btn-ghost-danger">Delete avatar</a>
        </div>
    </div> -->
    <div class="row">
        <div class="col">
            <div class="mb-4">
                <div class="form-label required">Firstname</div>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror"  id="firstname" name="firstname" value="{{old('firstname', $user->firstname)}}" autocomplete="firstname">
                @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="mb-4">
                <div class="form-label required">Lastname</div>
                <input type="text" class="form-control @error('lastname') is-invalid @enderror"  id="lastname" name="lastname" value="{{old('lastname', $user->lastname)}}" autocomplete="lastname">
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="form-label required">Name</div>
        <input type="text" class="form-control @error('name') is-invalid @enderror"  id="name" name="name" value="{{old('name', $user->name)}}" autocomplete="name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-4">
        <div class="form-label">Address</div>
        <input type="text" class="form-control"  id="address" name="address" value="{{old('address', $user->address)}}" autocomplete="address" placeholder="">
    </div>
    <div class="mb-4">
        <div class="form-label required">Email</div>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" autocomplete="username">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p>
                    <div class="form-label">Your email address is unverified.</div>
                    <button form="send-verification" class="btn btn-outline-secondary">
                        Click here to re-send the verification email.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="text-muted">A new verification link has been sent to your email address.</p>
                @endif
            </div>
        @endif
    </div>
    <div class="flex items-center gap-4">
        <button type="submit" class="btn btn-primary">Save</button>

        @if (session('status') === 'profile-updated')
            <p>Saved!</p>
        @endif
    </div>
</form>