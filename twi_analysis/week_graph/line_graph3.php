<?php
include ("/../jpgraph-4.0.1/src/jpgraph.php");
include ("/../jpgraph-4.0.1/src/jpgraph_line.php");

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
//サンプルデータの挿入
//$ydata =  array(11,3,8,12,5,1,9,13,5,7,11,3,8,12,5,1,9,13,5,7,4,5,1,9);
//$ydata2 = array(1,19,15,7,22,14,5,9,21,13,11,3,8,12,11,3,4,11,3,5,4,7,5,0);
//$ydata3 = array(3,15,13,6,0,4,12,4,1,19,15,2,5,13,1,6,4,17,5,6,7,8,3,2);
//$ydata4 = array(6,7,8,20,21,13,15,19,1,3,6,1,21,11,13,2,12,16,13,15,14,17,15,10);
//挿入可能か不明な5週目のダミーデータ
//$ydata5 = array(1,19,15,7,22,14,5,9,21,13,11,3,8,12,11,3,4,11,3,5,4,7,5,0);

$wed_week1 =explode(",", $_GET['con_wed_week1']);
$count=0;
while($count<24){
	$ydata[]=$wed_week1[$count];
	$count++;
}

$wed_week2 =explode(",", $_GET['con_wed_week2']);
$count=0;
while($count<24){
	$ydata2[]=$wed_week2[$count];
	$count++;
}

$wed_week3 =explode(",", $_GET['con_wed_week3']);
$count=0;
while($count<24){
	$ydata3[]=$wed_week3[$count];
	$count++;
}

$wed_week4 =explode(",", $_GET['con_wed_week4']);
 $count=0;
 while($count<24){
 	$ydata4[]=$wed_week4[$count];
 	$count++;
 }


 $n = 5; // 第n
 $w = "水"; // w曜日
 $serch_day=(String)funcDesignatedDay($n, $w);
 $last_day=date('d', mktime(0, 0, 0, date('m'), 0, date('Y')));

 if($last_day>=funcDesignatedDay($n, $w)){

 	$wed_week5 =explode(",", $_GET['con_wed_week5']);
 	$count=0;
 	while($count<24){
 		$ydata5[]=$wed_week5[$count];
 		$count++;
 	}
 	$lineplot5=new LinePlot($ydata5);
 	$lineplot5->SetColor("black");
 	$lineplot5->SetWeight(2);
 }


 $timer = new JpgTimer();
 $timer->Push();

// // Create the graph. These two calls are always required
 $graph = new Graph(700,400);
 $graph->SetScale("textlin");

 $graph->SetScale("textint", -1, 1);
 $graph->yscale->ticks->Set(0.5,0.1);

 $graph->SetMargin(40,20,20,60);

 $graph->xaxis->SetFont(FF_GOTHIC);
 $week=array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
 $graph->xaxis->SetTickLabels($week);

 // $graph->title->Set("Timing a graph");
 // $graph->footer->right->Set('Timer (ms): ');
 // $graph->footer->right->SetFont(FF_COURIER,FS_ITALIC);
 // $graph->footer->SetTimer($timer);

 //ぐらふの最大値最小値、目盛の設定
 //$graph->SetScale("textint", -1, 1);
 //$graph->yscale->ticks->Set(0.5,0.1);

 $title = mb_convert_encoding("水曜日", "UTF-8", "auto");
 $graph->title->Set($title);
 $graph->title->SetFont(FF_MINCHO);

 // Create the linear plot
 $lineplot=new LinePlot($ydata);
 $lineplot->SetColor("red");
 $lineplot->SetWeight(2);

 $lineplot2=new LinePlot($ydata2);
 $lineplot2->SetColor("blue");
 $lineplot2->SetWeight(2);

 $lineplot3=new LinePlot($ydata3);
 $lineplot3->SetColor("yellow");
 $lineplot3->SetWeight(2);

 $lineplot4=new LinePlot($ydata4);
 $lineplot4->SetColor("green");
 $lineplot4->SetWeight(2);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);
 $graph->Add($lineplot3);
 $graph->Add($lineplot4);

 if($last_day>=funcDesignatedDay($n, $w)){
	$graph->Add($lineplot5);
 }


 // $graph->xaxis->title->Set("X-title");
 // $graph->yaxis->title->Set("Y-title");

 // $graph->title->SetFont(FF_FONT1,FS_BOLD);
 // $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
 // $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 $graph->xaxis->title->Set(mb_convert_encoding("時間", "UTF-8", "auto"));
 $graph->yaxis->title->Set(mb_convert_encoding("ネガポジ値", "UTF-8", "auto"));

 $graph->yaxis->title->SetFont(FF_MINCHO);
 $graph->xaxis->title->SetFont(FF_MINCHO);

 $graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

 $graph->yaxis->SetColor("red");
 $graph->yaxis->SetWeight(2);
 $graph->SetShadow();

 // Display the graph
 $graph->Stroke();
?>