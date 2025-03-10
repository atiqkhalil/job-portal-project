@extends('layout.app')

@section('main')
    <div class="container py-5">
        <!-- Breadcrumb Section -->
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                    <div class="card-body card-form p-4">

                        <div class="card-body card-form">
                            @if (session('success')) 
                            <div class="alert alert-success">
                                    {{session('success')}}
                                </div>               
                            @endif
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">Jobs Applied</h3>
                                </div>
                                
                                
                            </div>
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Job Title</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Employer</th>
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @foreach ($jobApplications as $jobApplication)                                                                          
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{$jobApplication->job->title}}</div>
                                            </td>   
                                                  <td> {{ $jobApplication->user->name }}</td> 
                                            
                                            <td>{{ $jobApplication->employer->name }}</td>
                                            <td>{{ $jobApplication->created_at->format('d M, Y') }}</td>
                                           
                                            <td>
                                                <div class="action-dots">
                                                    <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{route('jobDetails',$jobApplication->job_id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                        <li><a class="dropdown-item" href="{{route('admin.deleteapplication',$jobApplication->id)}}"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                            <div class="mt-5">
                                {{$jobApplications->links("pagination::bootstrap-5")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
