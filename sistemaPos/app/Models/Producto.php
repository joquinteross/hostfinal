<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'fecha_vencimiento',
        'img_path',
        'estado',
        'precio',
        'marca_id',
        'presentacione_id',
        'categoria_id',
    ];
    public function compras()
{
    return $this->belongsToMany(Compra::class)
        ->withTimestamps()
        ->withPivot('cantidad', 'precio_compra', 'precio_venta');
}


    public function ventas()
    {
        return $this->belongsToMany(Venta::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_venta');
    }

   public function categorias()
{
    return $this->belongsToMany(Categoria::class, 'categoria_producto', 'producto_id', 'categoria_id');
}


    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function presentacione()
    {
        return $this->belongsTo(Presentacione::class);
    }

    public function handleUploadImage($image){
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        $file->move(public_path().'/img/productos/', $name);

        return $name;
    }
    use HasFactory;
}
