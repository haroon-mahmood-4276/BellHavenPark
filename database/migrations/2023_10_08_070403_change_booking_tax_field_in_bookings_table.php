<?php

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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('tax');
            $table->foreignId('booking_tax_id')->nullable()->constrained('booking_taxes')->after('check_out_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['booking_tax_id']);
            $table->dropColumn('booking_tax_id');
            $table->unsignedSmallInteger('tax')->default(0)->after('check_out_date');
        });
    }
};
