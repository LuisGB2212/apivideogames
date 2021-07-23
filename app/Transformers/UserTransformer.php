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
            'contraseña' => (int) $user->password,
            'tipo_usuario' => (int) $user->type_user,
            'rol' => (int) $user->rol_id,
            'createdAt' => (string) $user->created_at,
            'updatedAt' => (string) $user->updated_at,
        ];
    }
}
