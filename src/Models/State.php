<?php

namespace App\Models;

use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
	use HasLocalDates;

	protected $guarded = ['id'];

	public function cities() {
		return $this->hasMany(City::class);
	}

}
