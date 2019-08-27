<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('shops', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('shortcode')->nullable(false)->unique();
        $table->string('name')->nullable(false)->unique();
        $table->text('address')->nullable();
        $table->string('phone')->nullable();
        $table->string('pincode')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('email')->nullable();
        $table->boolean('active')->nullable(false)->default(true);
        
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
        Schema::dropIfExists('shops');
    }
}
