<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXScanHistoryPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_scan_history_ports', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("id_port");
            $table->uuid("id_user");
            $table->string("port")->nullable(false);
            $table->string("host")->nullable(false);
            $table->integer("onoroff")->default(0);
            $table->timestamps();
            $table->dropColumn('updated_at');

            $table->foreign('id_port')->references('id')->on('x_scan_ports')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_scan_history_ports');
    }
}
