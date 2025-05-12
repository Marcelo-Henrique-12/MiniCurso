<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
   protected $table = 'produtos';

   protected $fillable = [
        'nome',
        'foto',
        'valor',
        'categoria_id',
        'quantidade'
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getFotoUrlAttribute()
    {
        return asset('storage/' . $this->foto);
    }
}
