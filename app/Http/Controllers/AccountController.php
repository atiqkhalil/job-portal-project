<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\User;
use App\Models\JobType;
use App\Models\Category;
use App\Models\SavedJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Mail\forgotpasswordemail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\password_reset_tokens;


class AccountController extends Controller
{
    public function registration(){
        return view('front.account.registration');
    }

    public function registersave(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email= $request->email;
        $user->password = $request->password;

        $user->save();

        return redirect()->route('front.account.login')->with('success','Registered Successfully!');
    }

    public function login(){
        return view('front.account.login');
    }

    public function loginsave(Request $request){
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credential)){
            return redirect()->route('account.profile');
        }else{
            return redirect()->route('front.account.login')->with('error','Either Email/Password is wrong.Try Again!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('front.account.login');
    }

    public function profile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('front.account.profile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$id},id",
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->mobile = $request->mobile;

        $user->save();

        return redirect()->route('account.profile')->with('success','Profile Updated Successfully');
    }

    public function updateProfilePic(Request $request, string $id)
{
    $request->validate([
        'photo' => 'required|mimes:png,jpg|max:3000', // Only PNG and JPG allowed, max 3MB
    ]);

    $user = User::find($id);

    if ($request->hasFile('photo')) {
        $image_path = public_path('storage/') . $user->image;

        // Delete the old image if it exists
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        // Store the new image
        $path = $request->file('photo')->store('images', 'public');
        $user->image = $path;
        $user->save();

        return redirect()->route('account.profile')->with('success', 'Image Updated Successfully');
    }

        return back()->with('error', 'No file uploaded');
}

    public function createjob($id){
        $user = User::find($id);
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $jobtypes = JobType::orderBy('name','ASC')->where('status',1)->get();
        return view('front.account.job.create',compact('user','categories','jobtypes'));
    }

    public function savejob(Request $request){
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'jobtype' => 'required',
            'vacancy' => 'required',
            'location' => 'required',
            'company_name' => 'required',                
        ]);
        

        $jobdetails = new Job;

        $jobdetails->title = $request->title;
        $jobdetails->category_id = $request->category;
        $jobdetails->job_type_id = $request->jobtype;
        $jobdetails->user_id = Auth::user()->id;
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
        $jobdetails->company_website = $request->website;

        $jobdetails->save();
        
        return redirect()->route('account.myjobs', ['id' => auth()->id()])->with('success','Job Details Added Successfully');
    }

    public function myjobs($id){
        $user = User::find($id);
        $jobs = Job::orderBy('id','DESC')->where('user_id',Auth::user()->id)->with('jobType')->paginate(5);
        //dd($jobs);
        return view('front.account.job.myjob',compact('user','jobs'));
    }

    public function editjob(Request $request,$id){
        $job = Job::find($id);

        if (!$job || $job->user_id !== Auth::id()) {
            abort(404);  // Abort with a 404 error if the job doesn't exist or doesn't belong to the user
        }
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $jobtypes = JobType::orderBy('name','ASC')->where('status',1)->get();    
        $user = Auth::user();
        return view('front.account.job.edit',compact('job','categories','jobtypes', 'user'));
    }

    public function updatejob(Request $request, $id){
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
        $jobdetails->company_website = $request->website;

        $jobdetails->save();
        
        return redirect()->route('account.myjobs', ['id' => auth()->id()])->with('success','Job Details Updated Successfully');
    }

    public function deletejob($id){
        $job = Job::find($id);

        if (!$job || $job->user_id !== Auth::id()) {
            abort(404);  // Abort with a 404 error if the job doesn't exist or doesn't belong to the user
        }

        $job->delete();
        return redirect()->route('account.myjobs', ['id' => auth()->id()])->with('success','Job Deleted Successfully');
    }

    public function jobApplications($id){
        $user = Auth::user();
        $jobApplications = JobApplication::with(['job','job.jobType','job.applications'])->where('user_id', $user->id)->orderBy('created_at','DESC')->paginate(5);
        //dd($jobApplications);
        return view('front.account.job.jobapplications',compact('jobApplications','user'));
    }

    public function savedjobs($id){
        $user = Auth::user();
        $savedjobs = SavedJob::with(['job','job.jobType','job.applications'])->where('user_id', $user->id)->orderBy('created_at','DESC')->paginate(5);
        //dd($jobApplications);
        return view('front.account.job.savedjobs',compact('savedjobs','user'));
    }

    public function deletejobApplication($id){
        $deletejobApplication = JobApplication::find($id);

        if(!$deletejobApplication || $deletejobApplication->user_id !== Auth::id()){
            abort(404);
        }
        $deletejobApplication->delete();

        return redirect()->route('jobApplications',$deletejobApplication->id)->with('success', 'Job application deleted successfully.');
    }

    public function deletesavedjobs($id){
        $deletesavedjobs = SavedJob::find($id);

        if(!$deletesavedjobs || $deletesavedjobs->user_id !== Auth::id()){
            abort(404);
        }
        $deletesavedjobs->delete();

        return redirect()->route('savedjobs',$deletesavedjobs->id)->with('success', 'Saved Job deleted successfully.');
    }

    public function updatepassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if(Hash::check($request->old_password,Auth::user()->password) == false){
            return redirect()->route('account.profile',Auth::id())->with('error','Old Password is Incorrect!');
        }

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('account.profile',Auth::id())->with('success','New Password is Changed Successfully!');
    }

    public function forgotpassword(){
        return view('front.account.forgotpassword');
    }

    public function forgotpasswordprocess(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(60);

        // Delete any existing record for the email
        password_reset_tokens::where('email', $request->email)->delete();

        $password = new password_reset_tokens;
        $password->email = $request->email;
        $password->token = $token;
        $password->created_at = now();
        $password->save();

        $user = User::where('email',$request->email)->first();
        $mailData = [
            'token' => $token,
            'user' => $user,
            'subject' => 'You have request for change password',
        ];
        Mail::to($request->email)->send(new forgotpasswordemail($mailData));

        return redirect()->route('forgotpassword')->with('success','A password reset link has been sent to your email. Please check your inbox.');
    }

    public function resetpassword($token)
    {
    $tokenRecord = password_reset_tokens::where('token', $token)->first();

    if ($tokenRecord == null) {
        return redirect()->route('forgotpassword')->with('error', 'Invalid Token');
    }

    return view('front.account.resetpassword', ['token' => $token]);
    }


    public function processresetpassword(Request $request){
        $request->validate([
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|min:5|same:new_password',
        ]);

        $token = password_reset_tokens::where('token', $request->token)->first();
        

        $newpassword = User::where('email',$token->email)->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Delete the token to invalidate the reset link
        password_reset_tokens::where('token', $request->token)->delete();

        return redirect()->route('front.account.login')->with('success','You have successfully changed your password');
    }

    
}

    