<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 16:26
 */

namespace App\Services\Member;


use App\Business\Member\UserBusiness;
use App\Http\Vo\Member\LoginVo;
use App\Http\Vo\Member\RegisterVo;
use App\Persistence\Model\User;
use Illuminate\Support\Facades\Auth;

class MemberService
{

    private $userBusiness;

    /**
     * MemberService constructor.
     * @param $userBusiness
     */
    public function __construct(UserBusiness $userBusiness)
    {
        $this->userBusiness = $userBusiness;
    }


    /**
     * 注册
     * @param RegisterVo $registerVo
     * @return User
     * @throws \App\Exceptions\AlreadyRegisterException
     */
    public function register(RegisterVo $registerVo)
    {
        return $this->userBusiness->saveUser($registerVo);
    }


    /**
     * 生成token
     * @param LoginVo $loginVo
     * @return string
     */
    public function generateToken(LoginVo $loginVo): string
    {
        $user = $this->userBusiness->getByUsernameAndPwd($loginVo->username, $loginVo->password);

        return Auth::login($user);
    }


    /**
     * 过期token
     * @return void
     */
    public function invalidateToken(): void
    {
        Auth::invalidate(true);
    }


    /**
     * 刷新token
     * @return string
     */
    public function refreshToken(): string
    {
        return Auth::refresh(true, true);
    }


}
