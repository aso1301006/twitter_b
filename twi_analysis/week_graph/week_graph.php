<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="week.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/css.css"></link>
<title>曜日比較グラフ</title>
</head>
<body>
<?php
// include ('../header.php'); ヘッダー
?>
<?php
//テスト用の値
	//週
	$prev = '日曜日';
	$week = '月曜日';
	$next = '火曜日';
	//単語
	$word = '楽しい';

//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
?>
<div class="main"> <!-- テスト用に作成。ページ完成後はincludeを適用して削除する -->
	<div id="home_button">
		<a href="http://localhost/twi_analysis/main/main.php"><img src="http://localhost/twi_analysis/img/home_icon.png." alt="home" width="45px" height="45px" /></a>
	</div>
	<div id="system_name">
		<img src="http://localhost/twi_analysis/img/twi析.png" alt="システム名" width="100px" height="45px"></img>
	</div>
	<div id="user_info">
		<div class="icon">
			<img src="http://localhost/twi_analysis/img/motoi.png" alt="user_icon" width="50px" height="50px"	style="border:solid 1px #AAA;"></img>
		</div>
		<div class="info">
			<a>@test_twitter</a><br/><a><font size="5em">John Doe</font></a>
		</div>
	</div>
	<div class="border" style="margin-top:5.5%;" />
</div>

<div class="main">
<div id="header2">
	<div class="general-button" style="float: left; margin: 10px;">
		<div class="button-content">
			<span class="button-text">戻る</span>
		</div>
	</div>
	<h1>曜日との比較</h1>
	<div class="clear" />
	<div id="week_select">
		<div id="left" class="week_sel" style="float: left;">
			<img src="http://localhost/twi_analysis/img/week_arrow02.png" alt="左" width="80px" height="50px" />
			<?php echo '<h2>'.$prev.'</h2>';?>
		</div>
		<div id="middle" class="week_sel">
			<?php echo '<h2>'.$week.'</h2>';?>
		</div>
		<div id="right" class="week_sel" style="float: right;">
			<img src="http://localhost/twi_analysis/img/week_arrow01.png" alt="右" width="80px" height="50px" />
			<?php echo '<h2>'.$next.'</h2>';?>
		</div>
	</div><!-- Fin_week_select -->
	<div class="clear" />
</div><!-- Fin_header2 -->

<div id="line_graph" class="graph" style="text-align: center">
	<img src="line_graph.php" alt="折れ線グラフ" />
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