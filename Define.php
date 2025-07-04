<?php
/**	op-core-include:/Define
 *
 * @created   2016-11-25
 * @version   1.0
 * @package   op-core-include
 * @author    Tomoaki Nagahara
 * @copyright Tomoaki Nagahara All right reserved.
 */

/**	namespace
 *
 */
namespace OP;

/**	Namespace constant
 *
 * "OP" consumes less memory than "ONEPIECE".
 *
 * @var string
 */
define('_OP_NAME_SPACE_', 'OP');

/**	Date format. (Not include hour, minutes, seconds)
 *
 * @var string
 */
define('_OP_DATE_', 'Y-m-d');

/**	Date and time format.
 *
 * @var string
 */
define('_OP_DATE_TIME_', 'Y-m-d H:i:s');

/**	Define root path.
 *
 * @var string
 */
if( $_SERVER['APP_ROOT'] ){
	//	Set document root if empty.
	if(!$_SERVER['DOCUMENT_ROOT'] ?? null ){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['APP_ROOT'];
	}
	//	Define constant.
	define('_ROOT_DOC_'  , $_SERVER['DOCUMENT_ROOT'].'/');
	define('_ROOT_APP_'  , $_SERVER['APP_ROOT'] .'/');
	define('_ROOT_CORE_' , dirname(__DIR__)     .'/');
	define('_ROOT_ASSET_', dirname(_ROOT_CORE_) .'/');
	define('_ROOT_GIT_'  , dirname(_ROOT_ASSET_).'/');
}
