<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 16:26
 */

namespace App\Services\Member;


use App\Business\Member\UserBusiness;
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
     * 生成token
     * @param $username
     * @param $password
     * @return string
     */
    public function generateToken($username, $password): string
    {
        $user = $this->userBusiness->getByUsernameAndPwd($username, $password);

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
