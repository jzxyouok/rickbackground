<?php

/**
 * 管理员模块基本特征
 *
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-12
 * Time: 下午10:38
 */
namespace App\Traits\Admin;
trait BasicTrait {
	// 管理员session key
	protected $adminSessionName = 'adminInfo';
	// 左侧菜单数据缓存Key 最后需要拼接角色ID
	protected $leftMenuDataCacheKey = 'LeftMenuRoleId_';
}