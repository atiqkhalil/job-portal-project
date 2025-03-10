<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function adminjobs(){
        $jobs = Job::orderBy('created_at','DESC')->with('user','applications')->paginate(10);
        return view('admin.jobs.list',compact('jobs'));
    }

    public function edit($id){
        $job = Job::findOrFail($id);
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $jobtypes = JobType::orderBy('name','ASC')->where('status',1)->get();   
        return view('admin.jobs.edit',compact('job','categories','jobtypes'));
    }

    public function update(Request $request, $id){
        $jobdetails = Job::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'jobtype' => 'required',
            'vacancy' => 'required',
            'location' => 'required',
            'company_name' => 'required',                
        ]);

        $jobdetails->title = $request->title;
        $jobdetails->category_id = $request->category;
        $jobdetails->job_type_id = $request->jobtype;
        $jobdetails->vacancy = $request->vacancy;
        $jobdetails->salary = $request->salary;
        $jobdetails->location = $request->location;
        $jobdetails->description = $request->description;
        $jobdetails->benefits = $request->benefits;
        $jobdetails->responsibility = $request->responsibility;
        $jobdetails->qualifications = $request->qualifications;
        $jobdetails->keywords = $request->keywords;
        $jobdetails->experience = $request->experience;
        $jobdetails->company_name = $request->company_name;
        $jobdetails->company_location = $request->company_location;
        $jobdetails->status = $request->status;
        $jobdetails->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;
        $jobdetails->company_website = $request->website;

        $jobdetails->save();
        
        return redirect()->route('admin.adminjobs', ['id' => auth()->id()])->with('success','Job Details Updated Successfully');
    }

    public function deletejob($id){
        $deletejob = Job::findOrFail($id);

        $deletejob->delete();

        return redirect()->route('admin.adminjobs')->with('success','Job Deleted Successfully');
    }

}
