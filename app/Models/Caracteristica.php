<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    public function categoria()
    {
        return $this->hasOne(Categoria::class);
    }

    public function marca()
    {
        return $this->hasOne(Marca::class);
    }

    public function presentacione()
    {
        return $this->hasOne(Presentacione::class);
    }
    public function role()
    {
    return $this->hasOne(Role::class);
    }

    use HasFactory;
}
