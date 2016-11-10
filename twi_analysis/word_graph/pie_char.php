<?php
include ("/../jpgraph-4.0.1/src/jpgraph.php");
include ("/../jpgraph-4.0.1/src/jpgraph_pie.php");

//円グラフ
$data = array(40,60,21,33);
$graph = new PieGraph(300,200);
$graph->SetShadow();
$graph->title->Set("A simple Pie plot");
$p1 = new PiePlot($data);
$graph->Add($p1);
$graph->Stroke();
?>