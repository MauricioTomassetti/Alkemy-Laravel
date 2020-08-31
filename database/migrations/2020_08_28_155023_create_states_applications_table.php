<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('id_app')->foreign('id_application_fk')->references('id')->on('applications');
            $table->integer('id_user')->foreign('id_state_user_fk')->references('id')->on('states');
            $table->integer('id_state')->foreign('id_state_application_fk')->references('id')->on('users');
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
        Schema::dropIfExists('states_applications');
    }
}
