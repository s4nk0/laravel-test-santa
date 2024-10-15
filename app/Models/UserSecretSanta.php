<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSecretSanta extends Pivot
{
    use HasFactory;

    protected $table = 'user_secret_santa';
    protected $fillable = [
        'secret_santa_id'
    ];
}
