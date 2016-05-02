<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Request;
use App\Http\Requests;
use App\Secure;

class DiverseExampleController extends Controller
{
    public function index(){
		return view('viewChange.index');
 	   }


	public function setUp(){
		$input = Request::all();
		$secure= new Secure;
		$secure->processId=sha1(Carbon::now()->toDateTimeString().$input['fingerprint']);
		$secure->clientPrint=$input['fingerprint'];
		$secure->validUntil=Carbon::now()->addMinutes($input['duration']);
		$secure->save();
		return $secure->processId;
	}

	public function secondView(){
		$input = Request::all();
		$secure = Secure::where('clientPrint',$input['fingerprint'])->where('validUntil','>=',Carbon::now()->toDateTimeString())->where('processId',$input['processId'])->get();
		if($secure->isEmpty()){
			return view('viewChange.failed');
		}else{
			return view('viewChange.second')->with('processId',$input['processId']);
		}
	}
	public function thirdView(){
		$input = Request::all();
		$secure = Secure::where('clientPrint',$input['fingerprint'])->where('validUntil','>=',Carbon::now()->toDateTimeString())->where('processId',$input['processId'])->get();
		if($secure->isEmpty()){
			return view('viewChange.failed');
		}else{
			return view('viewChange.third')->with('processId',$input['processId']);
		}
	}
	
}
