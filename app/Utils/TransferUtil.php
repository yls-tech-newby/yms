<?php
/**
 * Created by PhpStorm.
 * User: chw
 * Date: 2019-07-05
 * Time: 15:21
 */

namespace App\Utils;


class TransferUtil
{

    public static function objectToArray($object)
    {
        return json_decode(json_encode($object), true);
    }

}
