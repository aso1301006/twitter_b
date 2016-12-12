<?php
//現在日時を取得して検索条件に加える
$today=date('d');
$day_ago=date("Ymd",strtotime("-1 day")); //１日前
$count=0;
$sum=0;
$negapozi=0;


//day<=7
$twenty_four_count=0;
$n = 1; // 第n
$w = "土"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week1=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));

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
	$sat_week1[]=$negapozi;
}
$con_sat_week1 = implode(",", $sat_week1);


//7<day<=14
$twenty_four_count=0;
$n = 2; // 第n
$w = "土"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week2=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));

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
	$sat_week2[]=$negapozi;
}
$con_sat_week2 = implode(",", $sat_week2);


//14<day<=21
$twenty_four_count=0;
$n = 3; // 第n
$w = "土"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week3=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));

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
	$sat_week3[]=$negapozi;
}
$con_sat_week3 = implode(",", $sat_week3);

//21<day<=28
$twenty_four_count=0;
$n = 4; // 第n
$w = "土"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);
while($twenty_four_count<24){
	$hour=num_to_str($twenty_four_count);
	$week4=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));

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
$sat_week4[]=$negapozi;
$negapozi=0;
}
$con_sat_week4 = implode(",", $sat_week4);


//day>28
//先月の最終日を取得
$last_day=date('d', mktime(0, 0, 0, date('m'), 0, date('Y')));

$twenty_four_count=0;
$n = 5; // 第n
$w = "土"; // w曜日
$search_day=(String)funcDesignatedDay($n, $w);

if($last_day>=funcDesignatedDay($n, $w)){
	while($twenty_four_count<24){
		$hour=num_to_str($twenty_four_count);
		$week5=tweets_search(array("user_id" =>$name, "year" => $year_ago, "month" => $month_ago,"day" => $search_day,"hour"=>$hour));

		$tweet_count=$week5->count();
		if(!$tweet_count==0){
			foreach ($week5 as $res) {
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
		$sat_week5[]=$negapozi;
	}
	$con_sat_week5 = implode(",", $sat_week5);

}
else{$con_sat_week5="0";}


 ?>