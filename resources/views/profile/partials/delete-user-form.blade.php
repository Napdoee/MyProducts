<h3 class="card-title mt-4">Delete Account 
    @if($errors->userDeletion->has('password'))
    <span class="card-subtitle text-red" role="alert">
        * error from password form.
    </span>
    @endif
</h3>
<p class="card-subtitle">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain</p>
<div>
  <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-small">
    Delete Account
  </button>
</div>

<div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <div class="modal-body">
                <div class="modal-title">Are you sure?</div>
                <div>If you proceed, you will lose all your personal data.</div>
                <div class="mt-4">
                    <div class="form-label">Password</div>
                    <input type="password" class="form-control {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}" id="password" name="password" autocomplete="password">

                    @if($errors->userDeletion->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->userDeletion->get('password')[0] }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, delete all my data</button>
            </div>
      </form>
    </div>
  </div>
</div>