<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
	    
    /**
     * Show home page for the user
     *
     * @return Renderable
     */

    public function index()
	{
		if(!auth()->guest()){

			$name = auth()->user()->username;
		}else{

			$name = 'guest';
		}

		return 'Good evening, dear '.$name;
	}
}
