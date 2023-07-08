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
            $table->id();

            $table->foreignId('booking_id')->nullable()->constrained();
            $table->foreignId('payment_method_id')->nullable()->constrained();
            $table->unsignedInteger('payment_from')->default(0);
            $table->unsignedInteger('payment_to')->default(0);
            $table->double('credit', 8)->nullable()->default(0);
            $table->double('debit', 8)->nullable()->default(0);
            $table->double('balance', 8)->nullable()->default(0);
            $table->string('status', 30)->nullable();
            $table->string('payment_type', 30)->nullable();
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
