<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
	        $table->string('user_number');
            $table->string('user_name');
            $table->string('user_birth');
            $table->string('user_sex');
            $table->string('user_ntl');
            $table->string('user_address');
            $table->string('user_status');
            $table->string('user_work');
            $table->string('user_period');
	        $table->string('user_tel');
            $table->string('user_email');
            $table->string('user_msg');
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
        Schema::dropIfExists('students');
    }
}
