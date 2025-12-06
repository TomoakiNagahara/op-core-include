<?php
/**	op-core-include:/isLocalhost.php
 *
 * @created    2020-10-17  op-core-7:/include/isLocalhost.php
 * @porting    2025-06-14  op-core-include:/isLocalhost.php
 * @license    Apache-2.0
 * @package    op-core
 * @subpackage include
 * @copyright  (C) 2020 Tomoaki Nagahara
 */

/**	namespace
 *
 */
namespace OP;

//	...
if( self::isShell() ){
	return true;
}

//	...
$remote_addr = $_SERVER['REMOTE_ADDR'] ?? null;

//	...
return ($remote_addr === '127.0.0.1' or $remote_addr === '::1') ? true : false;
