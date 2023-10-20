<?php

/**
 * NexoPOS Controller
 *
 * @since  1.0
 **/

namespace App\Http\Controllers;

use App\Classes\Hook;
use App\Classes\Output;
use App\Models\Customer;
use App\Models\DashboardDay;
use App\Models\Order;
use App\Models\Role;
use App\Services\DateService;
use App\Services\MenuService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $menuService;

    protected $dateService;

    public function __construct()
    {
        $this->dateService = app()->make( DateService::class );
        $this->menuService = app()->make( MenuService::class );
    }

    public function home()
    {
        return view( 'pages.dashboard.home', [
            'menus' => $this->menuService,
            'title' => __( 'Dashboard' ),
        ]);
    }

    protected function view( $path, $data = [])
    {
        return view( $path, array_merge([
            'menus' => $this->menuService,
        ], $data ));
    }

    /**
     * Will create a hook that will inject
     * Output object on the footer. Useful to create
     * custom output per page.
     *
     * @param string $name
     * @return void
     */
    public function hookOutput( $name )
    {
        Hook::addAction( 'ns-dashboard-footer', function( Output $output ) use ( $name ) {
            Hook::action( $name, $output );
        }, 15 );
    }
}
