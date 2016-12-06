<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_bar.php");

//棒グラフ
//$data = array(0.1235,0.4567,0.67,0.45,0.832);
//テスト用のデータ
$data = array(53,32,30,15,13);
/*
//データ受け取り
foreach($word as $key =>$value){
	foreach($word as $key =>$value){
	$data[]=$value;
	$text_data[]=$word;
	}
}
//データ挿入
$data = $ydata[]=$value;
*/
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


//テストデータ（あとでコメントアウトする
$text_data= array('楽しい', 'つらい', '笑', '悲しい', '眠い');
//本番用
//$text_data = array($word_arr[0],$word_arr[1],$word_arr[2],$word_arr[3],$word_arr[4]);
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