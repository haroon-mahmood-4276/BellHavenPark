<?php

use App\Utils\Enums\CustomerAccounts;
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
            $table->foreignId('customer_id')->constrained();

            $table->unsignedInteger('payment_from')->default(0);
            $table->unsignedInteger('payment_to')->default(0);
            
            $table->double('credit_amount', 8)->nullable()->default(0);
            $table->double('debit_amount', 8)->nullable()->default(0);
            
            $table->enum('account', CustomerAccounts::values())->nullable();

            $table->json('additional_data')->nullable();
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
