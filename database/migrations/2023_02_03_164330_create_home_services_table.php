<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_services', function (Blueprint $table) {
            $table->unsignedBigInteger('homes_id');
            $table->foreign('homes_id')->references('id')->on('homes')->cascadeOnDelete();


            $table->unsignedBigInteger('services_id');
            $table->foreign('services_id')->references('id')->on('services')->cascadeOnDelete();

            $table->primary(['homes_id', 'services_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_services');
    }
};
