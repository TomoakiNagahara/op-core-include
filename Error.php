<?php
/**	op-core-include:/Error.php
 *
 * @genesis    ????-??-??  generated from op-core-4
 * @created    2014-02-18  Separated from op-core-5:/App.class.php
 * @porting    2016-12-07  Porting to op-core-7:/Error.php
 * @moved      2025-06-11  Moved from op-core-7:/Error.php
 * @version    1.0
 * @package    op-core-include
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	PHP error settings.
 *
 */
error_reporting(E_ALL);
ini_set('short_open_tag','On');
ini_set('display_errors','On');
ini_set('log_errors'    ,'On');

/**	Catch standard error.
 *
 * @see        https://www.php.net/manual/ja/function.set-error-handler.php
 *
 */
set_error_handler( function($errno, $error, $file, $line /* , $context=null is removed PHP 8.0.0 */)
{
	//	...
	if( require_once(_ROOT_GIT_.'/asset/core/function/GetErrorConstName.php') ){
		//	...
		$errno = OP\GetErrorConstName($errno);
	}

	/*
	//	...
	if( class_exists('OP\Error', true) ){
		OP\Error::Set( "{$errno}: {$error}", debug_backtrace() );
	}else{
		echo "`OP\Error` class does not exists.";
	}
	*/
	OP\Error::Set( "{$errno}: {$error}" );

}, E_ALL);

/**	Catch of uncaught error.
 *
 * @see        https://www.php.net/manual/ja/function.set-exception-handler.php
 *
 */
set_exception_handler(function( \Throwable $e)
{
	//	...
	if(!class_exists('OP\Error', true) ){
		echo "`OP\Error` class does not exists.";
		return;
	}

	//	...
	$backtrace = [];
	$backtrace['file']		 = $e->getFile();
	$backtrace['line']		 = $e->getLine();
	$backtrace['function']	 = null;

	//	...
	$backtraces = $e->getTrace();

	//	...
	switch( $backtraces[0]['function'] ?? null ){
		case 'include':
		case 'require':
		case 'include_once':
		case 'require_once':
			if( empty($backtraces[0]['args']) ){
				$backtraces[0]['args'][] = $backtrace['file'];
			}
			break;
	}

	//	...
	array_unshift($backtraces, $backtrace);

	//	...
	if( $code = $e->getCode() ){
		//	...
		if( include_once(_ROOT_GIT_.'/asset/core/function/GetErrorConstName.php') ){
			$code = OP\GetErrorConstName( $code );
		}

		//	...
		$message = $code .': '. $e->getMessage();
	}else{
		//	...
		$message = $e->getMessage();
	}

	//	...
	OP\Error::Set($message, $backtraces);
});

/**	Called back on shutdown.
 *
 * @see        https://www.php.net/manual/ja/function.register-shutdown-function.php
 *
 */
register_shutdown_function(function()
{
	//	...
	if( $error = error_get_last() ){
		//	...
		if( class_exists('OP\Error', true) ){
			//	...
			OP\Error::Set($error);
		}else{
			echo '`OP\Error` class does not exists.';
		}
	}

	//	Check if exists OP_ERROR trait.
	if( trait_exists('OP\OP_ERROR', false) ){
		//	If the OP_ERROR trait exists, an error has occurred.
		//	To reduce memory consumption, unnecessary object are not loaded.
		OP\Error::Notice();
	}

	//	...
	return true;
});
