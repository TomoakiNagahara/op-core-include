<?php
/**	op-core-include:/Request.php
 *
 * @rebirth    2025-06-25
 * @version    1.0
 * @package    op-core
 * @subpackage include
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	namespace
 *
 */
namespace OP;

//	...
$_request = [];

//	...
if( $_SERVER['SHELL'] ?? null ){
	include(__DIR__.'/RequestShell.php');
}else{
	include(__DIR__.'/RequestWeb.php');
}

//	...
include_once(_ROOT_CORE_.'/function/Encode.php');
return Encode($_request);
