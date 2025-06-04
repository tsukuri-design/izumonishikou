<?php

/**
 * brタグだけを許可して他はエスケープ処理する
 * Allow only "br" tags and escape the others.
 *
 * @param bool $nl2br falseだとnlをbrに変換しない
 */

function allowBrEsc($str, $nl2br = true)
{
    if ($nl2br === true) {
        $str     = nl2br($str);
    }
    $str     = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    $search  = array('&lt;br&gt;', '&lt;br/&gt;', '&lt;br%20/&gt;', '&lt;br /&gt;');
    $replace = array('<br>', '<br>', '<br>', '<br>');
    $str     = str_replace($search, $replace, $str);

    return $str;
}
