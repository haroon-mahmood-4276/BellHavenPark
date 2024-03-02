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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_number')->unique();

            $table->foreignId('cabin_id')->nullable()->constrained();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->unsignedInteger('booking_from')->default(0);
            $table->unsignedInteger('booking_to')->default(0);
            $table->foreignId('booking_source_id')->nullable()->constrained();
            $table->float('daily_rate')->nullable()->default(0);
            $table->float('daily_less_booking_percentage')->default(0);
            $table->float('weekly_rate')->default(0);
            $table->float('weekly_rate_less_booking_percentage')->default(0);
            $table->float('monthly_rate')->default(0);
            $table->float('monthly_less_booking_percentage')->default(0);
            $table->string('check_in', 10)->nullable();
            $table->unsignedInteger('check_in_date')->default(0);
            $table->unsignedInteger('check_out_date')->default(0);
            
            $table->boolean('bill_for_electricity')->default(false);
            $table->boolean('bill_for_gas')->default(false);
            $table->boolean('bill_for_water')->default(false);
            
            $table->float('tax')->nullable();
            $table->text('comments')->nullable();
            $table->string('payment', 5)->nullable();
            $table->string('status', 30)->nullable();

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
        Schema::dropIfExists('bookings');
    }
};
