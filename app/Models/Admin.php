<?php
/**
 * 管理员Model
 *
 * Created by Rick.
 * User: rick
 * Date: 16-11-6
 * Time: 下午4:14
 */
namespace App\Models;

use App\Tools\GUID;
use App\Tools\Password;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Admin extends Model {

	protected $table = 'admin';
	protected $guarded = ['admin_id'];
	protected $primaryKey = 'admin_id';
	public $timestamps = false;

	/**
	 * 管理员模型构造方法
	 * @param array $attributes
	 */
	public function __construct(array $attributes = array()) {
		parent::__construct($attributes);
	}

	/**
	 * 新增管理员
	 *
	 * @param array $attr
	 * @return array
	 */
	public function register(array $attr) {
		$now = time();
		$attr['guid'] = GUID::create();
		$attr['auth_token'] = substr($attr['guid'], 0, 8);
		$attr['password'] = Password::create($attr['password'], $attr['auth_token']);
		$attr['register_time'] = $now;
		$attr['modify_time'] = $now;
		$this->fill($attr);
		$result['result'] = false;
		$result['code'] = 0;
		try {
			$result['result'] = $this->save();
			if ($result['result']) {
				$result['admin'] = $this->getAttributes();
			}
		} catch (QueryException $e) {
			$result['code'] = $e->getCode();
		}
		return $result;
	}

	/**
	 * 验证密码正确性
	 *
	 * @param string $account 账号
	 * @param string $password 密码
	 * @return bool
	 */
	public function checkPassword($account, $password) {
		$where = array(
			'account' => $account
		);
		$fields = array(
			'account', 'password', 'auth_token'
		);
		// 查询用户的密码
		$admin = $this->where($where)->first($fields);
		if (empty($admin)) {
			return false;
		}
		$password = Password::create($password, $admin->getAttribute('auth_token'));
		return $password == $admin->getAttribute('password');
	}

	/**
	 * 获得管理员详情
	 *
	 * @param array $where 查询条件
	 * @return mixed
	 */
	public function getDetail($where = array()) {
		$admin = $this->where($where)->first();
		return $admin->getAttributes();
	}
}
