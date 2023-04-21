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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // $table->foreignUuid('user_id')->nullable()->constrained();
            // $table->foreignUuid('customer_id')->nullable()->constrained();
            $table->foreignUuid('booking_id')->nullable()->constrained();
            $table->double('payment_credit', 8)->nullable()->default(0);
            $table->double('payment_debit', 8)->nullable()->default(0);
            $table->double('payment_balance', 8)->nullable()->default(0);
            $table->string('status', 30)->nullable();
            $table->string('type', 30)->nullable();
            $table->text('comments')->nullable();

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
        Schema::dropIfExists('payments');
    }
};
