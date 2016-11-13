<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-12
 * Time: 下午7:24
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class RoleAction extends Model {
	protected $table = 'role_action';
	protected $actionTable = 'action';
	public $timestamps = false;

	/**
	 * 构造方法
	 * @param array $attributes
	 */
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);
	}

	/**
	 * 获得用户的操作权限列表
	 *
	 * @param $roleId
	 */
	public function getActionList($roleId) {
		$where = array(
			'role_id' => $roleId
		);
		$actionList = DB::table($this->table)
			->join($this->actionTable, $this->table . '.action_id', '=', $this->actionTable . '.action_id')
			->where($where)
			->select('*')
			->orderBy('sort', 'desc')
			->get();
		return $actionList;
	}
}
