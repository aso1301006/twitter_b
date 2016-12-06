<?php
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_pie.php");

//テスト用データ
$data = array(40,60,21,33);
/*

//データ受け取り
foreach($word as $key =>$value){
	foreach($word as $key =>$value){
	$data[]=$value;
	$text_data[]=$word;
	}
}

*/

//$data=array($deta[0],$deta[1],$deta[2],$deta[3]);

$graph = new PieGraph(400,300);

$graph->SetShadow();

//フォントの設定
//$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);
//$graph->title->Set(mb_convert_encoding('円グラフ', 'UTF-8', 'auto'));

$p1 = new PiePlot($data);

//凡例のフォント設定
$graph->legend->SetFont(FF_GOTHIC,FS_NORMAL);

$text_data=array("単語2", "単語3", "単語4", "単語5");
//$label=array("単語2", "単語3", "単語4", "単語5");
$p1->SetLegends($text_data);



$graph->Add($p1);
$graph->Stroke();
?>