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
        Schema::create('haven_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('haven_cabin_id')->nullable()->default(0);
            $table->integer('haven_customer_id')->nullable()->default(0);
            $table->dateTime('booking_from')->nullable();
            $table->dateTime('booking_to')->nullable();
            $table->integer('haven_booking_source_id')->nullable()->default(0);
            $table->integer('daily_rate')->nullable()->default(0);
            $table->integer('daily_less_booking_percentage')->nullable()->default(0);
            $table->integer('weekly_rate')->nullable()->default(0);
            $table->integer('weekly_rate_less_booking_percentage')->nullable()->default(0);
            $table->integer('four_weekly_rate')->nullable()->default(0);
            $table->integer('four_weekly_less_booking_percentage')->nullable()->default(0);
            $table->boolean('electricity_included')->nullable();
            $table->string('check_in', 10)->nullable();
            $table->dateTime('check_in_date')->nullable();
            $table->dateTime('check_out_date')->nullable();
            $table->float('tax_percentage')->nullable();
            $table->float('tax_rate')->nullable();
            $table->integer('booking_source')->nullable()->default(0);
            $table->string('status', 30)->nullable();
            $table->text('comments')->nullable();
            $table->string('payment', 5)->nullable();
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
        Schema::dropIfExists('haven_bookings');
    }
};
