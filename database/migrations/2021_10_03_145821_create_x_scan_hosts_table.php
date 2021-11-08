<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXScanHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_scan_hosts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('dsname')->nullable(false);
            $table->string('dshost')->nullable(false);
            $table->boolean('dsactive')->default(0);
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
        Schema::dropIfExists('x_scan_hosts');
    }
}
