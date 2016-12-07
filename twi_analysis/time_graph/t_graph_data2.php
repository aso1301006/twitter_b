<?php


//現在日時を取得して検索条件に加える
$toyear=(String)date('Y');
$tomonth=date('m');
$today=date('d');
$day_ago=date("d",strtotime("-1 day")); //１日前
$month_ago=date("Y",strtotime("-7 day")); //7日前
$count=0;
$sum=0;
$negapozi=0;
//一週間前の各曜日の月
$lastSunday_M = date("m",strtotime("Sunday previous week"));
$lastMonday_M = date("m",strtotime("Monday previous week"));
$lastTueday_M = date("m",strtotime("Tuesday previous week"));
$lastWedday_M = date("m",strtotime("Wednesday previous week"));
$lastThuday_M = date("m",strtotime("Thursday previous week"));
$lastFriday_M = date("m",strtotime("Friday previous week"));
$lastSatday_M = date("m",strtotime("last Saturday"));
//一週間前の各曜日の日
$lastSunday_D = date("d",strtotime("last Sunday"));
$lastMonday_D = date("d",strtotime("last Monday"));
$lastTueday_D = date("d",strtotime("last Tuesday"));
$lastWedday_D = date("d",strtotime("last wednesday"));
$lastThuday_D = date("d",strtotime("last thursday"));
$lastFriday_D = date("d",strtotime("last Friday"));
$lastSatday_D = date("d",strtotime("last Saturday"));
$name=(String)$_SESSION['id'];

//月曜のネガポジ平均
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $lastMonday_M,"day"=>$lastMonday_D));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi_Mon=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi_Mon=0;}

//火曜のネガポジ平均
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $lastTueday_M,"day"=>$lastTueday_D));;

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi_Tue=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi_Tue=0;}


//水曜のネガポジ平均
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $lastWedday_M,"day"=>$lastWedday_D));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi_Wed=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi_Wed=0;}

//木曜のネガポジ平均
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $lastThuday_M,"day"=>$lastThuday_D));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi_Thu=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi_Thu=0;}

//金曜のネガポジ平均
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $lastFriday_M,"day"=>$lastFriday_D));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi_Fri=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi_Fri=0;}

//土曜のネガポジ平均
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $lastSatday_M,"day"=>$lastSatday_D));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi_Sat=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi_Sat=0;}

//日曜のネガポジ平均
$cursol0=tweets_search(array("user_id" =>$name, "year" => $toyear, "month" => $lastSunday_M,"day"=>$lastSunday_D));

//取得ツイートのネガポジ平均値
$tweet_count=$cursol0->count();
if(!$tweet_count==0){
	foreach ($cursol0 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi_Sun=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi_Sun=0;}

?>