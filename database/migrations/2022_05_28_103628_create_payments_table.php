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
        Schema::create('haven_payments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger( 'haven_user_id' )->nullable()->default(0);
            $table->tinyInteger( 'haven_booking_id' )->nullable()->default(0);
            $table->tinyInteger('haven_customer_id')->nullable()->default(0);
            $table->double('payment_credit', 8)->nullable()->default(0);
            $table->double('payment_debit', 8)->nullable()->default(0);
            $table->double('payment_balance', 8)->nullable()->default(0);
            $table->string('status', 30)->nullable();
            $table->string('type', 30)->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('haven_payments');
    }
};
