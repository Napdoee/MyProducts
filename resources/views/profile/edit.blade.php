@section('title','Edit Account')

<div class="card">
    <div class="card-body">
        <h2 class="mb-4">My Account</h2>
        <div class="row">
            <div class="col-12 col-md-6">
                @include('profile.partials.update-profile-information-form')  
            </div>
            <hr class="mt-4 d-md-none">
            <div class="col-12 col-md-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>
        <hr>
        @include('profile.partials.delete-user-form')
    </div>
    <!-- <div class="card-footer bg-transparent mt-auto">
        <div class="btn-list justify-content-end">
            <a href="#" class="btn">Cancel</a>
            <a href="#" class="btn btn-primary">Submit</a>
        </div>
    </div> -->
</div>