<?php declare(strict_types=1);
/** 
 * サイトヘルスでテーマとプラグインの自動更新に関する致命的なエラーが出るのをなくす 
 */

/** Disable plugins auto-update UI elements. */
add_filter('plugins_auto_update_enabled', '__return_false');
/** Disable themes auto-update UI elements. */
add_filter('themes_auto_update_enabled', '__return_false');
/** Disable all plugin auto-updates. */
add_filter('auto_update_plugin', '__return_false');
/** Disable all theme auto-updates. */
add_filter('auto_update_theme', '__return_true');
