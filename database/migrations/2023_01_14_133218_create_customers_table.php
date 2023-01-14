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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->text('address')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->foreignId('haven_international_id_id')->constrained();
            $table->string('haven_international_id_details')->nullable();
            $table->string('haven_international_id_address')->nullable();
            $table->text('comments')->nullable();
            $table->text('tenants')->nullable();
            $table->string('referenced_by')->nullable();

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
        Schema::dropIfExists('customers');
    }
};
