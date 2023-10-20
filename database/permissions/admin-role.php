<?php

use App\Models\Permission;
use App\Models\Role;

$admin = Role::firstOrNew([ 'namespace' => 'admin' ]);
$admin->name = __( 'Administrator' );
$admin->namespace = 'admin';
$admin->locked = true;
$admin->description = __( 'Master role which can perform all actions like create users, install/update/delete modules and much more.' );
$admin->save();
$admin->addPermissions([
    'create.users',
    'read.users',
    'update.users',
    'delete.users',
    'create.roles',
    'read.roles',
    'update.roles',
    'delete.roles',
    'update.core',
    'manage.profile',
    'manage.options',
    'manage.modules',
    'read.dashboard',
]);

Permission::where( 'namespace', 'like', '%.self' )->get()->each( function( $permission ) use ( $admin ) {
    $admin->addPermissions( $permission );
});

Permission::where( 'namespace', 'like', '%.all' )->get()->each( function( $permission ) use ( $admin ) {
    $admin->addPermissions( $permission );
});