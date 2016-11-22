<?php
session_start();

define("Consumer_Key", "vfQ2SASQcoLdl1cqdwmMOD2yJ");
define("Consumer_Secret", "zspEuzKLR1QgraXnqaZOXxBBgTSSa0dOwyWpUYHLWnvjND7eqa");

//Callback URL
define('Callback', 'http://localhost/twi_analysis/login/collback.php');

//ライブラリを読み込む
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//TwitterOAuthのインスタンスを生成し、Twitterからリクエストトークンを取得する
try{
$connection = new TwitterOAuth(Consumer_Key, Consumer_Secret);
$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => Callback));
}catch (Exception $e){
	echo '捕捉した例外: ',  $e->getMessage(), "\n";
}
//リクエストトークンはcallback.phpでも利用するのでセッションに保存する
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// Twitterの認証画面へリダイレクト
$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
header('Location: ' . $url);
?>