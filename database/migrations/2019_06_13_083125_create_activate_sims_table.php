<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivateSimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activate_sims', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->longText('MSISDN');
            $table->unsignedBigInteger('provisionsim_id');
            $table->foreign('provisionsim_id')->references('id')->on('provision_sims');
            $table->timestamps();
        });

        Schema::table('activate_sims', function (Blueprint $table) {
            $table->foreign('provisionsim_id')->references('id')->on('provision_sims')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activate_sims');
    }
}
