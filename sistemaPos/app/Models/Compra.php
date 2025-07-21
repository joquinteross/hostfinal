<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Compra extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable =[

        'fecha_hora',
        'impuesto',
        'numero_comprobante',
        'total',
        'comprobante_id',
        'proveedore_id',
        'user_id', //Se deja asi para testear agregar compras, ya cuando se tenga el login se cambia
        

    ];
    public function proveedore(): BelongsTo
    {
        return $this->belongsTo(Proveedore::class);
    }

    public function comprobante(): BelongsTo
    {
        return $this->belongsTo(Comprobante::class);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class)->withTimestamps()
            ->withPivot('cantidad', 'precio_compra', 'precio_venta');
    }

}
