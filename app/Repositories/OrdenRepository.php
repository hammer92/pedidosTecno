<?php

namespace App\Repositories;

use App\Models\Orden;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrdenRepository
 * @package App\Repositories
 * @version July 23, 2018, 7:27 am UTC
 *
 * @method Orden findWithoutFail($id, $columns = ['*'])
 * @method Orden find($id, $columns = ['*'])
 * @method Orden first($columns = ['*'])
*/
class OrdenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numero',
        'telefono',
        'direccion',
        'estado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Orden::class;
    }
}
