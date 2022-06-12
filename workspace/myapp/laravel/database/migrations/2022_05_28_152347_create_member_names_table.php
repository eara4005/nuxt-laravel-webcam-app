<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_names', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
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
        //Schema::dropIfExists('member_names');
        // Schema::table('member_names', function (Blueprint $table) {
        //     $table->id();
        //     $table->string("name")->unique()->change();
        //     $table->timestamps();
        // });
    }
}
