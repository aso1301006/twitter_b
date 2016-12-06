<?php
include ("/../jpgraph-4.0.1/src/jpgraph.php");
include ("/../jpgraph-4.0.1/src/jpgraph_line.php");

$year = "2016";
$month = "11";

$select=tweets_search(array("year" =>$year,"month" =>$month))->limit(10);
$day=1;
$i=0;
foreach ($select as $value){
	$point[$i]= $value['noun'];
	$i++;
}
















$ydata = array(11,3,8,12,5,1,9,13,5,7);
$ydata2 = array(1,19,15,7,22,14,5,9,21,13);

$timer = new JpgTimer();
$timer->Push();

// Create the graph. These two calls are always required
$graph = new Graph(700,400);
$graph->SetScale("textlin");

$graph->img->SetMargin(40,60,20,60);

// $graph->title->Set("Timing a graph");
// $graph->footer->right->Set('Timer (ms): ');
// $graph->footer->right->SetFont(FF_COURIER,FS_ITALIC);
// $graph->footer->SetTimer($timer);
$title = mb_convert_encoding("", "UTF-8", "auto");
$graph->title->Set($title);
$graph->title->SetFont(FF_MINCHO);

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);


$lineplot2=new LinePlot($ydata2);
$lineplot2->SetColor("orange");
$lineplot2->SetWeight(2);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);

// $graph->xaxis->title->Set("X-title");
// $graph->yaxis->title->Set("Y-title");
$graph->xaxis->title->Set(mb_convert_encoding("日", "UTF-8", "auto"));
$graph->yaxis->title->Set(mb_convert_encoding("ネガポジ値", "UTF-8", "auto"));

// $graph->title->SetFont(FF_FONT1,FS_BOLD);
// $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
// $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_MINCHO);
$graph->xaxis->title->SetFont(FF_MINCHO);

$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

$graph->yaxis->SetColor("red");
$graph->yaxis->SetWeight(2);
$graph->SetShadow();

// Display the graph
$graph->Stroke();
?>