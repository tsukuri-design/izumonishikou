/**
 * Not Supported IE
 */ 

/** ブラウザ名を取得 */ 
let getBrowser = function() {
    let ua = window.navigator.userAgent.toLowerCase();
    let ver = window.navigator.appVersion.toLowerCase();
    let name = 'unknown';

    if( ua.indexOf( 'msie' ) != -1 ) {
        if( ver.indexOf( 'msie 6.' ) != -1 ) {
            name = 'ie6';
        } else if( ver.indexOf( 'msie 7.' ) != -1 ) {
            name = 'ie7';
        } else if( ver.indexOf( 'msie 8.' ) != -1 ) {
            name = 'ie8';
        } else if( ver.indexOf( 'msie 9.' ) != -1 ) {
            name = 'ie9';
        } else if( ver.indexOf( 'msie 10.' ) != -1 ) {
            name = 'ie10';
        } else {
            name = 'ie';
        }
    } else if( ua.indexOf( 'trident/7' ) != -1 ) {
        name = 'ie11';
    } else if( ua.indexOf( 'chrome' ) != -1 ) {
        name = 'chrome';
    } else if( ua.indexOf( 'safari' ) != -1 ) {
        name = 'safari';
    } else if( ua.indexOf( 'opera' ) != -1 ) {
        name = 'opera';
    } else if( ua.indexOf( 'firefox' ) != -1 ) {
        name = 'firefox';
    }
    return name;
};


/**
 * 対応ブラウザかどうか判定
 * @param  browsers    対応ブラウザ名を配列で渡す(ie6、ie7、ie8、ie9、ie10、ie11、chrome、safari、opera、firefox)
 * @return             サポートしてるかどうかをtrue/falseで返す
 */

let is_browser_supported = function( browsers ) {
    let thusBrowser = getBrowser();
    for( let i=0; i < browsers.length; i++ ) {
        if( browsers[ i ] == thusBrowser ) {
            return true;
            exit;
        }
    }
    return false;
};

/** Create No javascript node */
function noie() {

    // Body innerを削除
    const body_inner = document.querySelector( '.body_inner' );
    while( body_inner.firstChild ){
        body_inner.removeChild( body_inner.firstChild );
    }
    
    // Create text for IE
    let noie = document.createElement( 'div' );
    noie.setAttribute( 'class', 'noie' );
    let text = document.createElement( 'div' );
    text.setAttribute( 'class', 'text' );
    text.innerHTML = '<h6 class="heading6">本サイトは、<br class="sp">Internet Explore以外の<br>ブラウザでご覧ください。</h6><p class="exp">Internet Exploreの開発元であるマイクロソフト社より、<br class="pc">旧式のウェブブラウザーInternet Explorer(IE)を使い続けるのは危険だとして、<br class="pc">その使用をやめ、最新のブラウザーを使用するよう求めています。<br>代わりのブラウザとして、Microsoft Edge、Google Chrome、<br class="pc">Firefox、Safari等の利用をおすすめいたします。</p>';
    noie.appendChild( text );

    body_inner.appendChild( noie );
};

/** Output */
if( is_browser_supported( [ 'ie', 'ie6', 'ie7', 'ie8', 'ie9', 'ie10', 'ie11' ] ) ) {
    console.log( 'ie' );
    document.addEventListener( 'DOMContentLoaded', noie() );
}
// else {
//     console.log( 'Not ie' );
//     document.addEventListener( 'DOMContentLoaded', noie() );
// }
