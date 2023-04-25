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
        Schema::create('haven_cabins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('haven_cabin_type_id')->constrained()->onDelete('no action')->onUpdate('no action');
            $table->foreignId('haven_cabin_status_id')->constrained()->onDelete('no action')->onUpdate('no action');
            $table->string('name', 50)->nullable();
            $table->boolean('long_term')->nullable();
            $table->boolean('electric_meter')->nullable();
            $table->dateTime('till')->nullable();
            $table->float('daily_rate')->default(0);
            $table->float('weekly_rate')->default(0);
            $table->float('electric_daily_rate')->default(0);
            $table->float('electric_weekly_rate')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('haven_cabins');
    }
};
