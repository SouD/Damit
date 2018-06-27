<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uri');
            $table->string('disk')
                ->nullable(); // Disk driver (cloudfront, s3, etc...)
            $table->integer('size')
                ->nullable();
            $table->string('original_name')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
