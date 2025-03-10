<?php

use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\admin\dashboardcontroller;
use App\Http\Controllers\admin\JobApplicationController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/jobs',[JobsController::class,'findjobs'])->name('jobs');
Route::get('/jobDetails/{id}',[JobsController::class,'jobDetails'])->name('jobDetails');
Route::post('/jobapplied/{id}',[JobsController::class,'jobapplied'])->name('jobapplied');
Route::get('/jobApplications/{id}',[AccountController::class,'jobApplications'])->name('jobApplications');
Route::get('/deletejobApplication/{id}',[AccountController::class,'deletejobApplication'])->name('deletejobApplication');
Route::post('/savedjob/{id}',[JobsController::class,'savedjob'])->name('savedjob');
Route::get('/savedjobs/{id}',[AccountController::class,'savedjobs'])->name('savedjobs');
Route::get('/deletesavedjobs/{id}',[AccountController::class,'deletesavedjobs'])->name('deletesavedjobs');
Route::get('/forgotpassword',[AccountController::class,'forgotpassword'])->name('forgotpassword');
Route::post('/forgotpasswordprocess',[AccountController::class,'forgotpasswordprocess'])->name('forgotpasswordprocess');
Route::get('/resetpassword/{token}',[AccountController::class,'resetpassword'])->name('resetpassword');
Route::post('/processresetpassword',[AccountController::class,'processresetpassword'])->name('processresetpassword');


Route::get('account/registration',[AccountController::class,'registration'])->name('front.registration')->middleware(RedirectIfAuthenticated::class);
Route::post('account/registersave',[AccountController::class,'registersave'])->name('registersave');
Route::get('account/login',[AccountController::class,'login'])->name('front.account.login')->middleware(RedirectIfAuthenticated::class);
Route::post('account/loginsave',[AccountController::class,'loginsave'])->name('front.account.loginsave');
Route::get('account/logout',[AccountController::class,'logout'])->name('logout')->middleware(ValidUser::class);
Route::get('account/profile',[AccountController::class,'profile'])->name('account.profile')->middleware(ValidUser::class);
Route::put('account/updateprofile',[AccountController::class,'updateProfile'])->name('account.updateProfile')->middleware(ValidUser::class);
Route::put('account/updateprofilepic/{id}', [AccountController::class, 'updateProfilePic'])->name('account.updateprofilepic')->middleware(ValidUser::class);
Route::get('account/createjob/{id}', [AccountController::class, 'createjob'])->name('account.createprofile')->middleware(ValidUser::class);
Route::post('account/savejob', [AccountController::class, 'savejob'])->name('account.savejob')->middleware(ValidUser::class);
Route::get('account/myjobs/{id}', [AccountController::class, 'myjobs'])->name('account.myjobs')->middleware(ValidUser::class);
Route::get('account/editjob/{id}', [AccountController::class, 'editjob'])->name('account.editjob')->middleware(ValidUser::class);
Route::put('account/updatejob/{id}', [AccountController::class, 'updatejob'])->name('account.updatejob')->middleware(ValidUser::class);
Route::get('account/deletejob/{id}', [AccountController::class, 'deletejob'])->name('account.deletejob')->middleware(ValidUser::class);
Route::post('account/updatepassword', [AccountController::class, 'updatepassword'])->name('account.updatepassword')->middleware(ValidUser::class);

Route::get('admin/dashboard/{id}',[dashboardcontroller::class,'dashboard'])->name('admin.dashboard')->middleware(ValidUser::class);
Route::get('admin/users',[UserController::class,'users'])->name('admin.users')->middleware(ValidUser::class);
Route::get('admin/edituser/{id}',[UserController::class,'edituser'])->name('admin.edituser')->middleware(ValidUser::class);
Route::put('admin/updateuser/{id}',[UserController::class,'updateuser'])->name('admin.updateuser')->middleware(ValidUser::class);
Route::get('admin/deleteuser/{id}',[UserController::class,'deleteuser'])->name('admin.deleteuser')->middleware(ValidUser::class);
Route::get('admin/adminjobs',[JobController::class,'adminjobs'])->name('admin.adminjobs')->middleware(ValidUser::class);
Route::get('admin/editjobs/{id}',[JobController::class,'edit'])->name('admin.edit')->middleware(ValidUser::class);
Route::put('admin/update/{id}', [JobController::class, 'update'])->name('account.update')->middleware(ValidUser::class);
Route::get('admin/deletejob/{id}',[JobController::class,'deletejob'])->name('admin.deletejob')->middleware(ValidUser::class);
Route::get('admin/jobApplications',[JobApplicationController::class,'jobApplications'])->name('admin.jobApplications')->middleware(ValidUser::class);
Route::get('admin/deleteapplication/{id}',[JobApplicationController::class,'deleteapplication'])->name('admin.deleteapplication')->middleware(ValidUser::class);



