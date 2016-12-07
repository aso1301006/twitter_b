<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_line.php");
/**
 * 月グラフ
 * 指定された年、月のネガポジ平均値(emotion_point)を取得して、日ごとの平均値を算出する
 * 例：2016年07月の1日毎のネガポジ平均
 * 作成した配列：$month[日][連番] = 名詞+形容詞とそのネガポジ値
 */

include '../DBManager.php';
session_start();


$y =(string) $_GET['year'];//指定された年
$m = (string)$_GET['month'];//指定された月
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


foreach($month as $key =>$value){
	foreach($value as $emotion =>$point){
	$ydata[]=$point;
	}
}

$timer = new JpgTimer();
$timer->Push();

//グラフのサイズ指定
$graph = new Graph(700,400);
//$graph->SetScale("textlin");

//グラフの上限と下限の指定
$graph->SetScale("textint", -1, 1);
$graph->yscale->ticks->Set(0.1,0.1);

//凡例のフォント設定
 $graph->legend->SetFont(FF_GOTHIC,FS_NORMAL);

//マージンの指定
$graph->img->SetMargin(40,60,20,60);


//グラフの描画
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot->SetLegend($m."月のネガポジ平均");

//グラフの追加
$graph->Add($lineplot);

//XY軸の名前
$graph->xaxis->title->Set(mb_convert_encoding("日", "UTF-8", "auto"));
$graph->yaxis->title->Set(mb_convert_encoding("ネガポジ値", "UTF-8", "auto"));
$graph->yaxis->title->SetFont(FF_MINCHO);
$graph->xaxis->title->SetFont(FF_MINCHO);

$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

//グラフに影を追加
$graph->yaxis->SetColor("black");
$graph->yaxis->SetWeight(2);
$graph->SetShadow();

//グラフの表示
$graph->Stroke();

?>