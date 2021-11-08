<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXScanPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_scan_ports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_host');
            $table->uuid('id_user');
            $table->string('name')->nullable(false);
            $table->string('host')->nullable(false)->cha;
            $table->string('ports');
            $table->text('descrition')->nullable(true);
            $table->timestamp('lastscan');

            $table->foreign('id_host')->references('id')->on('x_scan_hosts')->onDelete('cascade');
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
        Schema::dropIfExists('x_scan_ports');
    }
}
