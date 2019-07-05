<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 16:23
 */

namespace App\Business\Member;


use App\Exceptions\AlreadyRegisterException;
use App\Http\Vo\Member\RegisterVo;
use App\Persistence\Model\User;
use App\Persistence\Repository\Member\UserRepository;
use App\Utils\TransferUtil;

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


    /**
     * 保存用户
     * @param RegisterVo $registerVo
     * @return User
     * @throws AlreadyRegisterException
     */
    public function saveUser(RegisterVo $registerVo)
    {
        $registerVo->password = md5($registerVo->password);
        $user = TransferUtil::objectToArray($registerVo);

        $existUsers = $this->userRepository->getByUsername($registerVo->username);
        if ($existUsers->count() > 0) {
            throw new AlreadyRegisterException;
        }

        return $this->userRepository->save($user);
    }


}
