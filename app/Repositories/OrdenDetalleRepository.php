<?php

namespace App\Repositories;

use App\Models\OrdenDetalle;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrdenDetalleRepository
 * @package App\Repositories
 * @version July 23, 2018, 7:28 am UTC
 *
 * @method OrdenDetalle findWithoutFail($id, $columns = ['*'])
 * @method OrdenDetalle find($id, $columns = ['*'])
 * @method OrdenDetalle first($columns = ['*'])
*/
class OrdenDetalleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cantidad'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrdenDetalle::class;
    }
}
