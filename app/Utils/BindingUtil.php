<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-04
 * Time: 17:03
 */

namespace App\Utils;


use App\Http\Vo\Vo;
use Illuminate\Http\Request;

class BindingUtil
{

    /**
     * @param Request $request
     * @param $vo
     * @return mixed
     */
    public static function bindingRequest(Request $request, $vo)
    {
        foreach ($vo as $key => $value) {
            $vo->$key = $request->json($key);
        }

        return $vo;
    }

}
