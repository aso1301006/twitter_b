<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_bar.php");

$data = $_GET['point_arr'];


$text_data= $_GET['word_arr'];

//ラベル表示
$labels = $text_data;
$graph->xaxis->SetFont(FF_GOTHIC);
$graph->xaxis->SetTickLabels($labels);

$graph->yaxis->title->SetFont(FF_MINCHO,FS_NORMAL,10);
$graph->yaxis->title->Set("ツイート数");

//グラフの追加
$graph->Add($bar1);

//グラフの表示
$graph->Stroke();
?>