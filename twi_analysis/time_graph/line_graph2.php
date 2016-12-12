<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_line.php");

$negapozi_Mon=$_GET['negapozi_Mon'];
$negapozi_Tue=$_GET['negapozi_Tue'];
$negapozi_Wed=$_GET['negapozi_Wed'];
$negapozi_Thu=$_GET['negapozi_Thu'];
$negapozi_Fri=$_GET['negapozi_Fri'];
$negapozi_Sat=$_GET['negapozi_Sat'];
$negapozi_Sun=$_GET['negapozi_Sun'];

$ydata = array($negapozi_Mon,$negapozi_Tue,$negapozi_Wed,$negapozi_Thu,$negapozi_Fri,$negapozi_Sat,$negapozi_Sun);

$timer = new JpgTimer();
$timer->Push();

//グラフのサイズ指定
$graph = new Graph(700,400);
//$graph->SetScale("textlin");

//グラフの範囲指定
$graph->SetScale("textint", -1, 1);
$graph->yscale->ticks->Set(0.5,0.1);

//マージン指定
$graph->img->SetMargin(40,60,20,60);

$graph->xaxis->SetFont(FF_GOTHIC);
$week=array("月","火","水","木","金","土","日");
$graph->xaxis->SetTickLabels($week);

//凡例のフォント設定
 $graph->legend->SetFont(FF_GOTHIC,FS_NORMAL);

//グラフのタイトル指定
$title = mb_convert_encoding("一週間の比較", "UTF-8", "auto");
$graph->title->Set($title);
$graph->title->SetFont(FF_MINCHO);

//グラフの描画
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot->SetLegend("先週一週間のネガポジ平均"); 

//グラフの追加
$graph->Add($lineplot);

//XY軸の名前
$graph->xaxis->title->Set(mb_convert_encoding("曜日", "UTF-8", "auto"));
$graph->yaxis->title->Set(mb_convert_encoding("ネガポジ値", "UTF-8", "auto"));
$graph->yaxis->title->SetFont(FF_MINCHO);
$graph->xaxis->title->SetFont(FF_MINCHO);

$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

//グラフの影の追加
$graph->SetShadow();

//グラフの表示
$graph->Stroke();
?>