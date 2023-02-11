<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecorationFornitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decoration_forniture', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('forniture_id')->nullable();
            $table->foreign('forniture_id')
                ->references('id')
                ->on('fornitures')
                ->onDelete('cascade');

            $table->unsignedBigInteger('decoration_id')->nullable();
            $table->foreign('decoration_id')
                ->references('id')
                ->on('decorations')
                ->onDelete('cascade');
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
        Schema::dropIfExists('decoration_forniture');
    }
}
