@extends('layout.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
               
                <div class="card shadow border-0 p-5">
                    @if (session('success')) 
                    <div class="alert alert-success">
                            {{session('success')}}
                        </div>               
                    @endif

                    @if (session('error')) 
                    <div class="alert alert-danger">
                            {{session('error')}}
                        </div>               
                    @endif
                    <h1 class="h3">Reset Password</h1>
                    <form action="{{route('processresetpassword')}}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" name="new_password" id="new_password"  class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password">
                            <span class="text-danger">
                                @error('new_password')
                                    {{$message}}
                                @enderror
                            </span>
                        </div> 

                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password"  class="form-control @error('confirm_password') is-invalid @enderror" placeholder="New Password">
                            <span class="text-danger">
                                @error('confirm_password')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="justify-content-between d-flex">
                        <button class="btn btn-primary mt-2">Submit</button>
                            <a href="forgot-password.html" class="mt-3">Forgot Password?</a>
                        </div>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Do not have an account? <a href="{{route('front.account.login')}}">Back to Login</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
@endsection
