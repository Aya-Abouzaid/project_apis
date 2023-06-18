<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

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

            'name';
            'tax_number';
            'suuport_online_books';
            'type';
            'country';
            'city';
            'main_address';
            'branches_addresses';
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
