<?php
/**	op-asset-boot:/check-config.php
 *
 * @created    2022-12-17  op-skeleton-2020:/asset/check.php
 * @copied     2025-04-09  op-asset-boot:/check-config.php
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

//	ci.php or git.php is skip.
$basename = basename($_SERVER['SCRIPT_NAME']);
if( /* $basename === 'ci.php' or */ $basename === 'git.php' ){
	return;
}

//	Get admin config.
$config = Config::Get('admin');

//	Set Admin IP-Address and Admin E-Mail Address.
foreach( [Env::_ADMIN_IP_, Env::_ADMIN_MAIL_] as $key ){
	//	...
	if( empty($config[$key]) ){
		//	...
		if(!require('asset/bootstrap/template/app/config-admin.phtml') ){
			exit(__LINE__);
		}
	}
}
