<?php
use App\Models\Permission;

$medias = Permission::firstOrNew([ 'namespace' => 'manage.cloud-subscriptions' ]);
$medias->name = __( 'Manage Cloud Subscriptions' );
$medias->namespace = 'manage.cloud-subscriptions.all';
$medias->description = __( 'Let the user manage cloud subscriptions.' );
$medias->save();

$medias = Permission::firstOrNew([ 'namespace' => 'manage.self-cloud-subscriptions' ]);
$medias->name = __( 'Manage Self Subscriptions' );
$medias->namespace = 'manage.cloud-subscriptions.self';
$medias->description = __( 'Let the user manage self subscriptions.' );
$medias->save();