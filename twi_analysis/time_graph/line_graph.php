<?php
include ("/../jpgraph-4.0.1/src/jpgraph.php");
include ("/../jpgraph-4.0.1/src/jpgraph_line.php");

$ydata = array(0.1,0.3,0.8,0.12,0.5,0.1,0.9,0.13,0.5,0.7,0.11,0.3,0.8,0.12,0.5,0.1,9,0.13,0.5,0.7,0.4,0.5,0.6,0.7);

$negapozi0=$_GET['negapozi0'];
$negapozi1=$_GET['negapozi1'];
$negapozi2=$_GET['negapozi2'];
$negapozi3=$_GET['negapozi3'];
$negapozi4=$_GET['negapozi4'];
$negapozi5=$_GET['negapozi5'];
$negapozi6=$_GET['negapozi6'];
$negapozi7=$_GET['negapozi7'];
$negapozi8=$_GET['negapozi8'];
$negapozi9=$_GET['negapozi9'];
$negapozi10=$_GET['negapozi10'];
$negapozi11=$_GET['negapozi11'];
$negapozi12=$_GET['negapozi12'];
$negapozi13=$_GET['negapozi13'];
$negapozi14=$_GET['negapozi14'];
$negapozi15=$_GET['negapozi15'];
$negapozi16=$_GET['negapozi16'];
$negapozi17=$_GET['negapozi17'];
$negapozi18=$_GET['negapozi18'];
$negapozi19=$_GET['negapozi19'];
$negapozi20=$_GET['negapozi20'];
$negapozi21=$_GET['negapozi21'];
$negapozi22=$_GET['negapozi22'];
$negapozi23=$_GET['negapozi23'];
$ydata = array($negapozi0,$negapozi1,$negapozi2,$negapozi3,$negapozi4,$negapozi5,$negapozi6,$negapozi7,$negapozi8,$negapozi9,$negapozi10,$negapozi11,$negapozi12,$negapozi13,$negapozi14,$negapozi15,$negapozi16,$negapozi17,$negapozi18,$negapozi19,$negapozi20,$negapozi21,$negapozi22,$negapozi23);

$timer = new JpgTimer();
$timer->Push();

// Create the graph. These two calls are always required
$graph = new Graph(700,400);
//$graph->SetScale("textlin");

$graph->SetScale("textint", -1, 1);
$graph->yscale->ticks->Set(0.5,0.1);

$graph->img->SetMargin(40,60,20,60);

// $graph->title->Set("Timing a graph");
// $graph->footer->right->Set('Timer (ms): ');
// $graph->footer->right->SetFont(FF_COURIER,FS_ITALIC);
// $graph->footer->SetTimer($timer);
$title = mb_convert_encoding("一日の比較", "UTF-8", "auto");
$graph->title->Set($title);
$graph->title->SetFont(FF_MINCHO);

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);


// Add the plot to the graph
$graph->Add($lineplot);


// $graph->xaxis->title->Set("X-title");
// $graph->yaxis->title->Set("Y-title");
$graph->xaxis->title->Set(mb_convert_encoding("時間", "UTF-8", "auto"));
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
