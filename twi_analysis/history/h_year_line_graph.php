<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_line.php");
//例
//$ydata = array(0.1,0.3,0.8,0.12,0.5,0.1,0.9,0.13,0.5,0.7,0.11,0.3);
include '../DBManager.php';
session_start();
$y=$_GET['year'];
$user_id = (string)$_SESSION['id'];

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

//値の挿入
foreach($year as $value){

	$ydata[]=$value['emotion'];
}


$timer = new JpgTimer();
$timer->Push();

// Create the graph. These two calls are always required
$graph = new Graph(700,400);
//$graph->SetScale("textlin");

$graph->SetScale("textint", -1, 1);
$graph->yscale->ticks->Set(0.2,0.1);

$graph->img->SetMargin(40,60,20,60);

$graph->xaxis->SetFont(FF_GOTHIC);
$year=array("1","2","3","4","5","6","7","8","9","10","11","12");
$graph->xaxis->SetTickLabels($year);

// $graph->title->Set("Timing a graph");
// $graph->footer->right->Set('Timer (ms): ');
// $graph->footer->right->SetFont(FF_COURIER,FS_ITALIC);
// $graph->footer->SetTimer($timer);
/* $title = mb_convert_encoding("一日の比較", "UTF-8", "auto");
$graph->title->Set($title);
$graph->title->SetFont(FF_MINCHO); */

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);


// Add the plot to the graph
$graph->Add($lineplot);


// $graph->xaxis->title->Set("X-title");
// $graph->yaxis->title->Set("Y-title");
$graph->xaxis->title->Set(mb_convert_encoding("月", "UTF-8", "auto"));
$graph->yaxis->title->Set(mb_convert_encoding("ネガポジ値", "UTF-8", "auto"));

// $graph->title->SetFont(FF_FONT1,FS_BOLD);
// $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
// $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_MINCHO);
$graph->xaxis->title->SetFont(FF_MINCHO);

$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

//$graph->yaxis->SetColor("red");
$graph->yaxis->SetWeight(2);
$graph->SetShadow();

// Display the graph
$graph->Stroke();

?>