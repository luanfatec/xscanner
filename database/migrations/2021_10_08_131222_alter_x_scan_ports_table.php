<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterXScanPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('x_scan_ports', function (Blueprint $table) {
            $table->boolean("is_scan")->default(0);
            $table->integer("temp_history")->default(7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('x_scan_ports', function (Blueprint $table) {
            $table->dropColumn('is_scan');
            $table->dropColumn('temp_history');
        });
    }
}
