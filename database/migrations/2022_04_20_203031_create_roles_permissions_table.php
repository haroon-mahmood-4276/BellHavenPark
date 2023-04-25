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
        Schema::create('haven_roles_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'haven_role_id' )->nullable();
            $table->unsignedBigInteger( 'haven_permission_id' )->nullable();
            $table->boolean( 'view' );
            $table->boolean( 'store' );
            $table->boolean( 'update' );
            $table->boolean( 'destroy' );
            $table->boolean( 'all' );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('haven_roles_permissions');
    }
};
