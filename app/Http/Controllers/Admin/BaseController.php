<?php
/**
 * 管理员基础控制器
 *
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-12
 * Time: 上午10:42
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\RoleAction;
use App\Traits\Admin\BasicTrait;

class BaseController extends Controller {
	use BasicTrait;
	protected $theme = 'admin';

	/**
	 * 构造方法
	 */
	public function __construct() {
	}

	public function initLeftMenu() {
		$roleAction = new RoleAction();
		$roleId = session($this->adminSessionName)['role_id'];
		$actionList = $roleAction->getActionList($roleId)->all();
		return $actionList;
	}

	/**
	 * 加载页面
	 *
	 * @param null $view
	 * @param array $data
	 * @param array $mergeData
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function view($view = null, $data = [], $mergeData = []) {
		$view = $this->theme . '/' . $view;
		return view($view, $data, $mergeData);
	}


}