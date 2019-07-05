<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 16:05
 */

namespace App\Persistence\Repository\Member;


use App\Persistence\Model\User;

class UserRepository
{

    /**
     * 根据用户名和密码获取用户信息
     * @param $username
     * @param $password
     * @return User
     */
    public function getByUsernameAndPwd($username, $password)
    {
        return User::where([
            'username' => $username,
            'password' => $password
        ])->first();
    }

}
