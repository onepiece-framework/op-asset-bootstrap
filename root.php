<?php
/**	op-asset-boot:/root.php
 *
 * @created    2022-10-30  op-skeleton-2020:/asset/rootpath.php
 * @moved      2025-04-09  op-asset-boot:/root.php
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

//	Branch per each SAPI.
switch( $sapi = php_sapi_name() ){
	//	Web Servers
	case 'cli-server': // PHP Built-in Server
		$_SERVER['APP_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
		break;

	case 'fpm-fcgi':
	case 'apache2handler':
		//	App root.
		if( empty($_SERVER['APP_ROOT']) ){
			$_SERVER['APP_ROOT'] = dirname($_SERVER['SCRIPT_FILENAME']).'/';
		}
		break;

	//	CLI
	case 'cli':
		//	App root.
		if( empty($_SERVER['APP_ROOT']) ){
			//	Get current directory.
			$pwd = $_SERVER['PWD'];
			do{
				//	Find the directory where app.php file exists.
				if( file_exists( $pwd . '/app.php' ) ){
					//	Found.
					break;
				}
				//	Trim to upper directory.
				$pwd = dirname($pwd);
			}while( $pwd !== '/' );
			//	Assignment.
			$_SERVER['APP_ROOT'] = $pwd;
		}

		//	Document root.
		if( empty($_SERVER['DOCUMENT_ROOT']) ){
			$_SERVER['DOCUMENT_ROOT'] = $_SERVER['APP_ROOT'];
		}
		break;

	default:
		echo __FILE__ .' #'. __LINE__ . ' - ';
		exit("Undefined SAPI. ($sapi)");
}

//	App root
$app_root = $_SERVER['APP_ROOT'];

//	Document root
$doc_root = $_SERVER['DOCUMENT_ROOT'];

//	Git root
//	$app_root is alias path. Not real path.
if( file_exists("{$app_root}/.git") ){
	$git_root = $app_root;
}else if( file_exists(dirname($app_root).'/.git') ){
	$git_root = dirname($app_root);
}else{
	exit('Does not found .git directory.('.__FILE__.')');
}

//	Asset root
$asset_root = $git_root.'/asset/';

//	Real root
$real_root = realpath($git_root);

//	Entry each root directory.
RootPath('git'      , $git_root                 );
RootPath('real'     , $real_root                );
RootPath('doc'      , $doc_root                 );
RootPath('app'      , $app_root                 );
RootPath('asset'    , $asset_root               );
RootPath('op'       , $asset_root.'core'        );
RootPath('core'     , $asset_root.'core'        );
RootPath('unit'     , $asset_root.'unit'        );
RootPath('layout'   , $asset_root.'layout'      );
RootPath('template' , $asset_root.'template'    );
