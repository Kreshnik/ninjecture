<?php

namespace App\Modules\User\Repository;


use App\Modules\User\Repository\Contract\UserRepositoryInterface;
use App\Generics\GenericRepository;
use App\Models\User;


/**
 * Class UserRepository
 * @package App\Modules\User\Repository
 */
class  UserRepository extends GenericRepository implements UserRepositoryInterface
{
    /**
     * @param User $model
     */
    function __construct(User $model)
    {
        $this->model = $model;
    }


}
