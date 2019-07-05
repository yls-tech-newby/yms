<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 09:42
 */

namespace App\Http\Controllers\Member;


use App\Exceptions\AlreadyRegisterException;
use App\Http\Controllers\Controller;
use App\Http\Vo\Member\LoginVo;
use App\Http\Vo\Member\RegisterVo;
use App\Services\Member\MemberService;
use App\Utils\BindingUtil;
use App\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{

    private $memberService;

    /**
     * AuthController constructor.
     * @param $memberService
     */
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }


    /**
     * 注册
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        /**
         * @var RegisterVo $registerVo
         */
        $registerVo = BindingUtil::bindingRequest($request, new RegisterVo);

        try {
            $user = $this->memberService->register($registerVo);
        } catch (AlreadyRegisterException $e) {
            return ResponseUtil::formatResponse(1001);
        }

        if ($user) {
            return ResponseUtil::formatResponse(0, $user);
        }
        return ResponseUtil::formatResponse(9999);
    }


    /**
     * 登录
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        /**
         * @var LoginVo $loginVo
         */
        $loginVo = BindingUtil::bindingRequest($request, new LoginVo);

        $token = $this->memberService->generateToken($loginVo);

        if ($token) {
            return ResponseUtil::formatResponse(0, $token);
        }
        return ResponseUtil::formatResponse(9999);
    }


    /**
     * 注销
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->memberService->invalidateToken();
        return ResponseUtil::formatResponse(0);
    }


    /**
     * 刷新token
     * @return JsonResponse
     */
    public function refreshToken(): JsonResponse
    {
        $token = $this->memberService->refreshToken();

        if ($token) {
            return ResponseUtil::formatResponse(0, $token);
        }
        return ResponseUtil::formatResponse(9999);
    }

}
