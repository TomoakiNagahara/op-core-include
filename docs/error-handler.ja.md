# Error Handler

この文書は `asset/core/include/Error.php` の技術的な挙動を説明します。

## 目的

`Error.php` は、framework 全体のエラー取得 handler を bootstrap のできるだけ早い段階で登録するためのファイルです。

役割は次です。

- 到達可能な PHP エラーを取得する
- 未捕捉の例外および未捕捉の `Throwable` を取得する
- shutdown 時の fatal 系エラーを取得する
- 取得した内容を `OP\Error::Set()` に渡す
- shutdown 時に最終通知処理を起動する

## `asset/config/php.php` との関係

現行の application 設定では次を指定しています。

- `display_errors = Off`
- `log_errors = Off`

そのため、bootstrap 後の実務的なエラー通知経路は、PHP 標準の画面出力や標準 error log に依存するのではなく、framework 自身が管理する前提になっています。

## 登録される handler

### `set_error_handler()`

通常の error handler は、可能であれば PHP の error number を可読な定数名に変換し、その後 `OP\Error::Set()` に保存します。

保存される message 形式は次です。

- `<ERROR_CONST_NAME>: <message>`

例:

- `E_WARNING: ...`
- `E_NOTICE: ...`

### `set_exception_handler()`

exception handler は、未捕捉の `Throwable` を取得します。

この handler は backtrace 配列を手動で組み立て、元の file と line を先頭に付与したうえで、最終 message を `OP\Error::Set()` に渡します。

例外 code が既知の PHP error constant 名に対応する場合は、その定数名が message prefix に使われます。

### `register_shutdown_function()`

shutdown handler は `error_get_last()` を確認します。

shutdown 時点の error が存在する場合、それも `OP\Error::Set()` に保存します。

その後、`OP\OP_ERROR` trait が利用可能な場合は `OP\Error::Notice()` を呼びます。

これが、session に蓄積されたエラーを、画面表示または管理者メールへ変換する最終段階です。

## Session 保存

`Error.php` 自体は session の保存構造を定義しません。

実際の保存先は `OP_ERROR` に実装されており、現行では次です。

- `$_SESSION[_OP_NAME_SPACE_][_APP_ID_]['OP_ERROR']`

`Error.php` の責務は、この保存層へエラーを流し込むことです。

## 範囲と限界

このファイルは、bootstrap 開始後に framework が現実的に到達できる範囲のエラーを、すべて取得することを意図しています。

ただし、次までは取得対象としません。

- PHP のアプリケーション実行に到達する前の失敗
- handler 登録完了前の失敗
- ユーザーコードが `try/catch` で既に処理済みの例外

これらは、登録された handler の観測可能範囲の外側です。

## 関連コンポーネント

- `asset/config/php.php`
- `asset/core/trait/docs/op-error.ja.md`
- `asset/core/trait/OP_ERROR.php`
- `asset/unit/notice/Notice.class.php`
- `asset/unit/notice/function/mail.php`
