@extends('layout.app')

@section('main')
    <div class="container py-5">
        <!-- Breadcrumb Section -->
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3">
                <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between p-3">
                                <a href="{{route('admin.users')}}">Users</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{route('admin.adminjobs')}}">Jobs</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{route('admin.jobApplications')}}">Job Applications</a>
                            </li>
                            @if (Auth::check())
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{ route('logout') }}">Logout</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content Area -->
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body dashboard text-center">
                        <h4 class="card-title">Welcome Administrator 👨🏻‍💻</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
