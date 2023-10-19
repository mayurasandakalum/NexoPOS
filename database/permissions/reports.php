<?php

use App\Models\Permission;

if ( defined( 'NEXO_CREATE_PERMISSIONS' ) ) {
    $permission = Permission::firstOrNew([ 'namespace' => 'nexopos.reports.sales' ]);
    $permission->name = __( 'See Sale Report' );
    $permission->namespace = 'nexopos.reports.sales';
    $permission->description = __( 'Let you see the sales report' );
    $permission->save();
}
