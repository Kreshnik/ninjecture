<?php

namespace App\Modules\User\Repository;

use App\Generics\GenericRepository;
use App\Models\User;
use App\Modules\User\Repository\Contract\UserRepositoryInterface;

/**
 * Class UserRepository.
 */
class UserRepository extends GenericRepository implements UserRepositoryInterface
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
