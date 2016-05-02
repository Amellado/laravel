<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DiverseExampleController extends Controller
{
    public function index(){
		return view('viewChange.index');
 	   }
}
