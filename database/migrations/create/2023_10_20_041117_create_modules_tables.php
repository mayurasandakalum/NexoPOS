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
        Schema::create('cloud_instances_modules', function (Blueprint $table) {
            $table->id();
            $table->string( 'name' );
            $table->text( 'description' )->nullable();
            $table->string( 'last_version' );
            $table->datetime( 'last_update' )->nullable();
            $table->boolean( 'active' )->default( true ); // if it can downloaded or used during udpates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_instances_modules');
    }
};
