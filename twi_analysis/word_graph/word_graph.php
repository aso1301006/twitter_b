<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="word.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/css.css"></link>
<title>単語比較グラフ</title>
</head>
<body>
<?php
// include ('../header.php'); ヘッダー
?>
<?php
//テスト用の値
	//週
	$week = '2016/10/2～2016/11/2';
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
	<h1>単語での比較</h1>
	<div class="clear" />
	<h2><?php echo $week;?></h2>
</div><!-- Fin_header2 -->

<div id="pie_chart" class="graph">
	<h3><?php echo $word;?>の関連単語</h3>
	<img src="pie_char.php" alt="円グラフ" />
</div><!-- Fin_pie_chart -->

<div id="bar_graph" class="graph">
	<h3>ランキング</h3>
	<img src="bar_graph.php" alt="棒グラフ" />
</div><!-- Fin_bar_graph -->

<div id="line_graph" class="graph">
	<h3>単語比較</h3>
	<img src="line_graph.php" alt="折れ線グラフ" />
</div><!-- Fin_line_graph -->
</div><!-- Fin_main -->
</body>
</html>