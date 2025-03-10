<div class="container py-5">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Account Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card border-0 shadow mb-4 p-3">
                <div class="s-body text-center mt-3">
                    <img src="{{asset('/storage/'.$user->image)}}" alt="avatar"  class="rounded-circle img-fluid border"
                    style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
                    <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
                    <div class="d-flex justify-content-center mb-2">
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                            class="btn btn-primary">Change Profile Picture</button>
                    </div>
                </div>
            </div>
            <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item d-flex justify-content-between p-3">
                            <a href="{{route('account.profile')}}">Account Settings</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <a href="{{route('account.createprofile',$user->id)}}">Post a Job</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <a href="{{route('account.myjobs',$user->id)}}">My Jobs</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <a href="{{route('jobApplications',$user->id)}}">Jobs Applied</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <a href="{{route('savedjobs',$user->id)}}">Saved Jobs</a>
                        </li>
                        @if (Auth::check())
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
