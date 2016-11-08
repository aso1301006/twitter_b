<?php
session_start();

if(!isset($_SESSION['access_token'])){

	header('Location: http://localhost/twitter_anarysis/login/login.php');

}else{
	//twitterとの連携が承認されていれば自動でmain.phpへ
	header('Location: http://localhost/twitter_anarysis/main/main.php');
}


/*
	echo "<p>ID：". $_SESSION['id'] . "</p>";
	echo "<p>名前：". $_SESSION['name'] . "</p>";
	echo "<p>スクリーン名：". $_SESSION['screen_name'] . "</p>";
	echo "<p>最新ツイート：" .$_SESSION['text']. "</p>";
	echo "<p><img src=".$_SESSION['profile_image_url_https']."></p>";
	echo "<p>access_token：". $_SESSION['access_token']['oauth_token'] . "</p>";
*/

?>
