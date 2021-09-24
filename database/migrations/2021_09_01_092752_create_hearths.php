<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHearths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hearths', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('path');
            $table->string('seconds');
            $table->string('graphic');
            $table->boolean('deviations')->default(false);
            $table->integer('deviations_type')->nullable();
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
        Schema::dropIfExists('hearths');
    }
}
