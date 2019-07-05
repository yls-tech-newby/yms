<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 16:23
 */

namespace App\Business\Member;


use App\Persistence\Model\User;
use App\Persistence\Repository\Member\UserRepository;

class UserBusiness
{

    private $userRepository;

    /**
     * UserBusiness constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * 根据用户名和密码获取用户信息
     * @param $username
     * @param $password
     * @return User
     */
    public function getByUsernameAndPwd($username, $password): User
    {
        return $this->userRepository->getByUsernameAndPwd($username, $password);
    }


}
