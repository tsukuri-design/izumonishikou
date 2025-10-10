module.exports = {
    "plugins": [
        "stylelint-prettier",
    ],
    "extends": [
        "stylelint-config-recess-order",
        "stylelint-config-sass-guidelines",
        "stylelint-config-standard",
        "stylelint-config-standard-scss",
        "stylelint-prettier/recommended",
    ],
    "rules": {
        "prettier/prettier": [true, {
            "singleQuote": true,
            "tabWidth": 4
        }],
        "block-opening-brace-newline-after": "always", // { の後は改行
        "block-closing-brace-newline-before": "always", // } の前は改行
        "block-opening-brace-space-before": "always",　// { の前は空白
        "color-hex-case": ["lower"], // hexの表記を小文字に
        "indentation": 4, // インデント
        "keyframes-name-pattern": "^[a-z][a-zA-Z0-9]+$",//keyframeはキャメルケース
        "max-nesting-depth": 4, // 改装は4まで
        "media-feature-range-notation": "prefix", // @media を max-width / min-widthを使用
        "no-descending-specificity": null, // 順番は
        "selector-class-pattern": "^([a-z][a-z0-9]*)([_-]+[a-z0-9]+)*$", // クラス名はスネークケースと_の連続のみ許容する
        "selector-max-compound-selectors": 6, // 複合セレクターの数の制限
        "selector-max-id": 1, // IDセレクターの数制限
        "selector-type-case": "lower",
        "scss/at-function-pattern": "^[a-z][a-zA-Z0-9]+$", // 関数名はキャメルケースのみ許容する
        "scss/at-mixin-pattern": "^([a-z][a-z0-9]*)(_[a-z0-9]+)*$", // mixin名はスネークケースのみ許容する
        "scss/dollar-variable-pattern": "^([a-z][a-z0-9]*)(_[a-z0-9]+)*$", // 変数名はスネークケースのみ許容する
    },
    "overrides": [
        {
            "files": ["**/*.scss"],
            "customSyntax": "postcss-scss"
        }
    ]
};