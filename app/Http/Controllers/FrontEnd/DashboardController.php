<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Post;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller

{

	    public function getIndex()

    {
    	return redirect('/login');

    	// $posts = Post::wherepage_name('News')->orderBy('id','desc')->paginate(3);
    	// return view('frontEnd.dashboard.index',compact('posts'));
    }
   
	
	
	
	
}
