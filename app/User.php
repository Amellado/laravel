<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
    	'name',
    	'password',
		'fingerprint',
    	'userAgent'

    ];
}
