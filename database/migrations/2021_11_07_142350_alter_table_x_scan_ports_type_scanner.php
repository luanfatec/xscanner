<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableXScanPortsTypeScanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('x_scan_ports', function (Blueprint $table) {
            $table->string("type_scan")->nullable(false);
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
            $table->dropColumn('type_scan');
        });
    }
}
