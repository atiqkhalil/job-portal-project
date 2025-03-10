<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Controllers\Controller;

class JobApplicationController extends Controller
{
    public function jobApplications(){
        $jobApplications = JobApplication::orderBy('created_at','DESC')->with('user','job','employer')->paginate(10);
        return view('admin.jobsapplications.jobApplications',compact('jobApplications'));
    }

   public function deleteapplication(Request $request,$id){
    $deleteapplication = JobApplication::find($id);
    $deleteapplication->delete();
    return redirect()->route('admin.jobApplications')->with('success','Job Application deleted Successfully!');
   }
}
