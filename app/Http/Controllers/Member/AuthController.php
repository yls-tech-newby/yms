<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 09:42
 */

namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use App\Services\Member\MemberService;
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
     * 登录
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $username = $request->json('username', '');
        $password = $request->json('password', '');

        $token = $this->memberService->generateToken($username, $password);

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
