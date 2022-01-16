<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentToStudenRegistrationFroms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studen_registration_froms', function (Blueprint $table) {
            $table->string('father_name1');
            $table->string('father_mobile_number1', 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studen_registration_froms', function (Blueprint $table) {
            //
        });
    }
}
