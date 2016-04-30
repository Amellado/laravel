<?php

namespace App\Http\Controllers;

use Psy\Exception\ErrorException;
use Request;

use App\Http\Requests;
use App\User;

class EstableExampleController extends Controller
{
    public function index(){
    	return view('login.index');
 	}

 	public function save(){
 		$input = Request::all();
 		$user = new User;
		$user->name=$input['user'];
        $user->password=$input['pass'];
        $user->fingerprint=$input['fingerprint'];
        $user->userAgent=$_SERVER['HTTP_USER_AGENT'];
        $user->save();
        
 		return view('login.index')->with('ok','true');
 	}

    public function test(){
        $input = Request::all();
        $user = User::where('name',$input['user'])->where('password',$input['pass'])->where('fingerprint',$input['fingerprint'])->get();
        if($user->isEmpty()){
            return "nada";
        }else{
            return $user->first();
        }
    }
}
