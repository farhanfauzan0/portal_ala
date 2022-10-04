<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PortalOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_order', function (Blueprint $table) {
            $table->id();
            $table->string('pemesan');
            $table->string('pesanan_id');
            $table->integer('jumlah_pesanan');
            $table->integer('status_id');
            $table->integer('deadline_id');
            $table->double('omset');
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
        Schema::dropIfExists('portal_order');
    }
}
