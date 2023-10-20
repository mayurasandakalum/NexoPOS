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
        Schema::create('cloud_instances', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->string( 'slug' ); // is used for subdomain
            $table->string( 'domain' )->nullable(); // is used if a full domain is selected for that isntance
            $table->boolean( 'uses_subdomain' )->default( true );
            $table->string( 'status' )->default( 'disabled' ); // "disabled", "expired", "available", "maintenance"
            $table->string( 'php_version' )->nullable();
            $table->string( 'disk_usage' )->default(0); // define the disk usage
            $table->float( 'disk_limit' )->default(0); // unlimited limit
            $table->integer( 'user_id' ); // the user the instance is assigned to
            $table->integer( 'author' ); // who created (can also be the customer it's assigned to)
            $table->timestamps();
        });

        Schema::create( 'cloud_instances_subscriptions', function( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'hosting_instance_id' );
            $table->boolean( 'active' )->default( false );
            $table->datetime( 'plan_starting_date' )->nullable();
            $table->datetime( 'plan_ending_date' )->nullable();
            $table->datetime( 'trial_starting_date' )->nullable();
            $table->datetime( 'trial_ending_date' )->nullable();
            $table->float( 'cost' )->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloud_instances');
        Schema::dropIfExists('cloud_instances_subscriptions');
    }
};
