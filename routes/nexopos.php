<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get( '', [ DashboardController::class, 'home' ])->name( ns()->routeName( 'ns.dashboard.home' ) );

include dirname( __FILE__ ) . '/web/medias.php';
include dirname( __FILE__ ) . '/web/settings.php';
include dirname( __FILE__ ) . '/web/reports.php';
