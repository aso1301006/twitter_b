<?php
include '../Authentication.php';
include '../DBManager.php';
session_start();

$start = microtime(true);//処理開始時間
set_time_limit(0);//処理制限時間を無期限に

//ユーザid
$user_id = $_SESSION['id'];
// エンドポイント(ユーザーのタイムラインを取得する)
$request_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json' ;
// 	パラメータA (オプション)ユーザタイムライン用
$params_a = array();
// 	ユーザーid
$params_a['user_id'] = $user_id;
// 	取得件数 1から200まで
$params_a['count'] = '200';
// 	ユーザー情報を除外するのか
$params_a['trim_user'] = 'false';

$j = tweets_search(array("user_id"=>$user_id),array("user_id"=>1));//tweetsdataDBにユーザidが入っているか検索
foreach ($j as $val){$jud = $val['user_id'];}
if(isset($jud)){//2回目以降は最大3,200件取得
	$limit_tweets = 3200;
}else{//1回目は1,000件取得
	$limit_tweets = 1000;
}

$count = 0;//ツイート保存回数
for($count;$count<$limit_tweets;){
	//古いツイートidを取得している場合
	if(isset($max_id)){
		$params_a['max_id'] = $max_id;
	}
	try{
		//ツイート取得
		$tweets =  Authentication($request_url, $params_a);
		//かぶっている値を取り除く
		if(isset($max_id)){array_shift($tweets);}
		foreach( (array)$tweets as $key => $value ){
			$id = $tweets[$key]['id_str'];//ツイートid
			$text = $tweets[$key]['text'];//ツイート内容
			$date = date('Y年m月d日H時i分s秒',  strtotime($tweets[$key]['created_at']));//ツイート日時
			$max_id = $id;
			if($count<$limit_tweets){
				//tweetsdataにインサート
				tweets_one_insert(array('_id'=>$id,'text'=>$text,'created_at'=>$date,'user_id'=>$user_id));
				$count++;
			}
			else{
				break 2;
			}
		}
	}catch (Exception $e){
		break;
	}

}
$end = microtime(true);//処理終了時間[
$time = s2h($end - $start);//秒数を時分秒に変換
echo '<h2>取得ツイート数：'.$count.'件</h2><bt />';
echo "<h2>処理時間：".$time."</h2><br />";

function s2h($seconds) {//秒数を時分秒へ変換
	$hours = floor($seconds / 3600);//時
	$minutes = floor(($seconds / 60) % 60);//分
	$seconds = $seconds % 60;//秒

	$hms = sprintf("%02d時間%02d分%02d秒", $hours, $minutes, $seconds);

	return $hms;

}

//http://detail.chiebukuro.yahoo.co.jp/qa/question_detail/q12145747642
?>
<script type="text/javascript">
function move(){
	window.location.href = 'http://localhost/twi_analysis/your_page/your_page.php';
}
setTimeout("move()", 3000);
	</script>