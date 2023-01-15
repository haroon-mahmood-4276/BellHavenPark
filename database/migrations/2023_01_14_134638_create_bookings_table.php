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
            $table->uuid('id')->primary();

            $table->foreignUuid('cabin_id')->nullable()->constrained();
            $table->foreignUuid('customer_id')->nullable()->constrained();
            $table->unsignedInteger('booking_from')->default(0);
            $table->unsignedInteger('booking_to')->default(0);
            $table->foreignUuid('booking_source_id')->nullable()->constrained();
            $table->float('daily_rate')->nullable()->default(0);
            $table->float('daily_less_booking_percentage')->default(0);
            $table->float('weekly_rate')->default(0);
            $table->float('weekly_rate_less_booking_percentage')->default(0);
            $table->float('four_weekly_rate')->default(0);
            $table->float('four_weekly_less_booking_percentage')->default(0);
            $table->boolean('electricity_included');
            $table->string('check_in', 10)->nullable();
            $table->integer('check_in_date')->default(0);
            $table->integer('check_out_date')->default(0);
            $table->float('tax_percentage')->nullable();
            $table->float('tax_rate')->nullable();
            $table->string('status', 30)->nullable();
            $table->text('comments')->nullable();
            $table->string('payment', 5)->nullable();

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
