<?php namespace App\Modules\User\Service;

use App\Modules\User\Repository\Contract\UserRepositoryInterface;
use App\Modules\User\Service\Contract\UserServiceInterface;
use App\Generics\GenericService;
use App\Traits\ResponseTypes;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Modules\User\Service
 */
class UserService extends GenericService implements UserServiceInterface
{
    use ResponseTypes;
    /**
     * @param UserRepositoryInterface $repository
     */
    function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Create user and return user
     * @param $request
     * @return mixed
     */
    public function insertGetUser($request)
    {
        $attributes = $this->mapUserFields($request);

        $id = $this->repository->insert($attributes);
        $user = $this->repository->getById($id);

        return $this->respond($user);
    }

    /**
     * Map user object fields
     * @param $request
     * @return array
     */
    private function mapUserFields($request)
    {
        $attributes = [];
        $attributes['username'] = $request->input('username');
        $attributes['email'] = $request->input('email');
        $attributes['password'] = Hash::make($request->input('password'));
        $attributes['created_at'] = $this->now;
        $attributes['active_at'] = $this->now;

        return $attributes;
    }


}
