<?php
include ('../header.php');
include '../Authentication.php';
include '../DBManager.php';
include '../body.html';

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
	// 	取得件数 1から199まで
	$params_a['count'] = '10';
	// 	ユーザー情報を除外するのか
	$params_a['trim_user'] = 'false';
	// 	ライター(複数人による投稿)情報のユーザー情報を含めるか
	$params_a['contributor_details'] = 'true';
	// 	リプライのツイートを除外するか
	$params_a['exclude_replies'] = 'false';
	// 	リツイートの投稿を含めるか
	$params_a['include_rts'] = 'false';

//ツイート取得
$tweets =  Authentication($request_url, $params_a);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<div class="main">

	<div id="search" align="right">
		<a href="user_get.php"><img src="../img/search_you.png" alt="分析" width="55%" height="100%"></img></a>
	</div>

	<div id="relaod" align="right">
		<img src="../img/reload.png" alt="再読み込み" class="button" width="30px" height="30px" onclick="reload()"></img>
	</div>

	<p style="margin-bottom:2em;"></p>

<?php
foreach( $tweets as $key => $value ){
echo "<div id='tweet' style='border:solid 1px #AAA'>";
		echo "<div class='profile_img'>";
			echo '<img src="'.$tweets[$key]['user']['profile_image_url'].'" width="50px" height="50px">';
		echo "</div>";

		echo "<div class='text'>";
			echo $tweets[$key]['user']['name'];
	echo "&nbsp;";
			echo "@";
			echo $tweets[$key]['user']['screen_name'] ;
	echo "&nbsp; &nbsp; &nbsp;";
			echo date('m月d日h時i分',  strtotime($tweets[$key]['created_at']));
	echo "<br></br>";
			echo $tweets[$key]['text'];
		echo"</div>";
echo "</div>";
echo "<p style='margin-bottom:2em;'></p>";
}
?>
</div>
</body>
</html>