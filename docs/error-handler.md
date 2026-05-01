# Error Handler

This document describes the technical behavior of `asset/core/include/Error.php`.

## Purpose

`Error.php` registers the framework-wide error capture handlers as early as possible during bootstrap.

Its role is:

- capture reachable PHP errors
- capture uncaught exceptions and uncaught `Throwable`
- capture shutdown-time fatal errors
- hand them to `OP\Error::Set()`
- trigger final notification processing at shutdown

## Relation to `asset/config/php.php`

The current application config sets:

- `display_errors = Off`
- `log_errors = Off`

Because of that, the framework is expected to manage the practical error-notice path by itself after bootstrap, instead of depending on PHP's default screen output or default error log behavior.

## Registered Handlers

### `set_error_handler()`

The standard error handler converts PHP error numbers into readable constant names when possible, then stores the error through `OP\Error::Set()`.

Stored message format:

- `<ERROR_CONST_NAME>: <message>`

Examples:

- `E_WARNING: ...`
- `E_NOTICE: ...`

### `set_exception_handler()`

The exception handler catches uncaught `Throwable`.

It builds a backtrace array manually, prepends the original file and line, and stores the final message through `OP\Error::Set()`.

If the exception code maps to a known PHP error constant name, that name is used in the message prefix.

### `register_shutdown_function()`

The shutdown handler checks `error_get_last()`.

If a shutdown-time error exists, it is also stored through `OP\Error::Set()`.

After that, the handler calls `OP\Error::Notice()` when the `OP\OP_ERROR` trait is available.

This is the final step that turns collected session errors into visible notice output or administrator email.

## Session Storage

`Error.php` itself does not define the session storage structure.

The actual storage is implemented by `OP_ERROR` and currently uses:

- `$_SESSION[_OP_NAME_SPACE_][_APP_ID_]['OP_ERROR']`

`Error.php` is responsible for feeding that storage layer.

## Scope and Limits

This file is intended to capture everything the framework can realistically reach after bootstrap has started.

It does not claim to capture:

- failures before PHP application execution is available
- failures before the handler registration completes
- exceptions that user code has already handled with `try/catch`

These are outside the observable range of the registered handlers.

## Related Components

- `asset/config/php.php`
- `asset/core/trait/docs/op-error.md`
- `asset/core/trait/OP_ERROR.php`
- `asset/unit/notice/Notice.class.php`
- `asset/unit/notice/function/mail.php`
