<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobcards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('bp_id')->nullable();
            $table->unsignedBigInteger('sp_id')->nullable();
            $table->unsignedBigInteger('product_detail_id');

            $table->string('problem_desc');
            $table->string('pic_contact')->default('none');
            $table->string('jobcard_number')->nullable();
            $table->string('ticket_number')->nullable();
            $table->string('service_type')->nullable();
            $table->string('waiting_note')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->string('brief_of_work')->nullable();
            $table->string('cse_name')->nullable();
            $table->boolean('sparepart_replacement')->default(0);
            $table->boolean('isClosed')->default(0);

            $table->dateTime('date_time');
            $table->dateTime('arrival_time')->nullable();
            $table->dateTime('time_working')->nullable();
            $table->dateTime('time_complete')->nullable();
            $table->dateTime('time_leave')->nullable();
            $table->string('waiting_time')->nullable();

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
        Schema::dropIfExists('jobcards');
    }
}
