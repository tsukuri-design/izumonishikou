<?php

/**
 * Javascriptがあったらエスケープ処理
 * WYSIWIGなどのEditor用
 */

function jsEsc($s)
{
    if (preg_match('/script/', $s)) {
        return htmlEsc($s);
    }

    return $s;
}
