<?php

/** 定数定義ファイルを読み込み */
require_once __DIR__ . '/inc/functions/defines.php';

/** SVGファイルを読み込み */
require_once __DIR__ . '/inc/functions/svgs/index.php';

/** MVC機能の追加 */
require_once __DIR__ . '/inc/functions/mvc.php';

/** HTML Specialchars エスケープ用関数 */
require_once __DIR__ . '/inc/functions/html_escape.php';

/** Javascriptがあったらエスケープ処理 WYSIWIGなどのEditor用 */
require_once __DIR__ . '/inc/functions/javascript_escape.php';

/** brタグだけを許可して他はエスケープ処理する */
require_once __DIR__ . '/inc/functions/allow_br_escape.php';

/** exists function */
require_once __DIR__ . '/inc/functions/exists.php';

/** 画像カスタムアウトプット(Webp) */
require_once __DIR__ . '/inc/functions/picture.php';

require_once __DIR__ . '/inc/functions/link_settings.php';
