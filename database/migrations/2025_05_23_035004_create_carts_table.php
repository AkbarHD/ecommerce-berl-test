<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('invoice');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_hp', 30);
            $table->string('province');
            $table->text('alamat');
            $table->string('ekspedisi');
            $table->bigInteger('ongkir');
            $table->integer('status');
            $table->integer('cby')->nullable();
            $table->integer('mby')->nullable();
            $table->char('isdelete', 1)->default('0');
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
        Schema::dropIfExists('carts');
    }
}
