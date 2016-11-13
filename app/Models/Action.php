<?php
/**
 * 管理员操作Model
 *
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-12
 * Time: 上午11:17
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Action extends Model {
	protected $table = 'action';
	public $timestamps = false;

	/**
	 *  构造方法
	 * @param array $attributes
	 */
	public function __construct(array $attributes) {
		parent::__construct($attributes);
	}

	/**
	 * 获取操作列表
	 * @param int $roleId 角色ID
	 */
	public function getActionList($roleId) {
		$where = array(
			'role_id' => $roleId
		);
	}
}