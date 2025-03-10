<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class password_reset_tokens extends Model
{
    protected $table = 'password_reset_tokens';
    public $timestamps = false;

    protected $fillable = ['email', 'token', 'created_at'];
}
