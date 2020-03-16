<?php

namespace App\Repositories;

use App\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version July 24, 2018, 4:31 pm UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'telefono'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
