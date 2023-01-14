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
        Schema::create('cabins', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 50)->nullable();
            $table->boolean('long_term')->nullable();
            $table->boolean('electric_meter')->nullable();
            $table->dateTime('till')->nullable();
            $table->float('daily_rate')->default(0);
            $table->float('weekly_rate')->default(0);
            $table->float('electric_daily_rate')->default(0);
            $table->float('electric_weekly_rate')->default(0);

            $table->unsignedInteger('created_at')->nullable();
            $table->unsignedInteger('updated_at')->nullable();
            $table->unsignedInteger('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabins');
    }
};
