<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
	protected $guarded = [];

	// public function getCreatedAtAttribute($value)
	// {
	// 	return  Carbon::parse($value)->getTimestamp();
	// }

	// public function getUpdatedAtAttribute($value)
	// {
	// 	return  Carbon::parse($value)->getTimestamp();
	// }
}
