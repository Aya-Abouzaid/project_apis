<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;


	/**
	 * @return mixed
	 */
	public function getFillable() {
		return $this->fillable;
	}
	
	/**
	 * @param mixed $fillable 
	 * @return self
	 */
	public function setFillable($fillable): self {
		$this->fillable = $fillable;

        "full_name";
        'sex';
        'favourits';
        'country';
        'city';
        'address';
        'mobile';
        'email';
        'password';


		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getHidden() {

		return $this->hidden;
	}
	
	/**
	 * @param mixed $hidden 
	 * @return self
	 */
	public function setHidden($hidden): self {
		$this->hidden = $hidden;
		return $this;
	}
}
