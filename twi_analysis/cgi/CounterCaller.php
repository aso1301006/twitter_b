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
		$this->args = array();
		$this->count_arr = array();
	}

	public function setArgs($user_id, $from_date_str, $to_date_str){
		$this->$user_id = $this->checkString($user_id);
		$this->$from_date_str = $this->checkString($from_date_str);
		$this->$to_date_str = $this->checkString($to_date_str);
		// 変数を連想配列にまとめる
		$this->args = compact("user_id", "from_date_str", "to_date_str");
	}

	public function checkString($str){
		if(is_string($str)){
			return $str;
		}
		else{
			throw new InvalidArgumentException("引数が不正です");
		}
	}

	public function getCount($add_arg = array()){
		if($this->args != array()){
			$args = $this->args;
			// 追加で引数を指定する処理
			if($add_arg != array()){
				$args += $add_arg;
			}
			self::$caller->setArgs($args);
			$isExcec = self::$caller->call();

			if($isExcec){
				$query = array('count_result' => array('$exists' => 1));
				$field = array('_id' => 0, 'count_result' => 1);
				$cursor = tweets_search($query, $field);
				$count_arr = array();

				foreach ($cursor as $data) {
					foreach ($data['count_result'] as $key => $value) {
						$temp[$key] = $value;
					}
					$count_arr = $temp;
				}

				// カウント対象が見つからなかった時
				if($count_arr == array()){
					return false;
				}
				arsort($count_arr);
				foreach ($count_arr as $key => $value) {
					$word_arr[] = $key;
					$point_arr[] = $value;
				}
				$count_arr = array('word_arr' => $word_arr, 'point_arr' => $point_arr);

				// 使用したドキュメントは削除する
				global $db;
				$db->selectCollection("tweetdata")
					->remove(array('count_result' => array('$exists' => 1)));

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
				// すでに検索が為されている時は再利用する
				if($this->count_arr != array()){
					$count_arr = $this->count_arr;
				}
				else{
					// 再頻出単語の検索
					if(!$count_arr = $this->getCount()){
						// 検索が失敗した時（０件だった時など）
						return null;
					}
					$this->count_arr = $count_arr;
				}

				// PIE_CHAR なら追加処理
				if($selecter == PIE_CHAR){
					// 最初のキーを取得（再頻出の単語）
					$max_word = array('word' => array_shift($count_arr['word_arr']));

					// 再頻出単語を含むツイートのみを対象に頻出単語の検索
					if(!$count_arr = $this->getCount($max_word)){
						// 検索が失敗した時（０件だった時など）
						return null;
					}

					array_pop($count_arr['word_arr']);
					array_pop($count_arr['point_arr']);

					$count_arr += $max_word;
				}

				return $count_arr;
			default:
				throw new InvalidArgumentException("制御値が不正です");
		}
	}
}
?>
