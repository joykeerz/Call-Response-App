<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeaderCseToCustomerServiceEngineersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_service_engineers', function (Blueprint $table) {
            //
            $table->string('leader_cse')->after('hp_cse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_service_engineers', function (Blueprint $table) {
            //
            $table->dropColumn('leader_cse');
        });
    }
}
