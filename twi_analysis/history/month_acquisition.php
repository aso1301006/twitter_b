<?php

/**
 * 月グラフ
 * 指定された年、月のネガポジ平均値(emotion_point)を取得して、日ごとの平均値を算出する
 * 例：2016年07月の1日毎のネガポジ平均
 * 作成した配列：$month[日][連番] = 名詞+形容詞とそのネガポジ値
 */

include '../DBManager.php';
session_start();

$y = "2016";//指定された年
$m = "12";//指定された月
$user_id = (string)$_SESSION['id'];

//DBから値取得_月
$data_month = tweets_search(array("year"=>$y,"month"=>$m,"user_id"=>$user_id),array("day"=>1,"noun"=>1,"adjective"=>1),array("month"=>1,"day"=>1));
foreach ($data_month as $value){//取得したデータを配列に格納
	if(isset($value['adjective']) and isset($value['noun'])){//データが両方存在する
		$merge = array_merge($value['noun'],$value['adjective']);
		if(empty($month[$value['day']])){
			$month[$value['day']][0] = $merge;
		}else{
			array_push($month[$value['day']],$merge);
		}
	}elseif(isset($value['noun'])){//名詞のみ存在
		if(empty($month[$value['day']])){
			$month[$value['day']][0] = $value['noun'];
		}else{
			array_push($month[$value['day']],$value['noun']);
		}
	}elseif(isset($value['adjective'])){//形容詞のみ存在
		if(empty($month[$value['day']])){
			$month[$value['day']][0] = $value['adjective'];
		}else{
			array_push($month[$value['day']],$value['adjective']);
		}
	}
}
foreach ($month as $key=>$value){//配列からネガポジ値がnullを削除
	foreach ($value as $key2=>$value2){
		foreach ($value2 as $key3=>$value3){
			if(empty($value3)){unset($month[$key][$key2][$key3]);}
		}
	}
}

/**
 * 月グラフ
 * 上の処理で作成した配列を日ごとの平均値を算出して配列に格納
 * 例：$month[日] = 「日」のネガポジ平均値
 */
foreach ($month as $key=>$value){
	$total_sum = 0;
	$total_count = 0;
	foreach ($value as $key2=>$value2){
		$total_sum += array_sum($value2);
		$total_count += count($value2);
	}
	$emotion = round($total_sum/$total_count, 2);
	$month[$key] = array("emotion"=>$emotion);
}
//ないデータを追加
$start_day = date("Y-m-d", strtotime('first day of ' . $y.$m));//検索する月の初めを取得
$end_day = date("Y-m-d", strtotime('last day of ' . $y.$m));//検索する月の終わりを取得
while($start_day<=$end_day){
	$day = (string)date("d", strtotime($start_day));
	if(!array_key_exists($day, $month)){$month[$day] = array("emotion"=>0);}
	$start_day = date('Y-m-d', strtotime("$start_day +1 day"));
}
ksort($month);

/**
 * ・年グラフ
 * 指定された年、月のネガポジ平均値(emotion_point)を取得して、月ごとの平均値を算出する
 * 例：2016年の月毎のネガポジ平均
 */
//DBから値取得_年
$data_year = tweets_search(array("year"=>$y,"user_id"=>$user_id),array("month"=>1,"noun"=>1,"adjective"=>1),array("month"=>1,"day"=>1));
foreach ($data_year as $value){
	if(isset($value['adjective']) and isset($value['noun'])){//データが両方存在する
		$merge = array_merge($value['noun'],$value['adjective']);
		if(empty($year[$value['month']])){
			$year[$value['month']][0] = $merge;
		}else{
			array_push($year[$value['month']],$merge);
		}
	}elseif(isset($value['noun'])){//名詞のみ存在
		if(empty($year[$value['month']])){
			$year[$value['month']][0] = $value['noun'];
		}else{
			array_push($year[$value['month']],$value['noun']);
		}
	}elseif(isset($value['adjective'])){//形容詞のみ存在
		if(empty($year[$value['month']])){
			$year[$value['month']][0] = $value['adjective'];
		}else{
			array_push($year[$value['month']],$value['adjective']);
		}
	}
}
foreach ($year as $key=>$value){//配列からネガポジ値がnullを削除
	foreach ($value as $key2=>$value2){
		foreach ($value2 as $key3=>$value3){
			if(empty($value3)){unset($year[$key][$key2][$key3]);}
		}
	}
	$year[$key] = array_filter($year[$key]);
}
/**
 * 年グラフ
 * 上の処理で作成した配列を月ごとの平均値を算出して配列に格納
 * 例：$year[月] = 「月」のネガポジ平均値
 */
foreach ($year as $key=>$value){//配列からネガポジ値がnullを削除
	$total_sum = 0;
	$total_count = 0;
	foreach ($value as $key2=>$value2){
		$total_sum += array_sum($value2);
		$total_count += count($value2);
	}
	$emotion = round($total_sum/$total_count, 2);
	$year[$key] = array("emotion"=>$emotion);
}
//ないデータを追加
$start_day = date("Y-m-d", strtotime($y.'-01-01'));//年の初めを取得
$end_day = date("Y-m-d", strtotime($y.'-12-01'));//年の終わりを取得
while($start_day<=$end_day){
	$month = (string)date("m", strtotime($start_day));
	if(!array_key_exists($month, $year)){$year[$month] = array("emotion"=>0);}
	$start_day = date("Y-m-d", strtotime("$start_day +1 month"));
}
ksort($year);

//取得した値を出力
echo '<pre>';
print_r($month);
print_r($year);
echo '</pre>';