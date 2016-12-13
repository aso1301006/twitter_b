<?php
include 'DBManager.php';
include 'tes_text.php';
set_time_limit(0);//処理制限時間を無期限に
// エラー出力する場合
ini_set( 'display_errors', 1 );
function date_utc_to_jp($utc_date){
	return date("Y-m-d H:i:s", strtotime($utc_date. " +9 hour"));
}


$start =  date("Y-m-d", strtotime('first day of ' . '2016-12-01'));//検索する月の初めを取得
$end = date("Y-m-d", strtotime('last day of ' . '2016-12-01'));//検索する月の終わりを取得
$user_id = '791505177299726336';
while($start < $end){//week[第何週目][曜日] = 名詞+形容詞+時間
	$count = tweets_count();
	$count += 10;
	$f = mt_rand(64, 1024);
	for($i=0;$i<$f;$i++){
		$count++;
		shuffle($text);
		$rand = array_rand($text);
		$h = mt_rand(00, 24);
		$I = mt_rand(00, 60);
		$s = mt_rand(00, 60);
		$date = new MongoDate(strtotime(date_utc_to_jp("$start $h:$I:$s")));
		$year = date("Y",strtotime("$start $h:$I:$s"));
		$month = date("m",strtotime("$start $h:$I:$s"));
		$day =  date("d",strtotime("$start $h:$I:$s"));
		$hour = date("H",strtotime("$start $h:$I:$s"));
		$minute = date("i",strtotime("$start $h:$I:$s"));
		$seconds = date("s",strtotime("$start $h:$I:$s"));
		$dow = date("D",strtotime("$start $h:$I:$s"));
		tweets_one_insert(array(

			'_id'=>'testdata_'.$count,
			'text'=>$text[$rand],
			'created_at'=>$date,
			'year'=>$year,
			'month'=>$month,
			'day'=>$day,
			'dow'=>$dow,
			'hour'=>$hour,
			'minute'=>$minute,
			'user_id'=>(string)$user_id

		));
		$start = date('Y-m-d', strtotime('+1 day' . $start));
	}
}
echo '終了';