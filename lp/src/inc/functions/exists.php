<?php

/**
 * exists function
 * isset且つ空白文字じゃない場合
 */

function exists($var)
{
    if (isset($var) && $var != '') {
        return true;
    } else {
        return false;
    }
}
