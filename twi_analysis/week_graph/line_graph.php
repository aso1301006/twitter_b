<?php
require_once ('jpgraph/jpgraph.php');
include ('jpgraph/jpgraph_line.php');
ini_set("display_errors", On);
error_reporting(E_ALL);


function funcDesignatedDay($n, $w){
	$year_val = date("Y",strtotime("-1 month")); // 年を取得
	$month_val =date("m",strtotime("-1 month")); // 月を取得

	$arr_week = array("日", "土", "金", "木", "水", "火", "月");

	for($i = 0; $i <= count($arr_week)-1; $i++){
		if($w == $arr_week[$i]){
			$w_no = $i;
		}
	}
	// 曜日番号を取得(0:日曜日～6:土曜日)
	$week_no = date('w',strtotime("$year_val/$month_val/1"));

	$d = (7*$n)+1;
	if((8 - ($week_no + $w_no)) <= 0){
		$day = ($d - ($week_no + $w_no) + 7);
	}else{
		if($w_no == 0 && $week_no == 0){
			$day = ($d - ($week_no + $w_no) - 7);
		}else{
			$day = ($d - ($week_no + $w_no));
		}
	}
	return $day;
}
$mon_week1 =explode(",", $_GET['con_mon_week1']);
$count=0;
while($count<24){
	$ydata[]=$mon_week1[$count];
	$count++;
}

$mon_week2 =explode(",", $_GET['con_mon_week2']);
$count=0;
while($count<24){
	$ydata2[]=$mon_week2[$count];
	$count++;
}

$mon_week3 =explode(",", $_GET['con_mon_week3']);
$count=0;
while($count<24){
	$ydata3[]=$mon_week3[$count];
	$count++;
}

$mon_week4 =explode(",", $_GET['con_mon_week4']);
 $count=0;
 while($count<24){
 	$ydata4[]=$mon_week4[$count];
 	$count++;
 }

 $n = 5; // 第n
 $w = "月"; // w曜日
 $serch_day=(String)funcDesignatedDay($n, $w);
 $last_day=date('d', mktime(0, 0, 0, date('m'), 0, date('Y')));

 if($last_day>=funcDesignatedDay($n, $w)){

 $thu_week5 =explode(",", $_GET['con_thu_week5']);
 $count=0;
 	while($count<24){
 		$ydata5[]=$thu_week5[$count];
 		$count++;
 	}
 $lineplot5=new LinePlot($ydata5);
 $lineplot5->SetColor("black");
 $lineplot5->SetWeight(2);
 $lineplot5->SetLegend("5週目"); 
 }


 $timer = new JpgTimer();
 $timer->Push();

//グラフのサイズの指定
 $graph = new Graph(700,400);
 $graph->SetScale("textlin");

 //グラフの最大値最小値、目盛の設定
 $graph->SetScale("textint", -1, 1);
 $graph->yscale->ticks->Set(0.5,0.1);

//凡例のフォント設定
 $graph->legend->SetFont(FF_GOTHIC,FS_NORMAL);
 $graph->SetMargin(40,20,20,60);

//マージンの指定
 $graph->SetMargin(40,20,20,60);

//X軸の目盛指定
 $graph->xaxis->SetFont(FF_GOTHIC);
 $week=array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
 $graph->xaxis->SetTickLabels($week);

//グラフタイトルの指定
 $title = mb_convert_encoding("月曜日", "UTF-8", "auto");
 $graph->title->Set($title);
 $graph->title->SetFont(FF_MINCHO);

 //グラフの描画
 $lineplot=new LinePlot($ydata);
 $lineplot->SetColor("red");
 $lineplot->SetWeight(2);
 $lineplot->SetLegend("1週目"); 

 $lineplot2=new LinePlot($ydata2);
 $lineplot2->SetColor("blue");
 $lineplot2->SetWeight(2);
 $lineplot2->SetLegend("2週目"); 

 $lineplot3=new LinePlot($ydata3);
 $lineplot3->SetColor("yellow");
 $lineplot3->SetWeight(2);
 $lineplot3->SetLegend("3週目"); 

 $lineplot4=new LinePlot($ydata4);
 $lineplot4->SetColor("green");
 $lineplot4->SetWeight(2);
 $lineplot4->SetLegend("4週目"); 

//グラフの追加
$graph->Add($lineplot);
$graph->Add($lineplot2);
 $graph->Add($lineplot3);
 $graph->Add($lineplot4);

 //5週目が存在しないときはプロットしない
 if($last_day>=funcDesignatedDay($n, $w)){
	$graph->Add($lineplot5);
 }
//XY軸の名前
 $graph->xaxis->title->Set(mb_convert_encoding("時間", "UTF-8", "auto"));
 $graph->yaxis->title->Set(mb_convert_encoding("ネガポジ値", "UTF-8", "auto"));
 $graph->yaxis->title->SetFont(FF_MINCHO);
 $graph->xaxis->title->SetFont(FF_MINCHO);

 $graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

//グラフの影を追加
 $graph->SetShadow();

 //グラフの表示
 $graph->Stroke();
?>