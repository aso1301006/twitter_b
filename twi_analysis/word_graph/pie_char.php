<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_pie.php");

$data = $_GET['point_arr'];

$graph = new PieGraph(400,300);

$graph->SetShadow();

$p1 = new PiePlot($data);

//凡例のフォント設定
$graph->legend->SetFont(FF_GOTHIC,FS_NORMAL);

$text_data=$_GET['word_arr'];
$p1->SetLegends($text_data);



$graph->Add($p1);
$graph->Stroke();
?>