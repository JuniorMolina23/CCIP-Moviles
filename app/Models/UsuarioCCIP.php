<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class UsuarioCCIP extends Model
{
    use HasApiTokens, HasFactory;

    public function traslado()
    {
        return $this->hasMany(Traslado::class, 'usuario_id', 'id');
    }
    public function operaciones()
    {
        return $this->hasMany(Operaciones::class, 'usuario_id', 'id');
    }
    public function peaje()
    {
        return $this->hasMany(Peaje::class, 'usuario_id', 'id');
    }
    public function otros()
    {
        return $this->hasMany(Otros::class, 'usuario_id', 'id');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password'
    ];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
