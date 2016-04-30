<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Psy\Exception\ErrorException;
use Request;

use App\Http\Requests;
use App\User;

class EstableExampleController extends Controller
{
    public function index(){
    	return view('login.index');
 	}

 	public function saveOrTest(CreateUserRequest $request){
 		$input = $request->all();
        if ($input['saving']=='yes'){
            $user = new User;
            $user->name=$input['user'];
            $user->password=$input['pass'];
            $user->fingerprint=$input['fingerprint'];
            $user->userAgent=$_SERVER['HTTP_USER_AGENT'];
            $user->save();

            return view('login.index')->with('ok','true');
        }elseif ($input['saving']=='no'){
            $user = User::where('name',$input['user'])->where('password',$input['pass'])->where('fingerprint',$input['fingerprint'])->get();
            if($user->isEmpty()){
                return view('login.index')->with('test','false');
            }else{
                return view('login.index')->with('test','true');
            }
        }
 		return view('login.index');
 	}

}
