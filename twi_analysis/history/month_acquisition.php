<?php
/**
・月グラフ
指定された年、月のネガポジ平均値(emotion_point)を取得して、
日ごとの平均値を算出する
例：2016年07月の1日毎のネガポジ平均

・年グラフ
指定された年、月のネガポジ平均値(emotion_point)を取得して、
月ごとの平均値を算出する
例：2016年の月毎のネガポジ平均
 */

include '../DBManager.php';
session_start();

$y = "2018";//指定された年
$m = "07";//指定された月
$user_id = (string)$_SESSION['id'];

//DBから値取得_月
$data_month = tweets_search(array("year"=>$y,"month"=>$m,"user_id"=>$user_id),array("day"=>1,"emotion_point"=>1),array("month"=>1,"day"=>1));
foreach ($data_month as $value){
	$month[$value['day']] = $value['emotion_point'];
}

//DBから値取得_年
$data_year = tweets_search(array("year"=>$y),array("month"=>1,"emotion_point"=>1,"user_id"=>$user_id),array("month"=>1,"day"=>1));


echo '<pre>';
print_r($month);
echo '</pre>';