<?php

namespace App\Providers;

use App\Forms\ResetForm;
use App\Settings\AccountingSettings;
use App\Settings\CustomersSettings;
use App\Settings\GeneralSettings;
use App\Settings\InvoiceSettings;
use App\Settings\OrdersSettings;
use App\Settings\PosSettings;
use App\Settings\ReportsSettings;
use App\Settings\SuppliesDeliveriesSettings;
use App\Settings\WorkersSettings;
use Illuminate\Support\ServiceProvider;
use TorMorten\Eventy\Facades\Events as Hook;

class SettingsPageProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Hook::addFilter( 'ns.settings', function( $class, $identifier ) {
            switch ( $identifier ) {
                case 'ns.general': return new GeneralSettings;
                    break;
                case 'ns.reset':
                    return new ResetForm;
                    break;
            }

            return $class;
        }, 10, 2 );
    }
}
