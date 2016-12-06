<?php
require_once(dirname(__FILE__). '/PythonCaller.php');
require_once(dirname(__FILE__). '/../DBManager.php');
define('PIE_CHAR', 1);
define('BAR_GRAPH', 2);
define('LINE_GRAPH', 3);

class CounterCaller{
	private static $caller = null;
	private $count_arr;

	private $args;
	private $user_id;
	private $from_date_str;
	private $to_date_str;
	private $word;

	public function __construct(){
		if(self::$caller == null){
			self::$caller = new PythonCaller('Count_DB.py');
		}
		$this->setArgs(array());
		$this->count_arr = array();
	}

	public function setArgs($args){
		if(is_array($args)){
			// 受け取った配列を分解して対応するキーの変数に代入
			foreach ($args as $key => $value) {
				$this->$key = $value;
			}
			// 変数を連想配列にまとめる
			$this->args = compact("user_id", "from_date_str", "to_date_str", "word");
		}
		else{
			throw new InvalidArgumentException("引数が配列ではありません");
		}
	}

	public function getCount($add_arg = array()){
		if($this->args != array()){
			$args = $this->args;
			// 追加で引数を指定する処理
			if($add_arg != array()){
				$args += $add_arg;
			}
			self::$caller->setArgs(args);
			$isExcec = self::$caller->call();

			if($isExcec){
				$query = array('count_result' => array('$exsits' => 1));
				$field = array('_id' => 0, 'count_result' => 1);
				$result = tweets_search($query, $field);
				$count_arr = array();

				foreach ($result['count_result'] as $key => $value) {
					$count_arr[$key] = $value;
				}
				arsort($count_arr);

				return $count_arr;
			}
			else{
				return false;
			}
		}
		else{
			throw new InvalidArgumentException("配列が空です");
		}


	}

	public function call($selecter){
		// 若干汎用性に乏しい書き方になったので改良の余地あり
		switch($selecter){
			case PIE_CHAR:
			case BAR_GRAPH:
			case LINE_GRAPH:
				if($this->count_arr != array()){
					$count_arr = $this->count_arr;
				}
				else{
					// 再頻出単語の検索
					$count_arr = $this->getCount();
					$this->count_arr = $count_arr;
				}

				// PIE_CHAR なら追加処理
				if($selecter == PIE_CHAR){
					$max_word = array_shift($count_arr);

					// 再頻出単語を含むツイートのみを対象に頻出単語の検索
					$count_arr = $this->getCount(array('word' => $max_word));
				}

				return $count_arr;
			default:
				throw new InvalidArgumentException("制御値が不正です");
		}
	}
}
?>
