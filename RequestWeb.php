<?php
/**	op-core-include:/RequestWeb.php
 *
 * @rebirth    2025-06-25
 * @license    Apache-2.0
 * @package    op-core
 * @subpackage include
 * @copyright  (C) 2025 Tomoaki Nagahara
 */

/* @var $_request array */

//	JSON
if(($_SERVER['CONTENT_TYPE'] ?? null) === 'application/json' ){
	//	Including this will not change the amount of memory consumed.
	$_content = file_get_contents("php://input");
	$_request = json_decode($_content, true);
}else{
	//	...
	foreach( ($_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET) as $_key => $_val ){
		$_request[$_key] = $_val;
	}
}

//	...
unset($_key, $_val);
