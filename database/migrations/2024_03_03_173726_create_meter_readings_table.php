<?php

use App\Utils\Enums\MeterTypes;
use App\Utils\Enums\UtilityBillsStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cabin_id')->constrained();
            $table->unsignedInteger('reading')->default(0);
            $table->unsignedInteger('reading_date')->default(now()->timestamp);
            $table->enum('meter_type', MeterTypes::values());
            $table->text('comments')->nullable();
            $table->enum('status', UtilityBillsStatus::values())->nullable();

            $table->unsignedInteger('created_at')->nullable();
            $table->unsignedInteger('updated_at')->nullable();
            $table->unsignedInteger('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_readings');
    }
};
