<?php

use App\Utils\Enums\CabinStatus;
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
            $table->id();

            $table->foreignId('cabin_type_id')->constrained()->onDelete('no action')->onUpdate('no action');
            $table->string('cabin_status')->comment('Status should be ' . implode(', ', CabinStatus::values()));
            $table->string('name', 50)->nullable();
            $table->unsignedInteger('closed_from')->default(0);
            $table->unsignedInteger('closed_to')->default(0);
            $table->boolean('long_term')->default(false);
            $table->boolean('electric_meter')->default(false);
            $table->float('daily_rate')->default(0);
            $table->float('weekly_rate')->default(0);
            $table->float('four_weekly_rate')->default(0);

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
