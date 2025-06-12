<?php
/**	op-core-include:/Autoloader.php
 *
 * @created   2014-11-29  Perhaps the file hadn't been separated yet.
 * @updated   2016-06-09  Separated into a single file
 * @rebirth   2025-06-11  op-core-include:/Autoloader.php
 * @version   2.0
 * @package   op-core-include
 * @author    Tomoaki Nagahara
 * @copyright Tomoaki Nagahara All right reserved.
 */

/**	Register autoloader.
 *
 * @created   2014-11-29  The autoloader did not support SPL.
 * @updated   2016-06-09  The autoloader has been changed to SPL and class-based.
 * @updated   2019-02-20  It is no longer implemented as a class. The loading process has been changed to something extremely simple.
 * @updated   2019-06-13  The autoloader now supports UNIT loading.
 * @updated   2025-06-11  The source code has been cleaned up a little.
 * @version   3.0
 * @package   op-core-include
 * @author    Tomoaki Nagahara
 * @copyright Tomoaki Nagahara All right reserved.
 */
//	...
spl_autoload_register( function($class_name)
{
	//	Check if the namespace is "OP".
	if( 0 !== strpos($class_name, 'OP\\') ){
		//	The namespace was not "OP".
		return;
	};

	//	Check if the namespace is a unit.
	if( 0 === strpos($class_name, 'OP\UNIT\\') ){
		//	Load a unit.
		if( 2 === mb_substr_count($class_name, '\\', 'utf-8') ){
			$pos  = strrpos($class_name, '\\');
			$name = substr($class_name, $pos+1);
			OP\Unit::Load($name);
		};
	};

	//	Load a class from op-core.
	$class_name = substr($class_name, 3);

	//	Generate each full file path.
	if( strpos($class_name, 'OP_') === 0 ){
		//	Trait
		$path = _ROOT_CORE_."/trait/{$class_name}.php";
	}else if( strpos($class_name, 'IF_') === 0 ){
		//	Interface
		$path = _ROOT_CORE_."/interface/{$class_name}.php";
	}else{
		//	Standard core class.
		$path = _ROOT_CORE_."/class/{$class_name}.class.php";
	};

	//	...
	if( file_exists( $path) ){
		include_once($path);
	};
});
