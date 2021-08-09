<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerdinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perdins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('approve_id')->nullable();
            $table->unsignedBigInteger('lokasi_berangkat')->default(345);
            $table->unsignedBigInteger('lokasi_tujuan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('no_perdin');
            $table->string('unit_kerja');
            $table->integer('durasi');
            $table->double('jarak');
            $table->integer('allowance');
            $table->text('tujuan_perdin');
            $table->string('status');
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
        Schema::dropIfExists('perdins');
    }
}
