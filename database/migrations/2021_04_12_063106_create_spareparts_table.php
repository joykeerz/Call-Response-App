<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spareparts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_detail_id')->nullable();

            $table->string('part_number');
            $table->string('part_serial');
            $table->string('part_name');
            $table->string('part_condition');
            $table->integer('part_qty');
            $table->date('part_date_of_entry');
            $table->date('part_out_date');
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
        Schema::dropIfExists('spareparts');
    }
}
