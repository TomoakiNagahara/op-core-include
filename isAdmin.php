<?php
/**	op-core-include:/isAdmin.php
 *
 * @created    2020-04-29  op-core-7:/include/isAdmin.php
 * @porting    2025-06-14  op-core-include:/isAdmin.php
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
if( self::isLocalhost() ){
	return true;
}

//	...
if(!$remote_addr = $_SERVER['REMOTE_ADDR'] ?? null ){
	return false;
}

//	...
return $remote_addr === OP::_ADMIN_IP_;
