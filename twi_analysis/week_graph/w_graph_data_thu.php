<?php
//エラー無効
//error_reporting(0);
ini_set("max_execution_time",180);
set_time_limit(180);

//現在日時を取得して検索条件に加える

$today=date('d');
$day_ago=date("Ymd",strtotime("-1 day")); //１日前
$count=0;
$sum=0;
$negapozi=0;



//day<=7
$twenty_four_count=0;
$n = 1; // 第n
$w = "木"; // w曜日
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
	$thu_week1[]=$negapozi;
}
$con_thu_week1 = implode(",", $thu_week1);


//7<day<=14
$twenty_four_count=0;
$n = 2; // 第n
$w = "木"; // w曜日
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
	$thu_week2[]=$negapozi;
}
$con_thu_week2 = implode(",", $thu_week2);


//14<day<=21
$n = 3; // 第n
$w = "木"; // w曜日
$serch_day=(String)funcDesignatedDay($n, $w);
$twenty_four_count=0;
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
	$thu_week3[]=$negapozi;
}
$con_thu_week3 = implode(",", $thu_week3);


//21<day<=28
$n = 4; // 第n
$w = "木"; // w曜日
$serch_day=(String)funcDesignatedDay($n, $w);
$twenty_four_count=0;
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
$thu_week4[]=$negapozi;
$negapozi=0;
}
$con_thu_week4 = implode(",", $thu_week4);
 ?>