<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresses', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100);
            $table->integer('amount');
            $table->float('value');
            $table->float('total_value');
            $table->string('category', 20);
            $table->string('owner', 20);
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
        Schema::dropIfExists('egresses');
    }
}
