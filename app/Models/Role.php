<?php
/**
 * 管理员角色Model
 *
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-12
 * Time: 上午11:20
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	protected $table = 'role';
	public $timestamps = false;

	/**
	 * 构造方法
	 * @param array $attributes
	 */
	public function __construct(array $attributes) {
		parent::__construct($attributes);
	}
}