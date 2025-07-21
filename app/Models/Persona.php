<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{ 
    protected $guarded = ['id'];
    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function proveedore()
    {
        return $this->hasOne(Proveedore::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }
    use HasFactory;
}
