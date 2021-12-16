<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparepartHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparepart_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sparepart_id');
            $table->string('history_status');
            $table->integer('history_qty');
            $table->date('history_date');
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
        Schema::dropIfExists('sparepart_histories');
    }
}
