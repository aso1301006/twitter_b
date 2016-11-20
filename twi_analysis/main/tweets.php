<?php
include '../Authentication.php';
include '../DBManager.php';
session_start();

//処理制限時間を無期限に
set_time_limit(0);

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

$count = 0;
$limit_tweets = 3200;
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
		}
	}catch (Exception $e){
		break;
	}
}
echo '<h2>取得ツイート数：'.$count.'件</h2>';
?>
<script type="text/javascript">
function move(){
	window.location.href = 'http://localhost/twi_analysis/your_page/your_page.php';
}
setTimeout("move()", 3000);
	</script>