<?php

/**
 * 唯一表示字段生成类
 *
 * Created by Rick.
 * User: rick
 * Date: 16-11-5
 * Time: 下午11:36
 */
namespace App\Tools;

class GUID {
	/**
	 * 构造方法
	 */
	public function __construct() {
	}

	/**
	 * 生成唯一字段
	 *
	 * @param string $prefix 前缀
	 * @return string 唯一字段
	 */
	public static function create($prefix = '') {
		$guid = '';
		$uid = uniqid("", true);
		$data = $prefix;
		$data .= $_SERVER['REQUEST_TIME'];
		$data .= $_SERVER['HTTP_USER_AGENT'];
		$data .= $_SERVER['SERVER_ADDR'];
		$data .= $_SERVER['SERVER_PORT'];
		$data .= $_SERVER['REMOTE_ADDR'];
		$data .= $_SERVER['REMOTE_PORT'];
		$hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
		$guid =
			substr($hash, 0, 8) .
			'-' .
			substr($hash, 8, 4) .
			'-' .
			substr($hash, 12, 4) .
			'-' .
			substr($hash, 16, 4) .
			'-' .
			substr($hash, 20, 12);
		return $guid;
	}
}