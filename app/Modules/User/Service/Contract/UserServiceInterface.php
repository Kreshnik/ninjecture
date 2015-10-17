<?php
namespace App\Modules\User\Service\Contract;

/**
 * Interface UserServiceInterface
 * @package App\Modules\User\Service\Contract
 */
interface UserServiceInterface
{

    /**
     * Insert and return ID
     * @param $request
     * @return mixed
     */
    public function insertGetUser($request);

}