@extends('layout.app')

@section('main')
    <div class="container py-5">
        <!-- Breadcrumb Section -->
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard',Auth::id())}}">Home</a></li>
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
                                <a href="#">Jobs</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="#">Job Applications</a>
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
                    <div class="card-body card-form p-4">

                        <div class="card-body card-form">
                            @if (session('success')) 
                            <div class="alert alert-success">
                                    {{session('success')}}
                                </div>               
                            @endif
                            <div class="card border-0 shadow mb-4">
                                <div class="card-body  p-4">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <h3 class="fs-4 mb-1">User / Edit</h3>
                                    <form action="{{ route('admin.updateuser',$user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Name*</label>
                                            <input type="text" name="name" placeholder="Enter Name"
                                                class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Email*</label>
                                            <input type="text" name="email" placeholder="Enter Email"
                                                class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Designation</label>
                                            <input type="text" name="designation" placeholder="Designation" class="form-control"
                                                value="{{ $user->designation }}">
                                        </div>
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Mobile</label>
                                            <input type="text" name="mobile" placeholder="Mobile" class="form-control"
                                                value="{{ $user->mobile }}">
                                        </div>
                                </div>
                                <div class="card-footer  p-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
