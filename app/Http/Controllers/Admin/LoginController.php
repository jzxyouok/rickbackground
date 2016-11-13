<?php

/**
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-6
 * Time: 下午9:01
 */
namespace App\Http\Controllers\Admin;

use App\Traits\Admin\BasicTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class LoginController extends Controller {
	use BasicTrait;

	/**
	 * 登录验证
	 * @param Request $request 请求数据
	 */
	public function index(Request $request) {
		$account = $request->input('account');
		$password = $request->input('password');
		$admin = new Admin();
		// 验证密码
		$result = $admin->checkPassword($account, $password);
		if ($result) {
			// 读取管理员详情
			$adminInfo = $admin->getDetail(array('account' => $account));
			session()->put($this->adminSessionName, $adminInfo);
			$result = 'SUCCESS';
		} else {
			$result = 'FAIL';
		}
		return response()->json(array(
			'result' => $result
		));
	}

	/**
	 * 登出
	 *
	 * @param Request $request 请求数据
	 */
	public function logout(Request $request) {
		// 删除session中保存的数据
		session()->forget($this->adminSessionName);
		session()->flush();
		return response()->json(array(
			'result' => 'SUCCESS'
		));
	}
}