<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobType;
use App\Models\Category;
use App\Models\SavedJob;
use App\Mail\welcomeemail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class JobsController extends Controller
{
    public function findjobs(Request $request){
        $categories = Category::where('status',1)->get();
        $jobtypes = JobType::where('status',1)->get();

        $jobs = Job::where('status',1);

        //Search using keywords and title
        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function($query) use ($request){
                $query->orWhere('title', 'like', '%' .$request->keyword. '%');
                $query->orWhere('keywords', 'like', '%' .$request->keyword. '%');
            });
        }

        //Search using location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location', 'like', '%' . $request->location . '%');
        }

        //Search using category
        if(!empty($request->category)){
            $jobs = $jobs->where('category_id', $request->category);
        }

        //Search using jobtype
        if (!empty($request->job_type)) {
            $jobTypeArray = $request->job_type; // Directly access as an array
            $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
        }

        //Search using experience
        if(!empty($request->experience)){
            $jobs = $jobs->where('experience', $request->experience);
        }
        
        $jobs = $jobs->with('jobType');
        
        if ($request->sort == '1') {
            $jobs = $jobs->orderBy('created_at', 'ASC'); // Oldest first
        } else {
            $jobs = $jobs->orderBy('created_at', 'DESC'); // Latest first
        }
        
               
        $jobs = $jobs->paginate(9);

        return view('front.jobs',compact('categories','jobtypes','jobs'));
    }

    public function jobDetails($id){
        $job = Job::with('jobType')->find($id);
        //dd($job);

        $savedjobcount = 0;
       if (Auth::user()) {
            $savedjobcount = SavedJob::where(['user_id' => Auth::user()->id,'job_id' => $id])->count();
       }

       $applications = JobApplication::where('job_id',$id)->with('user')->get();

        return view('front.jobDetails',compact('job','savedjobcount','applications'));
    }
    
    public function jobApplied(Request $request,$id){
        $job = Job::find($id);
        //dd($job->title);
        //dd($job);
        $employer_id = $job->user_id;

        //Don't apply your own job
        if($employer_id == Auth::user()->id){
            return redirect()->route('jobDetails',$id)->with('error','You do not apply your own job!');
        }

        //Don't apply twice on one job
        $jobapplicationcount = JobApplication::where(['user_id' => Auth::user()->id,'job_id' => $id])->count();
        
        if($jobapplicationcount>0){
            return redirect()->route('jobDetails',$id)->with('error','You have already applied for this job!');
        }

        $employer = User::find($employer_id);

        //dd($job->title, $employer->name, $employer->email, $employer->mobile);

        Mail::to(Auth::user()->email)->send(new welcomeemail(
            $job->title,
            $employer->name,
            $employer->email,
            $employer->mobile
        ));

        $jobapplication = new JobApplication;
        $jobapplication->job_id = $id;
        $jobapplication->user_id = Auth::user()->id;
        $jobapplication->employer_id = $employer_id; 
        $jobapplication->applied_date = now();
        $jobapplication->save();
        
        return redirect()->route('jobDetails',$id)->with('success','Job Applied Successfully!');
    }

    public function savedjob(Request $request,$id){
        $savedjobfind = Job::find($id);
        //dd($savedjobfind);

        //Don't saved twice on one job
        $savedjobcount = SavedJob::where(['user_id' => Auth::user()->id,'job_id' => $id])->count();
        
        if($savedjobcount>0){
            return redirect()->route('jobDetails',$id)->with('error','You have already saved this job!');
        }

        $savedjobs = new SavedJob;
        $savedjobs->job_id = $id;
        $savedjobs->user_id = Auth::user()->id;
        $savedjobs->save();
        return redirect()->route('jobDetails',$id)->with('success','Job Saved Successfully!');
    }
}
