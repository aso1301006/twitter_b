<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_line.php");

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

//グラフのサイズ指定
$graph = new Graph(700,400);
$graph->SetScale("textlin");

//グラフの範囲指定
$graph->SetScale("textint", -1, 1);
$graph->yscale->ticks->Set(0.5,0.1);

//マージンの指定
$graph->img->SetMargin(40,60,20,60);

//グラフのタイトル指定
$title = mb_convert_encoding("一日の比較", "UTF-8", "auto");
$graph->title->Set($title);
$graph->title->SetFont(FF_MINCHO);

//凡例のフォント設定
 $graph->legend->SetFont(FF_GOTHIC,FS_NORMAL);

//グラフの描画
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot->SetLegend("今日のネガポジ平均"); 

//グラフの追加
$graph->Add($lineplot);

//XY軸の名前
$graph->xaxis->title->Set(mb_convert_encoding("時間", "UTF-8", "auto"));
$graph->yaxis->title->Set(mb_convert_encoding("ネガポジ値", "UTF-8", "auto"));
$graph->yaxis->title->SetFont(FF_MINCHO);
$graph->xaxis->title->SetFont(FF_MINCHO);
$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);

//グラフの影の追加
$graph->SetShadow();

//グラフの表示
$graph->Stroke();
