@extends('layout.app');

@section('main')
<section class="section-3 py-5 bg-2 ">
    <div class="container">     
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Find Jobs</h2>  
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">
                    <form action="{{route('jobs')}}" method="get">
                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                        <option value="0" {{ request('sort') == '0' ? 'selected' : '' }}>Latest</option>
                        <option value="1" {{ request('sort') == '1' ? 'selected' : '' }}>Oldest</option>
                    </select>
                </form>
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="{{route('jobs')}}" method="get">
                <div class="card border-0 shadow p-4">
                    <div class="mb-4">
                        <h2>Keywords</h2>
                        <input type="text" name="keyword" placeholder="Keywords" class="form-control" value="{{ request('keyword') }}">
                    </div>

                    <div class="mb-4">
                        <h2>Location</h2>
                        <input type="text" name="location" placeholder="Location" class="form-control" value="{{ request('location') }}">
                    </div>

                    <div class="mb-4">
                        <h2>Category</h2>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ request('category') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>    
                            @endforeach                                                    
                        </select>
                    </div>                   

                    <div class="mb-4">
                        <h2>Job Type</h2>
                        @foreach ($jobtypes as $jobtype)
                            <div class="form-check mb-2">
                                <input class="form-check-input" 
                                       name="job_type[]" 
                                       type="checkbox" 
                                       value="{{ $jobtype->id }}" 
                                       id="job-type-{{ $jobtype->id }}" 
                                       {{ is_array(request('job_type')) && in_array($jobtype->id, request('job_type')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="job-type-{{ $jobtype->id }}">{{ $jobtype->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    
                    

                    <div class="mb-4">
                        <h2>Experience</h2>
                        <select name="experience" id="experience" class="form-control">
                            <option value="">Select Experience</option>
                            <option value="1" {{ (request('experience') == 1) ? 'selected' : '' }}>1 Year</option>
                            <option value="2" {{ (request('experience') == 2 )? 'selected' : '' }}>2 Years</option>
                            <option value="3" {{ (request('experience') == 3) ? 'selected' : '' }}>3 Years</option>
                            <option value="4" {{ (request('experience') == 4) ? 'selected' : '' }}>4 Years</option>
                            <option value="5" {{ (request('experience') == 5) ? 'selected' : '' }}>5 Years</option>
                            <option value="6" {{ (request('experience') == 6 )? 'selected' : '' }}>6 Years</option>
                            <option value="7" {{ (request('experience') == 7) ? 'selected' : '' }}>7 Years</option>
                            <option value="8" {{ (request('experience') == 8) ? 'selected' : '' }}>8 Years</option>
                            <option value="9" {{( request('experience') == 9) ? 'selected' : '' }}>9 Years</option>
                            <option value="10" {{( request('experience') == 10) ? 'selected' : '' }}>10 Years</option>
                        </select>
                    </div>  
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{route('jobs')}}" class="btn btn-secondary mt-3">Reset</a>                  
                </div>
            </form>
            </div>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">                    
                    <div class="job_lists">
                    <div class="row">
                        @if($jobs->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                No jobs found matching your criteria.
                            </div>
                        </div>
                     @else
                        @foreach ($jobs as $job)                      
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{$job->title}}</h3>
                                    <p> {{Str::of($job->description)->limit(30)}} </p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{$job->location}}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{$job->jobType->name}}</span>
                                        </p>
                                        @if (!is_null($job->salary))
                                        <p class="mb-0">
                                           <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                           <span class="ps-1">{{$job->salary}}</span>                                         
                                       </p>
                                       {{-- <p> <span> {{$job->keywords}} </span></p>
                                       <p> <span> {{$job->experience}} </span></p> --}}
                                       @endif
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{route('jobDetails',$job->id)}}" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach    
                        @endif
                        {{$jobs->links('pagination::bootstrap-5')}}
                    </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<script>
     document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const inputs = this.querySelectorAll('input, select');
            
            inputs.forEach(input => {
                if (!input.value) {
                    input.removeAttribute('name'); // Remove the field entirely from the request
                }
            });
        });
    });
</script>
@endsection


