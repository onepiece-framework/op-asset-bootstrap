<?php
/**	op-asset-boot:/check-php.php
 *
 * @created    2022-12-17  op-skeleton-2020:/asset/check.php
 * @copied     2025-04-09  op-asset-boot:/check-php.php
 * @version    1.0
 * @package    op-asset-boot
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

//	...
foreach([
	'mbstring' => 'mb_language',
	'openssl'  => 'openssl_encrypt',
	'apcu'     => 'apcu_add',
] as $module => $function){
	//	...
	if( function_exists($function) ){
		continue;
	}

	//	...
	define('_OP_APP_BOOTSTRAP_', $module);
	require('asset/bootstrap/template/php/module.php');
	exit(__LINE__);
}
