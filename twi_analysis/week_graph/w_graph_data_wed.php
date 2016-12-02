<?php
//エラー無効
//error_reporting(0);
ini_set("max_execution_time",180);
set_time_limit(180);



//現在日時を取得して検索条件に加える
$toyear=date('Y');
$tomonth=date('m');
$today=date('d');
$day_ago=date("d",strtotime("-1 day")); //１日前
$month_ago=date("m",strtotime("-1 month")); //先月
$year_ago=date("Y",strtotime("-1 month")); //先月の年
$count=0;
$sum=0;
$negapozi=0;


//day<=7
$twenty_four_count=0;
$n = 1; // 第n
$w = "水"; // w曜日
$serch_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week1=$collection->find(array("user_id" =>$_SESSION['id'], "year" => $year_ago, "month" => $month_ago,"day" => $serch_day,"hour"=>$hour));

	$tweet_count=$week1->count();
	if(!$tweet_count==0){
		foreach ($week1 as $res) {
			$sum=$sum + ($res['emotion_point']);
			$count=$count + 1;
		}

		$ave=$sum/$count;
		$negapozi=round($ave,3);
		$count=0;
		$sum=0;
	}
	else{$negapozi=0;}
	$twenty_four_count++;
	$wed_week1[]=$negapozi;
}
$con_wed_week1 = implode(",", $wed_week1);


//7<day<=14
$twenty_four_count=0;
$n = 2; // 第n
$w = "水"; // w曜日
$serch_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week2=$collection->find(array("user_id" =>$_SESSION['id'], "year" => $year_ago, "month" => $month_ago,"day" => $serch_day,"hour"=>$hour));

	$tweet_count=$week2->count();
	if(!$tweet_count==0){
		foreach ($week2 as $res) {
			$sum=$sum + ($res['emotion_point']);
			$count=$count + 1;
		}

		$ave=$sum/$count;
		$negapozi=round($ave,3);
		$count=0;
		$sum=0;
	}
	else{$negapozi=0;}
	$twenty_four_count++;
	$wed_week2[]=$negapozi;
}
$con_wed_week2 = implode(",", $wed_week2);


//14<day<=21
$twenty_four_count=0;
$n = 3; // 第n
$w = "水"; // w曜日
$serch_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week3=$collection->find(array("user_id" =>$_SESSION['id'], "year" => $year_ago, "month" => $month_ago,"day" => $serch_day,"hour"=>$hour));

	$tweet_count=$week3->count();
	if(!$tweet_count==0){
		foreach ($week3 as $res) {
			$sum=$sum + ($res['emotion_point']);
			$count=$count + 1;
		}

		$ave=$sum/$count;
		$negapozi=round($ave,3);
		$count=0;
		$sum=0;
	}
	else{$negapozi=0;}
	$twenty_four_count++;
	$wed_week3[]=$negapozi;
}
$con_wed_week3 = implode(",", $wed_week3);


//21<day<=28
$twenty_four_count=0;
$n = 4; // 第n
$w = "水"; // w曜日
$serch_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week4=$collection->find(array("user_id" =>$_SESSION['id'], "year" => $year_ago, "month" => $month_ago,"day" => $serch_day,"hour"=>$hour));

	$tweet_count=$week4->count();
if(!$tweet_count==0){
	foreach ($week4 as $res) {
		$sum=$sum + ($res['emotion_point']);
		$count=$count + 1;
	}

	$ave=$sum/$count;
	$negapozi=round($ave,3);
	$count=0;
	$sum=0;
}
else{$negapozi=0;}
$twenty_four_count++;
$wed_week4[]=$negapozi;
}
$con_wed_week4 = implode(",", $wed_week4);
 ?>