<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvisionSimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provision_sims', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->longText('ICCID');
            $table->longText('IMSI');
            $table->string('Ki');
            $table->integer('PIN1');
            $table->integer('PUC');
            $table->integer('status');
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
        Schema::dropIfExists('provision_sims');
    }
}
