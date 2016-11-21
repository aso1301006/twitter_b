<?php
include'../Authentication.php';

	//処理制限時間を無期限に
	set_time_limit(0);

	// エンドポイント(ユーザーのタイムラインを取得する)
	$request_url_T = 'https://api.twitter.com/1.1/statuses/user_timeline.json' ;
	// 	パラメータA (オプション)ユーザタイムライン用
	$params_a_T = array();
	// 	ユーザーID (どちらか必須)
	$params_a_T['user_id'] = '791505177299726336';
	// 	スクリーンネーム (どちらか必須)
	$params_a_T['screen_name'] = '@6clover_1301003';
	// 	取得件数 1から199まで
	$params_a_T['count'] = '10';
	// 	ユーザー情報を除外するのか
	$params_a_T['trim_user'] = 'false';
	// 	ライター(複数人による投稿)情報のユーザー情報を含めるか
	$params_a_T['contributor_details'] = 'true';
	// 	リプライのツイートを除外するか
	$params_a_T['exclude_replies'] = 'false';
	// 	リツイートの投稿を含めるか
	$params_a_T['include_rts'] = 'false';

	//ツイート
	$tweets =  Authentication($request_url_T, $params_a_T);

	//残り時間、残り回数
	$request_url_L = 'https://api.twitter.com/1.1/application/rate_limit_status.json' ;		// エンドポイント
	$params_a_L = array();

	$limit = Authentication($request_url_L, $params_a_L);

	//echo '残り'.$limit['resources']['statuses']['/statuses/user_timeline']['remaining'].'回<br />';
	//echo 'リセット時間'.date('Y年m月d日(D)H時i分s秒',$limit['resources']['statuses']['/statuses/user_timeline']['reset']);
?>
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css.css"></link>
<script type="text/javascript">
function reload(){
	  location.reload();
	}
</script>
</head>
<body>
<?php
include ('../header.php');
?>
<div class="main">

	<div id="search" align="right">
		<img src="../img/search_you.png" alt="分析" width=55% height=100% onClick="location.href='user_get.php'"></img>
	</div>

	<div id="relaod" align="right">
		<img src="../img/reload.png" alt="再読み込み" class="button" width="30px" height="30px" onclick="reload()"></img>
	</div>

	<p style="margin-bottom:2em;"></p>

<?php
foreach( $tweets as $key => $value ){
echo "<div id='tweet' style='border:solid 1px #AAA'>";
	echo "<div class='row'>";
		echo "<div>";
			echo '<img src="'.$tweets[$key]['user']['profile_image_url'].'">';
		echo "</div>";

		echo "<div>";
			echo $tweets[0]['user']['name'];
	echo "&nbsp;";
			echo "@";
			echo $tweets[0]['user']['screen_name'] ;
	echo "&nbsp; &nbsp; &nbsp;";
			echo date('m月d日H時i分');
	echo "<br></br>";
			echo $tweets[$key]['text'];
		echo"</div>";
	echo "</div>";
echo "</div>";
echo "<p style='margin-bottom:2em;'></p>";
}
?>
</div>
</body>
</html>