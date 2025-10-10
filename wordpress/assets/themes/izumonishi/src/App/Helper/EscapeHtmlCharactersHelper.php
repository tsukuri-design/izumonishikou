<?php declare(strict_types=1);

/**
 * Escapes HTML characters in a string.
 * 文字列内のHTML特殊文字をエスケープする。
 * 
 * @param string $string The string to escape.
 * @param string $encoding The character encoding. Default is 'UTF-8'.
 * @return string The escaped string. If input is not a string, returns null.
 */
function escapeHtmlCharacters($string, $encoding = 'UTF-8')
{
    if (!is_string($string)) {
        // Optionally, you can throw an exception or handle the error as required
        return null;
    }

    return htmlspecialchars($string, ENT_QUOTES, $encoding);
}
