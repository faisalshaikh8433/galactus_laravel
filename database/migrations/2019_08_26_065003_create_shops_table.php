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
            $table->string('shortcode')->nullable(false);
            $table->string('name')->nullable(false);
            $table->text('address');
            $table->string ('phone');
            $table->string ('pincode');
            $table->string ('city');
            $table->string ('state');
            $table->string ('email');
            $table->boolean('active')->nullable(false)->nullable()->default(true);
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
