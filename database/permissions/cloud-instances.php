<?php
use App\Models\Permission;

$medias = Permission::firstOrNew([ 'namespace' => 'manage.cloud-instances' ]);
$medias->name = __( 'Manage Cloud Instances' );
$medias->namespace = 'manage.cloud-instances.all';
$medias->description = __( 'Let the user manage cloud instances.' );
$medias->save();

$medias = Permission::firstOrNew([ 'namespace' => 'manage.self-cloud-instances' ]);
$medias->name = __( 'Manage Self Cloud Instances' );
$medias->namespace = 'manage.cloud-instances.self';
$medias->description = __( 'Let the user manage self cloud instances.' );
$medias->save();