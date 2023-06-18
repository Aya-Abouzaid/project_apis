<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->id();
            $table->string('full_name');
            $table->string('sex')->unique();
            $table->date('date_of_birth')->format('d/m/y');
            $table->string('favourits'); //link with categories table
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('mobile'); 
            $table->string('email');
            $table->string('password'); 
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
