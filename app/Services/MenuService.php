<?php

namespace App\Services;

use TorMorten\Eventy\Facades\Eventy as Hook;

class MenuService
{
    protected $menus;

    public function buildMenus()
    {
        $this->menus = [
            'dashboard' => [
                'label' => __( 'Dashboard' ),
                'permissions' => [ 'read.dashboard' ],
                'icon' => 'la-home',
                'childrens' => [
                    'index' => [
                        'label' => __( 'Home' ),
                        'permissions' => [ 'read.dashboard' ],
                        'href' => ns()->url( '/dashboard' ),
                    ],
                ],
            ],
            'cloud-plans' => [
                'label' => __( 'Cloud Plans' ),
                'icon' => 'la-list-alt',
                'permissions' => [ 'manage.cloud-plans.all' ],
                'childrens' => [
                    'list' => [
                        'label' => __( 'List' ),
                        'href' => ns()->url( '/dashboard/cloud-plans' ),
                    ],
                    'create' => [
                        'label' => __( 'Create'),
                        'href' => ns()->url( '/dashboard/cloud-plans/create' ),
                    ],
                ],
            ],
            'cloud-instances' => [
                'label' => __( 'Cloud Instances' ),
                'icon' => 'la-cloud',
                'permissions' => [ 'manage.cloud-instances.all' ],
                'childrens' => [
                    'list' => [
                        'label' => __( 'List' ),
                        'href' => ns()->url( '/dashboard/cloud-instances' ),
                    ],
                    'create' => [
                        'label' => __( 'Deploy'),
                        'href' => ns()->url( '/dashboard/cloud-instances/create' ),
                    ],
                ],
            ],
            'my-cloud-instances' => [
                'label' => __( 'My Instances' ),
                'icon' => 'la-cloud-meatball',
                'permissions' => [ 'manage.cloud-instances.self' ],
                'childrens' => [
                    'list' => [
                        'label' => __( 'List' ),
                        'href' => ns()->url( '/dashboard/my-cloud-instances' ),
                    ],
                    'create' => [
                        'label' => __( 'New Instance' ),
                        'href' => ns()->url( '/dashboard/my-cloud-instances/create' ),
                    ],
                ],
            ],
            'modules' => [
                'label' => __( 'Modules' ),
                'icon' => 'la-plug',
                'permissions' => [ 'manage.modules' ],
                'childrens' => [
                    'modules' => [
                        'label' => __( 'List' ),
                        'href' => ns()->url( '/dashboard/modules' ),
                    ],
                    'upload-module' => [
                        'label' => __( 'Upload Module'),
                        'href' => ns()->url( '/dashboard/modules/upload' ),
                    ],
                ],
            ],
            'users' => [
                'label' => __( 'Users' ),
                'icon' => 'la-users',
                'childrens' => [
                    'profile' => [
                        'label' => __( 'My Profile' ),
                        'permissions' => [ 'manage.profile' ],
                        'href' => ns()->url( '/dashboard/users/profile' ),
                    ],
                    'users' => [
                        'label' => __( 'Users List' ),
                        'permissions' => [ 'read.users' ],
                        'href' => ns()->url( '/dashboard/users' ),
                    ],
                    'create-user' => [
                        'label' => __( 'Create User' ),
                        'permissions' => [ 'create.users' ],
                        'href' => ns()->url( '/dashboard/users/create' ),
                    ],
                ],
            ],
            'roles' => [
                'label' => __( 'Roles' ),
                'icon' => 'la-shield-alt',
                'permissions' => [ 'read.roles', 'create.roles', 'update.roles' ],
                'childrens' => [
                    'all-roles' => [
                        'label' => __( 'Roles' ),
                        'permissions' => [ 'read.roles' ],
                        'href' => ns()->url( '/dashboard/users/roles' ),
                    ],
                    'create-role' => [
                        'label' => __( 'Create Roles' ),
                        'permissions' => [ 'create.roles' ],
                        'href' => ns()->url( '/dashboard/users/roles/create' ),
                    ],
                    'permissions' => [
                        'label' => __( 'Permissions Manager' ),
                        'permissions' => [ 'update.roles' ],
                        'href' => ns()->url( '/dashboard/users/roles/permissions-manager' ),
                    ],
                ],
            ],
            'reports' => [
                'label' => __( 'Reports' ),
                'icon' => 'la-chart-pie',
                'permissions' => [
                    'nexopos.reports.sales',
                ],
                'childrens' => [
                    'sales' => [
                        'label' => __( 'Sale Report' ),
                        'permissions' => [ 'nexopos.reports.sales' ],
                        'href' => ns()->url( '/dashboard/reports/sales' ),
                    ],
                ],
            ],
            'settings' => [
                'label' => __( 'Settings' ),
                'icon' => 'la-cogs',
                'permissions' => [ 'manage.options' ],
                'childrens' => [
                    'general' => [
                        'label' => __( 'General' ),
                        'href' => ns()->url( '/dashboard/settings/general' ),
                    ],
                    'workers' => [
                        'label' => __( 'Workers' ),
                        'href' => ns()->url( '/dashboard/settings/workers' ),
                    ],
                    'reset' => [
                        'label' => __( 'Reset'),
                        'href' => ns()->url( '/dashboard/settings/reset' ),
                    ],
                    'about' => [
                        'label' => __( 'About' ),
                        'href' => ns()->url( '/dashboard/settings/about' ),
                    ],
                ],
            ],
        ];
    }

    /**
     * returns the list of available menus
     *
     * @return array of menus
     */
    public function getMenus()
    {
        $this->buildMenus();
        $this->menus = Hook::filter( 'ns-dashboard-menus', $this->menus );
        $this->toggleActive();

        return $this->menus;
    }

    /**
     * Will make sure active menu
     * is toggled
     *
     * @return void
     */
    public function toggleActive()
    {
        foreach ( $this->menus as $identifier => &$menu ) {
            if ( isset( $menu[ 'href' ] ) && $menu[ 'href' ] === url()->current() ) {
                $menu[ 'toggled' ] = true;
            }

            if ( isset( $menu[ 'childrens' ] ) ) {
                foreach ( $menu[ 'childrens' ] as $subidentifier => &$submenu ) {
                    if ( $submenu[ 'href' ] === url()->current() ) {
                        $menu[ 'toggled' ] = true;
                        $submenu[ 'active' ] = true;
                    }
                }
            }
        }
    }
}
