<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['caracteristica_id'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }
    use HasFactory;
}
