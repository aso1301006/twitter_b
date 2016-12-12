<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_line.php");

$count_arr = $_GET[''];

//線の太さ0かつデータなしのダミーデータ
$ydata6 = array(0,0,0,0,0,0,0,0,0,0);

//グラフの生成
$timer = new JpgTimer();
$timer->Push();

//グラフのサイズ（横×縦）とマージンの指定
$graph = new Graph(400,300);
$graph->SetScale("textlin");

//グラフの描画
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

//テストデータ
$text_data=  array('単語1', '単語2', '単語3', '単語4', '単語5');
//本番用
//$text_data = array($word_arr[0],$word_arr[1],$word_arr[2],$word_arr[3],$word_arr[4]);
$labels = $text_data;

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

//グラフ表示
$graph->Stroke();
?>