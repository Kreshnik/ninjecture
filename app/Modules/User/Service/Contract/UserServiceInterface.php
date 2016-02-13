<?php

namespace App\Modules\User\Service\Contract;

/**
 * Interface UserServiceInterface.
 */
interface UserServiceInterface
{
    /**
     * Insert and return ID.
     *
     * @param $request
     *
     * @return mixed
     */
    public function insertGetUser($request);
}
