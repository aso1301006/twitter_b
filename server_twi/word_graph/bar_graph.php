<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_bar.php");

$data = $_GET['point_arr'];

// Callback function
// Get called with the actual value and should return the
// value to be displayed as a string

//function cbFmtPercentage($aVal) {
//    return sprintf("%.1f%%",100*$aVal); // Convert to string
//}

// Create the graph.
$graph = new Graph(400,300);
$graph->SetScale("textlin");

// Create a bar plots
$bar1 = new BarPlot($data);

// Setup the callback function
//$bar1->value->SetFormatCallback("cbFmtPercentage");
//$bar1->value->Show();

$text_data= $_GET['word_arr'];
//本番用
$labels = $text_data;
$graph->xaxis->SetFont(FF_GOTHIC);
$graph->xaxis->SetTickLabels($labels);

$graph->yaxis->title->SetFont(FF_MINCHO,FS_NORMAL,10);
$graph->yaxis->title->Set("ツイート数");

// Add the plot to the graph
$graph->Add($bar1);

// .. and send the graph back to the browser
$graph->Stroke();
?>