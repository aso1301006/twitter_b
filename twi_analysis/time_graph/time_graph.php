<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="time.css"></link>
<link rel="stylesheet" type="text/css" href="../css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="../css/css.css"></link>
<link rel="stylesheet" href="flickity.min.css"></link>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.js"></script>
<script src="flickity.pkgd.min.js"></script>
<script src="vanilla.js"></script>
<script type="text/javascript">
function frameClick() {
    document.location.href = "../your_page/your_page.php";
  }

$(function(){
	$('.main-gallery').flickity({
		cellAlign: 'center', // 各画像（セル）の基準位置をしていできます。デフォルトはcenter。
		wrapAround: false, // trueで無限スライダーになります。
		contain: true, // trueでラッパー内に収まるようにスライドします。
		pageDots: true, // falseで下のドットを非表示にします。
		prevNextButtons: true,
	});
	}); 
</script>
<title>時間比較グラフ</title>
</head>
<body>
<?php
//ini_set("display_errors", On);
//error_reporting(E_ALL);
include ('../header.php');
include ('../DBManager.php');
include_once ('day_array.php');
include_once  ('week_max_min.php');
?>
<?php
//グラフに挿入するデータ
include ('t_graph_data.php');
include ('t_graph_data2.php');
?>
<?php
//テスト用の値


//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
?>
<div class="main" >
<div id="header2">
	<div class="general-button" onclick="frameClick();" style="float: left; margin: 10px;">
		<div class="button-content">
			<span class="button-text">戻る</span>
		</div>
	</div>
	<h1>時間での比較</h1>
	<div class="clear" />
	<div class="clear" />
</div><!-- Fin_header2 -->
<div id="table">
<div id="cell"></div>
<?php
//------------------------------週---------------------------------------
$text = <<<EOT
<div id="point" style='border:solid 1px #AAA'>
		<div class="row">
			<div class="time">曜日</div>
			<div class="posi">ポジティブ</div>
			<div class="posi">値</div>
			<div class="nega">ネガティブ</div>
			<div class="nega">値</div>
		</div>
EOT;

$title_text = '先週';
echo page_start(01, $title_text);//折り畳みページ開始
echo $text;
foreach ($week_day as $k => $v){
	echo cell($v['date'].' '.$k,$v['max_name'],$v['max_value'],$v['min_name'],$v['min_value']);
}
echo '</div>';
echo page_fin();//折り畳みページ終了
//------------------------------週---------------------------------------
?>
</div>
<div class="main-gallery">

	<img src="line_graph2.php?negapozi_Mon=<?=$negapozi_Mon?>&negapozi_Tue=<?=$negapozi_Tue?>&negapozi_Wed=<?=$negapozi_Wed?>&negapozi_Thu=<?=$negapozi_Thu?>&negapozi_Fri=<?=$negapozi_Fri?>&negapozi_Sat=<?=$negapozi_Sat?>&negapozi_Sun=<?=$negapozi_Sun?>" alt="折れ線グラフ" />

	<img src="line_graph.php?negapozi0=<?=$negapozi0?>&negapozi1=<?=$negapozi1?>&negapozi2=<?=$negapozi2?>&negapozi3=<?=$negapozi3?>&negapozi4=<?=$negapozi4?>&negapozi5=<?=$negapozi5?>&negapozi6=<?=$negapozi6?>&negapozi7=<?=$negapozi7?>&negapozi8=<?=$negapozi8?>&negapozi9=<?=$negapozi9?>&negapozi10=<?=$negapozi10?>&negapozi11=<?=$negapozi11?>&negapozi12=<?=$negapozi12?>&negapozi13=<?=$negapozi13?>&negapozi14=<?=$negapozi14?>&negapozi15=<?=$negapozi15?>&negapozi16=<?=$negapozi16?>&negapozi17=<?=$negapozi17?>&negapozi18=<?=$negapozi18?>&negapozi19=<?=$negapozi19?>&negapozi20=<?=$negapozi20?>&negapozi21=<?=$negapozi21?>&negapozi22=<?=$negapozi22?>&negapozi23=<?=$negapozi23?>" alt="折れ線グラフ" />

</div><!-- Fin_main_gallery -->
</div><!-- Fin_main -->

</body>
</html>