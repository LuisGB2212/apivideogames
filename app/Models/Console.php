<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'registered_id'
    ];

    public function userRegistered()
    {
        return $this->belongsTo(User::class, 'registered_id');
    }
}
