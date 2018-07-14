<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('symbol')
                ->nullable();
            $table->unsignedInteger('factor')
                ->default(100); // Use 1 for Yen et. al.
            $table->unsignedInteger('decimals')
                ->default(2); // Use 0 for Yen et. al.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
