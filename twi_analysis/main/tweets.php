<?php
include '../Authentication.php';
include '../DBManager.php';
include '../python_analysis.php';
session_start();

function date_utc_to_jp($utc_date){
	return date("Y-m-d H:i:s", strtotime($utc_date. " +9 hour"));
}


$start = microtime(true);//処理開始時間
set_time_limit(0);//処理制限時間を無期限に
$move = true;
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

$limit_tweets = 3200;

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

		if(count($tweets) == 0){
			break;
		}

		foreach( $tweets as $key => $value ){
			$id = $tweets[$key]['id_str'];//ツイートid
			$text = $tweets[$key]['text'];//ツイート内容
			$date = new MongoDate(strtotime(date_utc_to_jp($tweets[$key]['created_at'])));
			$year = date('Y',  strtotime($tweets[$key]['created_at']));//年
			$month = date('m',  strtotime($tweets[$key]['created_at']));//月
			$day = date('d',  strtotime($tweets[$key]['created_at']));//日
			$dow = date('D',  strtotime($tweets[$key]['created_at']));//曜日
			$hour = date('H',  strtotime($tweets[$key]['created_at']));//時
			$minute = date('i',  strtotime($tweets[$key]['created_at']));//分
			$max_id = $id;
			if($count<$limit_tweets){
				//tweetsdataにインサート
				tweets_one_insert(array(
						'_id'=>$id,
						'text'=>$text,
						'created_at'=>$date,
						'year'=>$year,
						'month'=>$month,
						'day'=>$day,
						'dow'=>$dow,
						'hour'=>$hour,
						'minute'=>$minute,
						'user_id'=>(string)$user_id

				));
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
//DBに保存さえれているツイートデータに対して形態素解析・感情値算出を行う
$tf = morpheme_emotion();
if($tf){//解析などが失敗の場合
	echo '<h2>ツイート分析を失敗しました。前のページに戻ります。</h2><br />';

	echo '値：'.$tf;

	$move = false;
}
else{
	$end = microtime(true);//処理終了時間[
	$time = s2h($end - $start);//秒数を時分秒に変換
	echo '<h2>取得ツイート数：'.$count.'件</h2><br />';
	echo '<h2>保存しているツイートの分析：成功!</h2><br />';
	echo "<h2>処理時間：".$time."</h2><br />";
}
function s2h($seconds) {//秒数を時分秒へ変換
	$hours = floor($seconds / 3600);//時
	$minutes = floor(($seconds / 60) % 60);//分
	$seconds = $seconds % 60;//秒

	$hms = sprintf("%02d時間%02d分%02d秒", $hours, $minutes, $seconds);

	return $hms;

}

?>
<script type="text/javascript">
function move(move){
	if(move){
		window.location.href = '../your_page/your_page.php';
	}else{
		window.location.href = 'main.php';
	}
}
setTimeout("move(<?php echo $move;?>)", 3000);
	</script>
