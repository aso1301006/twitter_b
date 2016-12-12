<?php

//現在日時を取得して検索条件に加える
$toyear=(String)date('Y');
$tomonth=(String)date('m');
$today=(String)date('d');
$day_ago=(String)date("d",strtotime("-1 day")); //１日前
$month_ago=(String)date("m",strtotime("-1 day")); //1日前の月
$toyear=(String)date("Y",strtotime("-1 day")); //１日前の年

$count=0;
$sum=0;
$negapozi=0;
$name=(String)$_SESSION['id'];
//echo gettype($name);
$month_ago=(String)$tomonth;//取得日を当日に変更
$day_ago=(String)$today;
//折れ線(00時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"00"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi0=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi0=0;}

//折れ線(01時）
//コレクションの選択
$collection = $db->selectCollection("tweetdata");
$cursol1=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"01"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol1->count();
if(!$tweet_count==0){
	foreach ($cursol1 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi1=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi1=0;}

//折れ線(02時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"02"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi2=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi2=0;}

//折れ線(03時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"03"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi3=round($ave,3);
}
else{$negapozi3=0;}

//折れ線(04時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"04"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi4=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi4=0;}

//折れ線(05時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"05"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi5=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi5=0;}

//折れ線(06時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"06"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi6=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi6=0;}

//折れ線(07時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"07"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi7=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi7=0;}

//折れ線(08時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"08"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi8=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi8=0;}

//折れ線(09時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"09"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi9=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi9=0;}

//折れ線(10時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"10"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi10=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi10=0;}

//折れ線(11時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"11"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi11=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi11=0;}

//折れ線(12時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"12"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi12=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi12=0;}

//折れ線(13時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"13"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi13=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi13=0;}

//折れ線(14時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"14"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi14=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi14=0;}

//折れ線(15時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"15"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi15=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi15=0;}

//折れ線(16時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"16"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi16=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi16=0;}

//折れ線(17時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"17"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi17=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi17=0;}

//折れ線(18時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"18"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi18=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi18=0;}

//折れ線(19時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"19"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi19=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi19=0;}

//折れ線(20時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"20"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi20=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi20=0;}

//折れ線(21時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"21"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi21=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi21=0;}

//折れ線(22時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"22"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi22=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi22=0;}

//折れ線(23時）
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $month_ago, "day"=>$day_ago,"hour"=>"23"));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi23=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi23=0;}

?>