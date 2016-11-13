<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 16-11-5
 * Time: 下午4:15
 */

namespace App\Http\Controllers;

use App\Models\RoleAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class RequestController extends Controller {
	public function getBasetest(Request $request) {
		$input = $request->input('test');
		echo $input;
	}

	public function getUrl(Request $request) {
		//匹配request/*的URL才能继续访问
		if (!$request->is('request/*')) {
			abort(404);
		}
		$roleAction = new RoleAction();
		$actionList = $roleAction->getActionList(1);
		dump($actionList->all());
	}
}