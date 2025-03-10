@extends('layout.app')

@section('main')
    <section class="section-5 bg-2">
        @include('front.account.sidebar')
        </div>
        <div class="col-lg-9">
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
                    <h3 class="fs-4 mb-1">My Profile</h3>
                    <form action="{{ route('account.updateProfile') }}" method="POST">
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

            <div class="card border-0 shadow mb-4">
                <form action="{{route('account.updatepassword')}}" method="post">
                    @csrf
                <div class="card-body p-4">
                    <h3 class="fs-4 mb-1">Change Password</h3>
                    <div class="mb-4">
                        <label for="" class="mb-2">Old Password*</label>
                        <input type="password" name="old_password" value="{{old('old_password')}}" placeholder="Old Password" class="form-control @error('oldpassword') is-invalid @enderror">
                        <span class="text-danger">
                                @error('old_password')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">New Password*</label>
                        <input type="password" name="new_password" value="{{old('new_password')}}" placeholder="New Password" class="form-control @error('newpassword') is-invalid @enderror">
                        <span class="text-danger">
                                @error('new_password')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">Confirm Password*</label>
                        <input type="password" name="confirm_password" value="{{old('confirm_password')}}" placeholder="Confirm Password" class="form-control @error('confirm_password') is-invalid @enderror">
                        <span class="text-danger">
                                @error('confirm_password')
                                    {{$message}}
                                @enderror
                            </span>
                    </div>
                </div>
            
                <div class="card-footer  p-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div> 
        </form>
        </div>
        </div>
        </div>
    </section>
@endsection
