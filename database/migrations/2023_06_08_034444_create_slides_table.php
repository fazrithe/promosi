<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('file_name')->nullable();
            $table->text('file')->nullable();
            $table->string('company_logo_name')->nullable();
            $table->text('company_logo_file')->nullable();
            $table->string('promo_logo_name')->nullable();
            $table->text('promo_logo_file')->nullable();
            $table->text('description')->nullable();
            $table->integer('timer')->nullable();
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
        Schema::dropIfExists('slides');
    }
}
