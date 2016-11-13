<?php
/**
 * 密码工具类
 *
 * Created by Rick.
 * User: rick
 * Date: 16-11-6
 * Time: 下午5:22
 */

namespace App\Tools;


class Password {
	/**
	 * 构造方法
	 */
	public function __construct() {

	}

	/**
	 * 生成密码
	 *
	 * @param string $password 明文密码
	 * @param string $salt 盐
	 * @return string 加密后密码
	 */
	public static function create($password, $salt = '') {
		return md5(((string)$password).$salt);
	}
}