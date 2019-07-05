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


    /**
     * 保存用户
     * @param array $user
     * @return User
     */
    public function save($user)
    {
        return User::create($user);
    }


    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->save();
    }


    /**
     * 根据用户名获取用户信息
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByUsername($username)
    {
        return User::query()->where('username', $username)->get();
    }

}
