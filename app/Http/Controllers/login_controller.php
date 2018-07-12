<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class login_controller extends Controller
{
    function index(){
		return view('login_page');
	}
	
	function validate_login(Request $request){
		$login_data = array(
			'email' => $request->get('username'),
			'password' => $request->get('password')
		);
		if(Auth::attempt($login_data)){
			return redirect('/dashboard/main_dashboard');
		}else{
			return back()->with('error','Login Error..');
		}
	}
	
	function logout(){
		Auth::logout();
		//return redirect('login');
		return view('login_page');
	}
}
