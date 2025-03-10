@extends('layout.app')

@section('main')
    <section class="section-5 bg-2">
        @include('front.account.sidebar')
        </div>
        <div class="col-lg-9">
            <div class="card border-0 shadow mb-4">
                <div class="card-body card-form p-4">
                    <h3 class="fs-4 mb-1">Edit Job Details</h3>
                    <form action="{{route('account.updatejob',$job->id)}}" method="post">
                        @csrf
                        @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="" class="mb-2">Title<span class="req">*</span></label>
                            <input type="text" placeholder="Job Title" value="{{$job->title}}" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
                            <span class="text-danger">
                                @error('title')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-6  mb-4">
                            <label for="" class="mb-2">Category<span class="req">*</span></label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                <option {{($job->category_id == $category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>  
                            <span class="text-danger">
                                @error('category')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                            <select name="jobtype" class="form-select @error('jobtype') is-invalid @enderror">
                                <option value="">Select Job Type</option>
                                @foreach ($jobtypes as $jobtype)
                                <option {{$job->job_type_id == $jobtype->id ? 'selected' : ''}} value="{{$jobtype->id}}">{{$jobtype->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('jobtype')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-6  mb-4">
                            <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                            <input type="number" min="1" value="{{$job->vacancy}}" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror">
                            <span class="text-danger">
                                @error('vacancy')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4 col-md-6">
                            <label for="" class="mb-2">Salary</label>
                            <input type="text" placeholder="Salary" value="{{$job->salary}}" id="salary" name="salary" class="form-control">
                        </div>

                        <div class="mb-4 col-md-6">
                            <label for="" class="mb-2">Location<span class="req">*</span></label>
                            <input type="text" placeholder="location" value="{{$job->location}}" id="location" name="location" class="form-control @error('location') is-invalid @enderror">
                            <span class="text-danger">
                                @error('location')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="" class="mb-2">Description<span class="req">*</span></label>
                        <textarea class="textarea @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description"> {{$job->description}} </textarea>
                        <span class="text-danger">
                            @error('description')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">Benefits</label>
                        <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"> {{$job->benefits}} </textarea>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">Responsibility</label>
                        <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"> {{$job->responsibility}} </textarea>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">Qualifications</label>
                        <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications"> {{$job->qualifications}} </textarea>
                    </div>
                    
                    <div class="col-md-6  mb-4">
                        <label for="" class="mb-2">Experience<span class="req">*</span></label>
                        <select name="experience" id="experience" class="form-control @error('experience') is-invalid @enderror"> 
                            <option value="1" {{ ($job->experience == 1) ? 'selected' : '' }}>1 Year</option>
                            <option value="2" {{ ($job->experience == 2) ? 'selected' : '' }}>2 Years</option>
                            <option value="3" {{ ($job->experience == 3) ? 'selected' : '' }}>3 Years</option>
                            <option value="4" {{ ($job->experience == 4) ? 'selected' : '' }}>4 Years</option>
                            <option value="5" {{ ($job->experience == 5) ? 'selected' : '' }}>5 Years</option>
                            <option value="6" {{ ($job->experience == 6) ? 'selected' : '' }}>6 Years</option>
                            <option value="7" {{ ($job->experience == 7) ? 'selected' : '' }}>7 Years</option>
                            <option value="8" {{ ($job->experience == 8) ? 'selected' : '' }}>8 Years</option>
                            <option value="9" {{ ($job->experience == 9) ? 'selected' : '' }}>9 Years</option>
                            <option value="10" {{ ($job->experience == 10) ? 'selected' : '' }}>10 Years</option>
                        </select>                        
                        <span class="text-danger">
                            @error('category')
                                {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-4">
                        <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                        <input type="text" placeholder="keywords" value="{{$job->keywords}}" id="keywords" name="keywords" class="form-control">
                    </div>

                    <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                    <div class="row">
                        <div class="mb-4 col-md-6">
                            <label for="" class="mb-2">Name<span class="req">*</span></label>
                            <input type="text" placeholder="Company Name" value="{{$job->company_name}}" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror">
                            <span class="text-danger">
                                @error('company_name')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-4 col-md-6">
                            <label for="" class="mb-2">Location</label>
                            <input type="text" value="{{$job->company_location}}" placeholder="Location" id="location" name="company_location" class="form-control">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="" class="mb-2">Website</label>
                        <input type="text" value="{{$job->company_website}}" placeholder="Website" id="website" name="website" class="form-control">
                    </div>
                </div> 
                <div class="card-footer  p-4">
                    <button type="submit" class="btn btn-primary">Save Job</button>
                </div>
            </div>

        </form>
        </div>
        </div>
        </div>
    </section>
@endsection
