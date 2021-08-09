<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPerdinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_perdins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("perdin_id");
            $table->unsignedBigInteger("user_id");
            $table->string("name");
            $table->string("nip");
            $table->string("jabatan");
            $table->string("activity");
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
        Schema::dropIfExists('log_perdins');
    }
}
