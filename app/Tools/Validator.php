<?php

/**
 * 数据验证类
 */
class Validator {
	// 中国大陆手机号码正则表达式
	private $_mobilePattern = '/^(1(([35][0-9])|(47)|[8][01236789]))\d{8}$/';
	// 邮箱正则表达式
	private $_emailPattern = '/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/';
	// URL正则表达式
	private $_urlPattern =
		'/([/w-]+/.)+[/w-]+.([^a-z])(/[/w-: ./?%&=]*)?|[a-zA-Z/-/.][/w-]+.([^a-z])(/[/w-: ./?%&=]*)?';
	// 货币正则表达式(最多保留两位小数的浮点数)
	private $_moneyPattern = '/^\d+(\.\d{0,2})?$/';
	// 整数正则表达式
	private $_intPattern = '/^-?\d+$/';
	// 数字正则表达式
	private $_numberPattern = '/^(-?\d+)(\.\d+)?$/';
	// 消息语言
	public $language = NULL;
	// 消息
	public $message = array(
		'zh_CN' => array(
			'required' => '{alias}不能为空',
			'number' => '{alias}必须为数字',
			'int' => '{alias}必须为整数',
			'money' => '{alias}必须为合法金额',
			'url' => '{alias}必须为合法链接地址',
			'<=' => '{alias}必须小于等于{value}',
			'>=' => '{alias}必须大于等于{value}',
			'<' => '{alias}必须小于{value}',
			'>' => '{alias}必须大于{value}',
			'==' => '{alias}必须等于{value}',
			'range' => '{alias}必须大于{value}，小于{value}',
			'range()' => '{alias}必须大于{value}，小于{value}',
			'range[]' => '{alias}必须大于等于{value}，小于等于{value}',
			'range(]' => '{alias}必须大于{value}，小于等于{value}',
			'range[)' => '{alias}必须大于等于{value}，小于{value}',
			'maxLength' => '{alias}长度最大为{value}',
			'minLength' => '{alias}长度最小为{value}',
		)
	);
	// 消息别名键
	private $_KEY_ALIAS = '{alias}';
	// 消息数值键
	private $_KEY_VALUES = '{value}';
	/**
	 * array(
	 *    array(
	 *      'value' => '值'
	 *    'alias' => '别名',
	 *    'rule' => array(
	 *      'required'
	 *      'number'
	 *      'int'
	 *      'money'
	 *      'url'
	 *        '<=' =>
	 *        '>=' =>
	 *        '>' =>
	 *        '<' =>
	 *        '==' =>
	 *        'range()' => array(0, 1)
	 *        'range[]' => array(0, 1)
	 *        'range(]' => array(0, 1)
	 *        'range[)' => array(0, 1)
	 *    )
	 *    )
	 * )
	 */

	/**
	 * 构造方法
	 * @param string $language 语言
	 */
	public function __constructor($language = NULL) {
		$this->language = array_key_exists($language, $this->message) ? $language : 'zh_CN';
	}

	/**
	 * 验证是否是中国大陆手机号码
	 */
	public function isMobile($mobile) {
		return preg_match($this->_mobilePattern, $mobile) > 0;
	}

	/**
	 * 验证是否是邮箱
	 */
	public function isEmail($email) {
		return preg_match($this->_emailPattern, $email) > 0;
	}

	/**
	 * 验证是否是URL
	 */
	public function isUrl($url) {
		return preg_match($this->_urlPattern, $url) > 0;
	}

	/**
	 * 验证是否是货币格式
	 */
	public function isMoney($money) {
		return preg_match($this->_moneyPattern, $money) > 0;
	}

	/**
	 * 验证是否是整数
	 */
	public function isInt($number) {
		return preg_match($this->_intPattern, $number);
	}

	/**
	 * 验证是否是数字
	 */
	public function isNumber($number) {
		return preg_match($this->_numberPattern, $number);
	}

	/**
	 * 判断是否为空
	 * 注：字符串没有任何字符的时候为空，变量没有设置或者为NULL的时候也为空，数组没有元素也视为空
	 */
	public function isEmpty($str) {
		// 判断变量是否已经设置或是否为NULL
		if (!isset($str) || $str === NULL) {
			return true;
		}
		// 如果是数组则判断其元素数量
		if (is_array($str)) {
			return count($str) > 0;
		}
		// 如果不是字符串，直接返回false
		if (!is_string($str)) {
			return false;
		}
		// 判断字符串第一个字符是否已经设置
		return !isset($str{0});
	}

	/**
	 * 数据验证
	 */
	public function validate($data = array()) {
		foreach ($data as $key => $unit) {
			$value = $unit['value'];
			$alias = $unit['alias'];
			$rules = $unit['rules'];
			$ret = array(
				'error' => 0,
				'msg' => null
			);
			foreach ($rules as $rule => $detail) {
				switch ($rule) {
					case 'required':
						if ($this->isEmpty($value)) {
							$ret['error'] = 1;
						}
						break;
					case 'int':
						if (!$this->isInt($value)) {
							$ret['error'] = 2;
						}
						break;
					case 'number':
						if (!$this->isNumber($value)) {
							$ret['error'] = 3;
						}
						break;
					case 'url':
						if (!$this->isUrl($value)) {
							$ret['error'] = 4;
						}
						break;
					case 'money':
						if (!$this->isMoney($value)) {
							$ret['error'] = 5;
						}
						break;
					case '<=':
						if (!$value <= $detail) {
							$ret['error'] = 6;
						}
						break;
					case '>=':
						if (!$value >= $detail) {
							$ret['error'] = 7;
						}
						break;
					case '<':
						if (!$value < $detail) {
							$ret['error'] = 8;
						}
						break;
					case '>':
						if (!$value > $detail) {
							$ret['error'] = 9;
						}
						break;
					case '==':
						if ($value != $detail) {
							$ret['error'] = 9;
						}
						break;
					case 'range':
					case 'range[]':
						if (!isset($detail) || !is_array($detail) || count($detail) < 2) {
							$ret['error'] = -1;
						}
						if (isset($detail[0]) && $detail[0] > $value) {
							$ret['error'] = 10;
						}
						if (isset($detail[1]) && $detail[1] < $value) {
							$ret['error'] = 10;
						}
						break;
					case 'range()':
						if (!isset($detail) || !is_array($detail) || count($detail) < 2) {
							$ret['error'] = -1;
						}
						if (isset($detail[0]) && $detail[0] >= $value) {
							$ret['error'] = 11;
						}
						if (isset($detail[1]) && $detail[1] <= $value) {
							$ret['error'] = 11;
						}
						break;
					case 'range(]':
						if (!isset($detail) || !is_array($detail) || count($detail) < 2) {
							$ret['error'] = -1;
						}
						if (isset($detail[0]) && $detail[0] >= $value) {
							$ret['error'] = 12;
						}
						if (isset($detail[1]) && $detail[1] < $value) {
							$ret['error'] = 12;
						}
						break;
					case 'range[)':
						if (!isset($detail) || !is_array($detail) || count($detail) < 2) {
							$ret['error'] = -1;
						}
						if (isset($detail[0]) && $detail[0] > $value) {
							$ret['error'] = 13;
						}
						if (isset($detail[1]) && $detail[1] <= $value) {
							$ret['error'] = 13;
						}
						break;
					case 'maxLength':
						if (empty($detail)) {
							$ret['error'] = -1;
						}
						if (mb_strlen($value) > $detail) {
							$ret['error'] = 14;
						}
						break;
					case 'minLength':
						if (mb_strlen($value) < $detail) {
							$ret['error'] = 15;
						}
						break;
					default:
						$ret['error'] = -2;
						break;
				}
				if ($ret['error']) {
					if ($ret['error'] == -1) {
						$ret['msg'] = 'Grammar Error';
					}
					if ($ret['error'] == -2) {
						$ret['msg'] = 'Rule ' . $rule . ' not exists.';
					}
					$ret['msg'] = $this->message[$rule];
					$ret['msg'] = str_replace($this->_KEY_ALIAS, $alias, $ret['msg']);
					if (isset($detail)) {
						if (is_array($detail)) {
							foreach ($detail as $detail_sub) {
								$ret['msg'] = $this->str_replace_once($this->_KEY_VALUES, $detail_sub, $ret['msg']);
							}
						} else {
							$ret['msg'] = $this->str_replace_once($this->_KEY_VALUES, $detail, $ret['msg']);
						}
					}
					return $ret;
				}
			}
			return $ret;
		}
	}

	/**
	 * 字符串替换（只替换一次）
	 *
	 * @param $needle 被替换字符串
	 * @param $replace 替换后字符串
	 * @param $haystack 原始字符串
	 * @return mixed 处理后字符串
	 */
	public function str_replace_once($needle, $replace, $haystack) {
		$pos = strpos($haystack, $needle);

		if ($pos === false) {
			return $haystack;

		}
		return substr_replace($haystack, $replace, $pos, strlen($needle));
	}
}

// 测试代码
$validator = new Validator();
