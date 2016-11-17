<?php
include ("/../jpgraph-4.0.1/src/jpgraph.php");
include ("/../jpgraph-4.0.1/src/jpgraph_bar.php");

//棒グラフ
$data = array(0.1235,0.4567,0.67,0.45,0.832);

// Callback function
// Get called with the actual value and should return the
// value to be displayed as a string
function cbFmtPercentage($aVal) {
    return sprintf("%.1f%%",100*$aVal); // Convert to string
}

// Create the graph.
$graph = new Graph(400,300);
$graph->SetScale("textlin");

// Create a bar plots
$bar1 = new BarPlot($data);

// Setup the callback function
$bar1->value->SetFormatCallback("cbFmtPercentage");
$bar1->value->Show();

$labels = array('単語①', '単語②', '単語3', '単語4', '単語5');
$graph->xaxis->SetFont(FF_GOTHIC);
$graph->xaxis->SetTickLabels($labels);

$graph->yaxis->title->SetFont(FF_MINCHO,FS_NORMAL,10);
$graph->yaxis->title->Set("ツイート数");

// Add the plot to the graph
$graph->Add($bar1);

// .. and send the graph back to the browser
$graph->Stroke();
?>