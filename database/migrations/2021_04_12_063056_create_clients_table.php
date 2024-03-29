<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_detail_id')->nullable();
            $table->unsignedBigInteger('customer_service_engineer_id')->nullable();

            $table->string('client_customer_name');
            $table->string('client_machine_id');
            $table->string('client_machine_status');

            $table->string('client_pic_name');
            $table->string('client_pic_hp');

            $table->string('client_site_location_name')->nullable();
            $table->string('client_site_location_address')->nullable();

            $table->date('client_activation_date');
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
        Schema::dropIfExists('clients');
    }
}
