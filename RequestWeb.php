<?php
/**	op-core-include:/RequestWeb.php
 *
 * @rebirth    2025-06-25
 * @version    1.0
 * @package    op-core
 * @subpackage include
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/* @var $_request array */

//	JSON
if(($_SERVER['CONTENT_TYPE'] ?? null) === 'application/json' ){
	//	Including this will not change the amount of memory consumed.
	$_content = file_get_contents("php://input");
	$_request = json_decode($_content, true);
}

//	Web
$_request = array_merge_recursive($_request, $_GET ?? [], $_POST ?? []);
