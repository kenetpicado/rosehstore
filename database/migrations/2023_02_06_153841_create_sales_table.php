<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')
                ->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');

            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->string('description', 100)->fulltext();
            $table->integer('quantity');
            $table->float('price');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
