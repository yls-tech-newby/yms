<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 10:22
 */

namespace App\Utils;


class ResponseUtil
{

    /**
     * 格式化api输出
     * @param int $code
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function formatResponse(int $code, $data = null): \Illuminate\Http\JsonResponse
    {
        app()->configure('code');

        return response()->json([
            'code' => $code,
            'message' => config("code.{$code}") ?: 'unknown code',
            'data' => $data
        ]);
    }

}
