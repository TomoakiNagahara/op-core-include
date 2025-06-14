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
	if( include_once(_ROOT_GIT_.'/asset/core/function/GetErrorConstName.php') ){
		//	...
		$errno = OP\GetErrorConstName($errno);
	}

	//	...
	if( class_exists('OP\Error', true) ){
		OP\Error::Set( "{$errno}: {$error}", debug_backtrace() );
	}else{
		echo "`OP\Error` class does not exists.";
	}

}, E_ALL);
