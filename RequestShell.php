<?php
/**	op-core-include:/RequestShell.php
 *
 * @rebirth    2025-06-25
 * @version    1.0
 * @package    op-core
 * @subpackage include
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/* @var $_request array */

//	...
foreach( $_SERVER['argv'] as $arg ){
	//	...
	$arg = trim($arg);

	//	...
	if(!strpos($arg, '=') ){
		continue;
	}

	//	...
	list($k, $v) = explode('=', $arg);

	//	...
	$_request[$k] = $v;
}
