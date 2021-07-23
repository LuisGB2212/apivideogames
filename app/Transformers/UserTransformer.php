<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int) $user->id,
            'nombre' => (string) $user->name,
            'correo' => (string) $user->email,
            // 'contrasenia' => (string) $user->password,
            'tipo_usuario' => (string) $user->type_user,
            'rol' => (int) $user->rol_id,
            'createdAt' => (string) $user->created_at,
            'updatedAt' => (string) $user->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'nombre' => 'name',
            'correo' => 'email',
            'contrasenia' => 'password',
            'tipo_usuario' => 'type_user',
            'rol' => 'rol_id',
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
