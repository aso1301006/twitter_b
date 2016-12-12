<?php
include('jpgraph/jpgraph.php');
include ('jpgraph/jpgraph_line.php');

$tango1 =explode(",", $_GET['tango1']);
$count=0;
$last_day =(int)date("t", mktime(0, 0, 0, $month, $year));
while($count<$last_day){
	$ydata[]=$tango1[$count];
	$count++;
}

$tango2 =explode(",", $_GET['tango2']);
$count=0;
while($count<$last_day){
	$ydata2[]=$tango2[$count];
	$count++;
}

$tango3 =explode(",", $_GET['tango3']);
$count=0;
while($count<$last_day){
	$ydata3[]=$tango3[$count];
	$count++;
}

$tango4 =explode(",", $_GET['tango4']);
 $count=0;
 while($count<$last_day){
 	$ydata4[]=$tango4[$count];
 	$count++;
 }


 $tango5 =explode(",", $_GET['tango5']);
 $count=0;
 while($count<$last_day){
 	$ydata5[]=$tango5[$count];
 	$count++;
 }


 $timer = new JpgTimer();
 $timer->Push();

// // Create the graph. These two calls are always required
 $graph = new Graph(700,400);
 $graph->SetScale("textlin");

 $graph->SetScale("textint", -1, 1);
 $graph->yscale->ticks->Set(0.5,0.1);

 $graph->SetMargin(40,20,20,60);


 // $graph->title->Set("Timing a graph");
 // $graph->footer->right->Set('Timer (ms): ');
 // $graph->footer->right->SetFont(FF_COURIER,FS_ITALIC);
 // $graph->footer->SetTimer($timer);

 //ぐらふの最大値最小値、目盛の設定
 //$graph->SetScale("textint", -1, 1);
 //$graph->yscale->ticks->Set(0.5,0.1);

 //$title = mb_convert_encoding("木曜日", "UTF-8", "auto");
 //$graph->title->Set($title);
 //$graph->title->SetFont(FF_MINCHO);

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

 if($last_day>=funcDesignatedDay($n, $w)){
	$graph->Add($lineplot5);
 }

 // $graph->xaxis->title->Set("X-title");
 // $graph->yaxis->title->Set("Y-title");

 // $graph->title->SetFont(FF_FONT1,FS_BOLD);
 // $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
 // $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 $graph->xaxis->title->Set(mb_convert_encoding("日", "UTF-8", "auto"));
 $graph->yaxis->title->Set(mb_convert_encoding("ツイート数", "UTF-8", "auto"));

 $graph->yaxis->title->SetFont(FF_MINCHO);
 $graph->xaxis->title->SetFont(FF_MINCHO);

 $graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

 $graph->yaxis->SetColor("red");
 $graph->yaxis->SetWeight(2);
 $graph->SetShadow();

 // Display the graph
 $graph->Stroke();
?>