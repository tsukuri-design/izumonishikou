<?php declare(strict_types=1);

/**
 * Javascriptがあったらエスケープ処理
 * WYSIWIGなどのEditor用
 */

function jsEsc($s)
{
    if (preg_match('/script/', $s)) {
        return escapeHtmlCharacters($s);
    }

    return $s;
}
