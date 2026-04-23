<?php
/**	op-core-include:/Define.php
 *
 * This file defines global constants used across the ONEPIECE FRAMEWORK.
 *
 * @created    2016-11-25
 * @license    Apache-2.0
 * @package    op-core
 * @subpackage include
 * @copyright  (C) 2016 Tomoaki Nagahara
 */

/**	namespace
 *
 */
namespace OP;

/**	Namespace constant
 *
 * The namespace has been changed from "ONEPIECE" to "OP".
 * "OP" consumes less memory than "ONEPIECE".
 *
 * @var string
 */
define('_OP_NAME_SPACE_', 'OP');

/**	Date format. (Not include hour, minutes, seconds)
 *
 * Standardized date format without time.
 * Example: 2025-07-19
 *
 * @var string
 */
define('_OP_DATE_', 'Y-m-d');

/**	Date and time format.
 *
 * Standardized date and time format.
 * Example: 2025-07-19 15:30:00
 *
 * @var string
 */
define('_OP_DATE_TIME_', 'Y-m-d H:i:s');

/**	Define root paths only if APP_ROOT is set.
 *
 * These constants help the framework locate the root directories
 *
 * @var string
 */
if( $_SERVER['APP_ROOT'] ){
	//	Add slash to tail.
	$_SERVER['APP_ROOT'] = rtrim($_SERVER['APP_ROOT'],'/').'/';

	/*
	//	Support to public_html
	if( file_exists( $_SERVER['APP_ROOT'] . '.public_html' ) ){
		$git_root  = $_SERVER['APP_ROOT'];
	}else

	//	Try to locate the .git directory to determine the git repository root.
	if(!file_exists( $git_root = $_SERVER['APP_ROOT'] . '.git' ) ){
		if(!file_exists( $git_root = dirname($_SERVER['APP_ROOT']) . '/.git' ) ){
			exit("Does not found .git directory: {$git_root}");
		}
	}

	//	Get the parent directory of the .git directory. (i.e., the git root)
	$git_root = dirname($git_root).'/';
	*/

	//	Search git root.
	$git_root = $_SERVER['APP_ROOT'];
	while( is_link("{$git_root}app.php") ){
		$git_root = dirname($git_root).'/';
	}

	//	If DOCUMENT_ROOT is not set, assign APP_ROOT as a fallback.
	if(!$_SERVER['DOCUMENT_ROOT'] ?? null ){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['APP_ROOT'];
	}else{
		//	Add slash to tail.
		$_SERVER['DOCUMENT_ROOT'] = rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/';
	}

	//	Define root path constants used throughout the ONEPIECE.
	define('_ROOT_DOC_'  , $_SERVER['DOCUMENT_ROOT']);
	define('_ROOT_APP_'  , $_SERVER['APP_ROOT']     );
	define('_ROOT_GIT_'  , $git_root                );
	define('_ROOT_ASSET_', $git_root.'asset/'       );
	define('_ROOT_CORE_' , $git_root.'asset/core/'  );
}
