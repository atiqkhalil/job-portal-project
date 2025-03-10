@extends('layout.app')

@section('main')
    <section class="section-5 bg-2">
        @include('front.account.sidebar')
        </div>
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
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Applied</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @foreach ($jobApplications as $jobApplication)                                                                          
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{$jobApplication->job->title}}</div>
                                            <div class="info1">
                                                {{ $jobApplication->job->jobType->name }}. {{$jobApplication->job->location}}</div>
                                        </td>
                                        <td>{{ $jobApplication->created_at->format('d M, Y') }}</td>
                                        <td>{{$jobApplication->job->applications->count()}} Applications</td>
                                        <td>
                                            @if ($jobApplication->job->status === 1)
                                                <div class="job-status text-capitalize">Active</div>
                                            @else
                                                <div class="job-status text-capitalize">Block</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-dots">
                                                <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{route('jobDetails',$jobApplication->job_id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                    <li><a class="dropdown-item" href="{{route('deletejobApplication',$jobApplication->id)}}"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
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
    </section>
@endsection
