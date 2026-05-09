<?php
/**	op-core-include:/Request.php
 *
 * @rebirth    2025-06-25
 * @license    Apache-2.0
 * @package    op-core
 * @subpackage include
 * @copyright  (C) 2025 Tomoaki Nagahara
 */

/**	namespace
 *
 */
namespace OP;

//	...
$_request = [];

//	...
if( OP::isShell() ){
	include(__DIR__.'/RequestShell.php');
}else{
	include(__DIR__.'/RequestWeb.php');
}

//	...
include_once(_ROOT_CORE_.'/function/Encode.php');
return Encode($_request);
