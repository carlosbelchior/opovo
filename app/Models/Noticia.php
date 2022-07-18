<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    protected $table = 'noticias';
    protected $fillable = ['id_jornalista', 'id_tipo_noticia', 'titulo', 'descricao', 'corpo', 'imagem'];
    protected $hidden = ['created_at', 'updated_at'];
}
