<?php
include '../Authentication.php';
//include '../DBManager.php';
include '../mongodb.php';

//処理制限時間を無期限に
set_time_limit(0);

//初回の人かをtweetsadataを参照して判断する
//⇒ツイートデータ内のスクリーンネームを検索してヒットしなければ初回

//DBからuser-id取得
$user_id = $_SESSION['id'];
$first = tweets_count(array("user_id"=>$user_id));

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

if($first == 0){//初回の人 800ツイート取得
	//ツイート保存回数
	$count = 0;
	for($i=0;$i<5;$i++){
		//ツイート取得
		$tweets =  Authentication($request_url, $params_a);
		foreach( $tweets as $key => $value ){
			$id = $tweets[$key]['id_str'];//ツイートid
			$text = $tweets[$key]['text'];//ツイート内容
			$date = date('Y年m月d日',  strtotime($tweets[$key]['created_at']));//ツイート日時
			//tweetsdataにインサート
// 			tweets_one_insert(array('twi_id'=>$id,'text'=>$text,'create_at'=>$date,'user_id'=>$user_id));
			$count++;
			if($count>=800){break 2;}
		}
	}
}else{//二回目以降の人 10万ツイート取得(200ツイート*503リクエスト)
	//DBからsince_id取得

	//DBの最新から10万ツイート取得

}
echo $count;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
</head>
<body>
<?php
// 	$search = tweets_count();
// 	var_dump(iterator_to_array($search));
// 	echo $search;
	?>
</body>
</html>