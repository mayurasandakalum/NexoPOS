<?php

namespace App\Providers;

use App\Crud\RolesCrud;
use App\Crud\UserCrud;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use TorMorten\Eventy\Facades\Events as Hook;

class CrudServiceProvider extends ServiceProvider
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
        /**
         * every crud class on the system should be
         * added here in order to be available and supported.
         */
        Hook::addFilter( 'ns-crud-resource', function( $namespace ) {
            /**
             * We'll attempt autoloading crud that explicitely
             * defined they want to be autoloaded. We expect classes to have 2
             * constant: AUTOLOAD=true, IDENTIFIER=<string>.
             */
            $classes = Cache::get( 'crud-classes', function( ) {
                $files = collect( Storage::disk( 'ns' )->files( 'app/Crud' ) );

                return $files->map( fn( $file ) => 'App\Crud\\' . pathinfo( $file )[ 'filename' ] )
                    ->filter( fn( $class ) => ( defined( $class . '::AUTOLOAD' ) && defined( $class . '::IDENTIFIER' ) ) );
            });

            /**
             * We pull the cached classes and checks if the
             * class has autoload and identifier defined.
             */
            $class = collect( $classes )->filter( fn( $class ) => $class::AUTOLOAD && $class::IDENTIFIER === $namespace );

            if ( $class->count() === 1 ) {
                return $class->first();
            }

            /**
             * We'll still allow users to define crud
             * manually from this section.
             */
            return match ( $namespace ) {
                'ns.users' => UserCrud::class,
                'ns.roles' => RolesCrud::class,
                default => $namespace,
            };
        });
    }
}
