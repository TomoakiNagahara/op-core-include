<?php
/**	op-core-include:/isAdmin.php
 *
 * @created    2020-04-29  op-core-7:/include/isAdmin.php
 * @porting    2025-06-14  op-core-include:/isAdmin.php
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
if( self::isLocalhost() ){
	return true;
}

//	...
if(!$remote_addr = $_SERVER['REMOTE_ADDR'] ?? null ){
	return false;
}

//	...
return $remote_addr === _ADMIN_IP_;
