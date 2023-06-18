<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  
  
  
     public function up()

    {
        Schema::create('publishers', function (Blueprint $table) {
            
                $table->id();
                $table->string('name');
                $table->string('tax_number')->unique();
                $table->booleen('suuport_online_books');
                $table->string('category'); //the activity of the publisher
                $table->string('country');
                $table->string('city');
                $table->string('main_address');
                $table->string('branches_addresses');
                $table->string('mobile'); // مفتاح الدولة والرقم 
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
        Schema::dropIfExists('publishers');
    }
}
