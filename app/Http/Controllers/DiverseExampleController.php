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

	//@todo funcion que recibe y checkea el process id con la fingerprint y solo si concuerda muestra la vista.
	
}
