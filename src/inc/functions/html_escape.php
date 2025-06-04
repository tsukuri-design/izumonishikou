<?php

/**
 * Set escape function
 * エスケープ用関数
 */

function htmlEsc($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
