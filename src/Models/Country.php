<?php

namespace App\Models;

use App\Traits\HasLocalDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {
	
    use HasFactory;
	use HasLocalDates;

	protected $guarded = ['id'];

	public function states() {
		return $this->hasMany(State::class);
	}

}
