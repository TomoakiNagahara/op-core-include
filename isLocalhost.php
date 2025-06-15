<?php
/**	op-core-include:/isLocalhost.php
 *
 * @created    2020-10-17  op-core-7:/include/isLocalhost.php
 * @porting    2025-06-14  op-core-include:/isLocalhost.php
 * @version    1.0
 * @package    op-core-include
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
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
