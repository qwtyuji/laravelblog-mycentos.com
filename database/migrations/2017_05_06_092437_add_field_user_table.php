<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
        */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('github_id')->nullable();
            $table->string('github_name')->nullable();
            $table->string('github_nickname')->nullable();
            $table->string('status',1)->default('T');
            $table->string('avatar')->default('/public/images/avatar/default.png');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
