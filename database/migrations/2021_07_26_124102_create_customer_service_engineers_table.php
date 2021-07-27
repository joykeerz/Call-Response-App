<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerServiceEngineersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_service_engineers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sp_id')->nullable();
            $table->string('nama_cse');
            $table->string('initial_cse');
            $table->string('area_cse');
            $table->string('hp_cse');
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
        Schema::dropIfExists('customer_service_engineers');
    }
}
