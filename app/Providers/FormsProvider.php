<?php

namespace App\Providers;

use App\Fields\AuthLoginFields;
use App\Fields\AuthRegisterFields;
use App\Fields\NewPasswordFields;
use App\Fields\PasswordLostFields;
use App\Fields\ResetFields;
use App\Forms\ResetForm;
use App\Forms\UserProfileForm;
use Illuminate\Support\ServiceProvider;
use TorMorten\Eventy\Facades\Events as Hook;

class FormsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // ...
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Hook::addFilter( 'ns.forms', function( $class, $identifier ) {
            switch ( $identifier ) {
                case 'ns.user-profile':
                    return new UserProfileForm;
                    break;
                case 'ns.reset':
                    return new ResetForm;
                    break;
            }

            return $class;
        }, 10, 2 );

        Hook::addFilter( 'ns.fields', function( $class, $identifier ) {
            switch ( $class ) {
                case AuthLoginFields::getIdentifier():
                    return new AuthLoginFields;
                    break;
                case PasswordLostFields::getIdentifier():
                    return new PasswordLostFields;
                    break;
                case NewPasswordFields::getIdentifier():
                    return new NewPasswordFields;
                    break;
                case AuthRegisterFields::getIdentifier():
                    return new AuthRegisterFields;
                    break;
                case ResetFields::getIdentifier():
                    return new ResetFields;
                    break;
                default:
                    return $class;
                    break;
            }
        }, 10, 2 );
    }
}
