<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrdenDetalle
 * @package App\Models
 * @version July 23, 2018, 7:28 am UTC
 *
 * @property \App\Models\Orden orden
 * @property \App\Models\Producto producto
 * @property string cantidad
 * @property integer precio
 * @property integer subtotal
 * @property integer orden_id
 * @property integer producto_id
 */
class OrdenDetalle extends Model
{
    use SoftDeletes;

    public $table = 'orden_detalles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cantidad',
        'precio',
        'subtotal',
        'orden_id',
        'producto_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cantidad' => 'string',
        'precio' => 'integer',
        'subtotal' => 'integer',
        'orden_id' => 'integer',
        'producto_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cantidad' => 'required',
        'precio' => 'required',
        'subtotal' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orden()
    {
        return $this->belongsTo(\App\Models\Orden::class, 'orden_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class, 'producto_id', 'id');
    }
}
