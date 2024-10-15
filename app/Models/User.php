<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //модель отвечающий за назначение тайной санты
    public function santaRelation()
    {
        return $this->hasOne(UserSecretSanta::class,'id');
    }

    //санта
    public function santa()
    {
        return $this->hasOneThrough(User::class,UserSecretSanta::class,'id','id','id','secret_santa_id');
    }

    //подопечный
    public function ward()
    {
        return $this->hasOneThrough(User::class,UserSecretSanta::class,'secret_santa_id','id','id','id');
    }
}
