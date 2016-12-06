<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_line.php");



//折れ線グラフのデータ
$ydata =  array(3,2,0,0,0,0,0,2,2,4,2,5,0,6,3,6,4,6,4,2,1,1,1,1);
$ydata2 = array(4,6,0,0,0,0,0,1,1,0,2,4,5,5,3,1,0,0,2,3,2,3,2,1);
$ydata3 = array(1,1,0,0,0,0,0,2,3,0,1,1,0,1,0,2,4,7,7,2,4,6,3,3);
$ydata4 = array(2,1,0,0,0,0,0,0,2,1,2,0,3,0,3,2,2,0,0,2,3,1,0,0);
$ydata5 = array(2,0,0,0,0,0,0,5,2,0,0,0,0,2,3,0,0,0,3,2,1,3,7,7);
//線の太さ0かつデータなしのダミーデータ
$ydata6 = array(0,0,0,0,0,0,0,0,0,0);

//データ受け取り
/*
foreach($word as $key =>$value){
	foreach($word as $key =>$value){
	$ydata[]=$value;
	$text_data[]=$word;
	}
}
*/

$timer = new JpgTimer();
$timer->Push();

//グラフのサイズ（横×縦）とマージンの指定
$graph = new Graph(400,300);
$graph->SetScale("textlin");


//グラフのタイトル
//$graph->title->Set("Timing a graph");
//$graph->footer->right->Set('Timer (ms): ');
//$graph->footer->right->SetFont(FF_COURIER,FS_ITALIC);
//$graph->footer->SetTimer($timer);

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot2=new LinePlot($ydata2);
$lineplot3=new LinePlot($ydata3);
$lineplot4=new LinePlot($ydata4);
$lineplot5=new LinePlot($ydata5);
$lineplot6=new LinePlot($ydata6);

//グラフの追加

if(!isset($_GET['data1'])){$graph->Add($lineplot);}
if(!isset($_GET['data2'])){$graph->Add($lineplot2);}
if(!isset($_GET['data3'])){$graph->Add($lineplot3);}
if(!isset($_GET['data4'])){$graph->Add($lineplot4);}
if(!isset($_GET['data5'])){$graph->Add($lineplot5);}
//ひとつもデータがない場合、ダミーを目立たないように表示
if(isset($_GET['data1'])&&isset($_GET['data2'])&&isset($_GET['data3'])&&isset($_GET['data4'])&&isset($_GET['data5'])){
	$graph->Add($lineplot6);
}

//フォントの設定
$graph->xaxis->title->SetFont(FF_MINCHO,FS_NORMAL,10);
$graph->xaxis->title->Set("時間");
$graph->yaxis->title->SetFont(FF_MINCHO,FS_NORMAL,10);
$graph->yaxis->title->Set("ツイート数");

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

//$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);
//$graph->title->Set(mb_convert_encoding('単語比較', 'UTF-8', 'auto'));


//テストデータ
$text_data=  array('単語①', '単語②', '単語3', '単語4', '単語5');
//本番用
//$text_data = array($word_arr[0],$word_arr[1],$word_arr[2],$word_arr[3],$word_arr[4]);
$labels = $text_data;
//$graph->xaxis->SetFont(FF_GOTHIC);
//$graph->xaxis->SetTickLabels($labels);

/*
//線のマーカーを追加
$lineplot->mark->SetType(MARK_CIRCLE);
$lineplot2->mark->SetType(MARK_CIRCLE);
$lineplot3->mark->SetType(MARK_CIRCLE);
$lineplot4->mark->SetType(MARK_CIRCLE);
$lineplot5->mark->SetType(MARK_CIRCLE);
//マーカーの色
$lineplot->mark->SetColor("blue");
$lineplot2->mark->SetColor("orange");
$lineplot3->mark->SetColor("green");
$lineplot4->mark->SetColor("red");
$lineplot5->mark->SetColor(array(55, 55,55));
 */
//折れ線の色設定
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$lineplot2->SetColor("orange");
$lineplot2->SetWeight(2);

$lineplot3->SetColor("green");
$lineplot3->SetWeight(2);

$lineplot4->SetColor("red");
$lineplot4->SetWeight(2);

$lineplot5->SetColor(array(55, 55,55));
$lineplot5->SetWeight(2);

//$lineplot6->SetColor("white");
$lineplot6->SetWeight(0);

//縦（Y軸）の色を設定
$graph->yaxis->SetColor("black");
$graph->yaxis->SetWeight(2);
$graph->SetShadow();

// Display the graph
$graph->Stroke();
?>