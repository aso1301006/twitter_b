<?php
include '../Authentication.php';
include '../DBManager.php';
session_start();

header("Content-type: text/plain; charset=UTF-8");

//処理制限時間を無期限に
set_time_limit(0);

//初回の人かをtweetsadataを参照して判断する
//⇒ツイートデータ内のスクリーンネームを検索してヒットしなければ初回
//ユーザid
$user_id = $_SESSION['id'];
//$first = tweets_count(array("user_id"=>$user_id));

// $user_id = '791505177299726336';
// $first = 0;

// エンドポイント(ユーザーのタイムラインを取得する)
$request_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json' ;
// 	パラメータA (オプション)ユーザタイムライン用
$params_a = array();
// 	ユーザーid
$params_a['user_id'] = $user_id;
// 	取得件数 1から200まで
$params_a['count'] = '2';
// 	ユーザー情報を除外するのか
$params_a['trim_user'] = 'false';

// if($first == 0){//初回の人 800ツイート取得
	$count = 0;//ツイート保存回数
	for($i=0;$i<5;$i++){
		//古いツイートidを取得している場合
		if(isset($max_id)){$params_a['max_id'] = $max_id;}
		//ツイート取得
		$tweets =  Authentication($request_url, $params_a);
		//かぶっている値を取り除く
		if(isset($max_id)){array_shift($tweets);}
		foreach( $tweets as $key => $value ){
			$id = $tweets[$key]['id_str'];//ツイートid
			$text = $tweets[$key]['text'];//ツイート内容
			$date = date('Y年m月d日H時i分s秒',  strtotime($tweets[$key]['created_at']));//ツイート日時
			$max_id = $id;
			//tweetsdataにインサート
// 			tweets_one_insert(array('twi_id'=>$id,'text'=>$text,'create_at'=>$date,'user_id'=>$user_id));
			$count++;
//			if($count>2){break 2;}
		}
	}
// }else{//二回目以降の人 10万ツイート取得(200ツイート*503リクエスト)
// 	//DBからsince_id取得
// 	$since_id = tweets_search();
// 	var_dump($since_id);
// 	//DBの最新から10万ツイート取得

// }
//echo($count);
//header( "Location: /http://localhost/twi_analysis/your_page/your_page.php" );
//exit ;
?>
<script type="text/javascript">
window.location.href = 'http://localhost/twi_analysis/your_page/your_page.php';
</script>