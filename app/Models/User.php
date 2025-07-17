<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'money',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // CORREÇÃO: Use propriedade $casts, NÃO método casts()
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // Só se Laravel >= 10
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(OrdersModel::class, 'user_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $name) => ucfirst($name),
        );
    }
}
