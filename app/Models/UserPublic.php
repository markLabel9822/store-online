<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserPublic extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'google_id',

    ];


    // Override the default method to return null for the 'password' attribute
    public function getAuthPassword()
    {
        return null;
    }

    // Override the default method to return an empty string for the 'remember_token' attribute
    public function getRememberToken()
    {
        return '';
    }

    // Override the default method to accept an empty string for the 'remember_token' attribute
    public function setRememberToken($value)
    {
        $this->attributes['remember_token'] = '';
    }

    // Override the default method to return null for the 'remember_token' attribute name
    public function getRememberTokenName()
    {
        return null;
    }
}
