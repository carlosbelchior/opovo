<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticiaTipo extends Model
{
    use HasFactory;
    protected $table = 'noticias_tipo';
    protected $fillable = ['id_jornalista', 'nome'];
    protected $hidden = ['created_at', 'updated_at'];
}
