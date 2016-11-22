<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" href="flickity.min.css"></link>
<link rel="stylesheet" type="text/css" href="week.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/css.css"></link>
<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.js"></script>
<script src="flickity.pkgd.min.js"></script>
<script type="text/javascript">
$(function(){
$('.main-gallery').flickity({
	cellAlign: 'center',
	wrapAround: true,
	contain: true,
	 pageDots: true,
	wrapAround: true,
	pageDots: false
});
});
</script>
<title>曜日比較グラフ</title>
</head>
<body>
<?php
include ('../header.php');
?>
<?php
//テスト用の値
	//週
// 	$prev = '日曜日';
// 	$week = '月曜日';
// 	$next = '火曜日';
	//単語
	$word = '楽しい';

//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
?>


<div class="main">
<div id="header2">
	<div class="general-button" style="float: left; margin: 10px;">
		<div class="button-content">
			<span class="button-text">戻る</span>
		</div>
	</div>
	<h1>曜日ごとの比較</h1>
	<div class="clear" />
	</div><!-- Fin_week_select -->
	<div class="clear" />
</div><!-- Fin_header2 -->

<div class="main-gallery">
	<img src="line_graph.php" alt="折れ線グラフ" class="gallery-cell"/>
	<img src="line_graph.php" alt="" class="gallery-cell"/>
	<img src="line_graph.php" alt="折れ線グラフ" class="gallery-cell"/>
</div><!-- Fin_line_graph -->

<div id="table" style="text-align: center">
<div id="table_left" class="table" style="border: medium solid #ff0000;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('xxxxx').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">クリックでポジティブ</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="xxxxx" style="display:none;clear:both;">
		<div onclick="obj=document.getElementById('01_p').style; obj.display=(obj.display=='none')?'block':'none';">
			<a style="cursor:pointer;">01時</a>
		</div>
		<div id="01_p" style="display:none;clear:both;">
			01時のテーブル
		</div>
	</div>
	<!--// 折りたたまれ -->
</div><!-- Fin_table_left -->

<div id="table_right" class="table" style="border: medium solid #0080ff;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('yyy').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">クリックでネガティブ</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="yyy" style="display:none;clear:both;">
		<div onclick="obj=document.getElementById('01_n').style; obj.display=(obj.display=='none')?'block':'none';">
			<a style="cursor:pointer;">01時</a>
		</div>
		<div id="01_n" style="display:none;clear:both;">
			01時のテーブル
		</div>
	</div>
	<!--// 折りたたまれ -->
</div><!-- Fin_table_right -->
</div>
</div><!-- Fin_main -->
</body>
</html>