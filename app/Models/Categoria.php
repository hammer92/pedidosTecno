<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categoria
 * @package App\Models
 * @version July 23, 2018, 7:23 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Productos
 * @property string titulo
 */
class Categoria extends Model
{
    use SoftDeletes;

    public $table = 'categorias';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'titulo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'titulo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'titulo' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productos()
    {
        return $this->hasMany(\App\Models\Productos::class);
    }
}
