<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
	    
    /**
     * Show registration form
     *
     * @return Illuminate\Http\Response
	 *
     */

    public function show()
	{

		return 'register page '.csrf_token();

	}
	
		
	/**
	 * Handle account registration request
	 *
	 * @param  RegisterRequest $request
	 * @return Illuminate\Http\Response
	 */
	public function register(RegisterRequest $request)
	{

		$user = User::create($request->validated());

		auth()->login($user);

		return redirect('/')->with('success', 'Account successfuly registered!');
	}
}
