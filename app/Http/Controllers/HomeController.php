<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status',1)->orderBy('name','ASC')->take(9)->get();

        $newcategories = Category::where('status',1)->orderBy('name','ASC')->get();

        $featureds = Job::where('status',1)->orderBy('created_at','DESC')->with('jobType')->where('isFeatured',1)->take(8)->get();
        $latestjobs = Job::where('status',1)->orderBy('created_at','DESC')->with('jobType')->take(9)->get();
        return view('front.home',compact('categories','featureds','latestjobs','newcategories'));
    }
}
