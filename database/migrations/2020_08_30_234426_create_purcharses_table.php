<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurcharsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purcharses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->foreign('id_purcharse_user_fk')->references('id')->on('users');
            $table->integer('app_id')->foreign('id_purcharse_app_fk')->references('id')->on('applications');
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
        Schema::dropIfExists('purcharses');
    }
}
