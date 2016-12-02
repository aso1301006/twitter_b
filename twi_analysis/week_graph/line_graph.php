<?php
include ("/../jpgraph-4.0.1/src/jpgraph.php");
include ("/../jpgraph-4.0.1/src/jpgraph_line.php");

//サンプルデータの挿入
//$ydata =  array(11,3,8,12,5,1,9,13,5,7,11,3,8,12,5,1,9,13,5,7,4,5,1,9);
//$ydata2 = array(1,19,15,7,22,14,5,9,21,13,11,3,8,12,11,3,4,11,3,5,4,7,5,0);
//$ydata3 = array(3,15,13,6,0,4,12,4,1,19,15,2,5,13,1,6,4,17,5,6,7,8,3,2);
//$ydata4 = array(6,7,8,20,21,13,15,19,1,3,6,1,21,11,13,2,12,16,13,15,14,17,15,10);

//挿入可能か不明な5週目のダミーデータ
$ydata5 = array(1,19,15,7,22,14,5,9,21,13,11,3,8,12,11,3,4,11,3,5,4,7,5,0);

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


//$ydata5=GET['mon_week5'];



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

 $title = mb_convert_encoding("月曜日", "UTF-8", "auto");
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

 $lineplot5=new LinePlot($ydata5);
 $lineplot5->SetColor("black");
 $lineplot5->SetWeight(2);
// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);
 $graph->Add($lineplot3);
 $graph->Add($lineplot4);

 //if($mon_count==5){もし5週目が見つからない（一か月の範囲内のうちデータが4つしかない）場合、5本目をプロットしない
 //$graph->Add($lineplot5);
 //}

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