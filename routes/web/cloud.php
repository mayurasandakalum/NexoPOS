<?php

use App\Http\Controllers\CloudPlanController;
use Illuminate\Support\Facades\Route;

Route::get( '/cloud-plans', [ CloudPlanController::class, 'showCloudPlans' ])
    ->name( ns()->routeName( 'ns.dashboard.medias' ) )
    ->middleware( 'ns.restrict:manage.cloud-plans.all' );

Route::get( '/cloud-plans/create', [ CloudPlanController::class, 'createCloudPlans' ])
    ->name( ns()->routeName( 'ns.dashboard.medias' ) )
    ->middleware( 'ns.restrict:manage.cloud-plans.all' );