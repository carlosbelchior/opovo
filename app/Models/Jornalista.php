<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornalista extends Model
{
    use HasFactory;
    protected $table = 'jornalistas';
    protected $fillable = ['nome', 'sobrenome', 'email', 'senha'];
    protected $hidden = ['senha', 'created_at', 'updated_at'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['senha'] = bcrypt($password);
    }

}
