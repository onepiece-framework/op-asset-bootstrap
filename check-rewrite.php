<?php
/**	op-asset-boot:/check-rewrite.php
 *
 * @created    2022-12-17  op-skeleton-2020:/asset/check.php
 * @moved      2025-04-09  op-asset-boot:/check-rewrite.php
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
if( Env::isShell() ){
	return;
}

//	...
$webserver = strtolower($_SERVER['SERVER_SOFTWARE'] ?? '');
foreach( ['php','apache','nginx'] as $key ){
	if( strpos($webserver, $key) === 0 ){
		$webserver = $key;
		break;
	}
}

//	Branch to each server software.
switch( $webserver ){
	case 'php':
		break;

	case 'apache':
	case 'nginx':
		//	Checking rewrite setting.
		switch( $entry_point = basename($_SERVER['SCRIPT_FILENAME']) ){
			case 'app.php':
			case 'dev.php':
				break;
			default:
				//	Has not been setting rewrite.
				require('asset/bootstrap/template/op/rewrite.phtml');
				echo "Entry point is {$entry_point}";
				exit(__LINE__);
		}
		break;

	default:
		echo "This webserver is not supported. ($webserver)\n";
		exit(__LINE__);
}
