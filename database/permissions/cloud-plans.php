<?php

use App\Models\Permission;

$medias = Permission::firstOrNew([ 'namespace' => 'manage.cloud-plans' ]);
$medias->name = __( 'Manage Cloud Plans' );
$medias->namespace = 'manage.cloud-plans.all';
$medias->description = __( 'Let the user manage cloud plans.' );
$medias->save();
