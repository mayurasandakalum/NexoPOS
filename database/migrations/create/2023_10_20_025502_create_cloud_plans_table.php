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
        Schema::create('cloud_plans', function (Blueprint $table) {
            $table->id();
            $table->string( 'name' );
            $table->text( 'description' )->nullable();
            $table->float( 'cost' )->nullable();
            $table->boolean( 'has_trial' )->default( true );
            $table->float( 'disk_space' )->default(0); // unlimited
            $table->integer( 'trial_duration' )->default(0); 
            $table->integer( 'author' );
            $table->timestamps();
        });

        Schema::create( 'cloud_plans_modules', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'module_id' );
            $table->integer( 'cloud_plan_id' );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_plans');
    }
};
