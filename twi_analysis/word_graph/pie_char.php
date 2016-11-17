<?php
include ("/../jpgraph-4.0.1/src/jpgraph.php");
include ("/../jpgraph-4.0.1/src/jpgraph_pie.php");

//円グラフ
//DB接続
$pdo = new PDO('mysql:host=localhost;dbname=test1', 'root','');
//SQL実行
$result = $pdo->prepare("SELECT* FROM graptest");
$result->execute();
//$resultの値をセット
$i=0;
while ($row = $result->fetch(PDO::FETCH_NUM)) {
	$deta[$i]=$row[0];
	$i++;
}


//$data = array(40,60,21,33);
$data=array($deta[0],$deta[1],$deta[2],$deta[3]);

$graph = new PieGraph(400,300);

$graph->SetShadow();

//フォントの設定
$graph->title->SetFont(FF_MINCHO,FS_NORMAL,20);
$graph->title->Set(mb_convert_encoding('円グラフ', 'UTF-8', 'auto'));

$p1 = new PiePlot($data);

//凡例のフォント設定
$graph->legend->SetFont(FF_GOTHIC,FS_NORMAL);
$label=array("単語2", "単語3", "単語4", "単語5");
$p1->SetLegends($label);



$graph->Add($p1);
$graph->Stroke();
?>