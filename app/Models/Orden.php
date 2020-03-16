<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Orden
 * @package App\Models
 * @version July 23, 2018, 7:27 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection OrdenDetalle
 * @property integer numero
 * @property integer cliente_id
 * @property string telefono
 * @property string direccion
 * @property integer total
 */
class Orden extends Model
{
    use SoftDeletes;

    public $table = 'ordens';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'numero',
        'cliente_id',
        'direccion',
        'estado',
        'total'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'numero' => 'integer',
        'cliente_id' => 'integer',
        'direccion' => 'string',
        'total' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'telefono' => 'required|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'cliente_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ordenDetalles()
    {
        return $this->hasMany(\App\Models\OrdenDetalle::class);
    }
}
