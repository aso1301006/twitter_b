<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="time.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/css.css"></link>
<title>時間比較グラフ</title>
<script type="text/javascript">
function time_sel(c){
	//やじるしの結果値を格納する
	var value_icon;
	var value_title;
	switch(c){
	case 01://左
		value_icon = '<div class="time_sel_img" style="float: left;" onclick="time_sel(02)">';
		value_icon += '<input type="image" src="http://localhost/twi_analysis/img/week_arrow02.png" alt="左" width="80px" height="50px" />';
		value_icon += '<h2>1日で比較</h2></div>';
		value_icon += '<div class="time_sel" style="float: right;" />';
		value_title = '<h2>1週間の比較</h2>';
		break;
	case 02://右
		value_icon = '<div class="time_sel_img" style="float: right;" onclick="time_sel(01)">';
		value_icon += '<img src="http://localhost/twi_analysis/img/week_arrow01.png" alt="右" width="80px" height="50px" />';
		value_icon += '<h2>1週間で比較</h2></div>';
		value_icon += '<div class="time_sel" style="float: left;" />';
		value_title = '<h2>1日の比較</h2>';
		break;
	}
	var icon = document.getElementById("select_time");
	icon.innerHTML = value_icon;
	var title = document.getElementById("middle");
	title.innerHTML = value_title;
}
window.onload=function(){time_sel(02);}
</script>
</head>
<body>
<?php
include ('../header.php');
?>
<?php
//テスト用の値


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
	<h1>時間での比較</h1>
	<div class="clear" />
	<div id="time_select">
		<div id="select_time"></div>
		<div id="middle" class="time_sel"></div>
	</div><!-- Fin_time_select -->
	<div class="clear" />
</div><!-- Fin_header2 -->

<div id="line_graph" class="graph" style="text-align: center">
	<img src="line_graph.php" alt="折れ線グラフ" />
</div><!-- Fin_line_graph -->

<div id="table" style="text-align: center">
<div id="table_left" class="table" style="border: medium solid #ff0000; width: 300px">
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