<?php
/**	op-core-include:/RequestShell.php
 *
 * @rebirth    2025-06-25
 * @license    Apache-2.0
 * @package    op-core
 * @subpackage include
 * @copyright  (C) 2025 Tomoaki Nagahara
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
