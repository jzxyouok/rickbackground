<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-9
 * Time: 下午10:06
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class IndexController extends BaseController  {
	/**
	 * 构造方法
	 */
	public function __construct() {

	}

	/**
	 * 显示主页
	 *
	 * @param Request $request 请求数据
	 * @return bool|\Illuminate\Http\RedirectResponse
	 */
	public function index(Request $request) {
		dump($this->initLeftMenu());
		return $this->view('index');
	}
}