<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class DayCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get( $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value === 0 ? __( '0 days' ) : ( $value === 1 ? __( '1 day' ) : ( $value > 2 ? sprintf( __( '%s days' ), $value ) : __( 'Unknown' ) ) );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set( $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
