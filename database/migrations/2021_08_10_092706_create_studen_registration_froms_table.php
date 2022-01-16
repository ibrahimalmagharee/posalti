<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudenRegistrationFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studen_registration_froms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('school_name');
            $table->string('educational_level');
            $table->string('mobile_number', 8);
            $table->string('father_name')->nullable();
            $table->string('father_mobile_number', 8)->nullable();
            $table->boolean('agree_to_terms');
            $table->string('personal_picture')->nullable();
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
        Schema::dropIfExists('studen_registration_froms');
    }
}
