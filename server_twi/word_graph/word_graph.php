<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="word.css"></link>
<link rel="stylesheet" type="text/css" href="../css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="../css/css.css"></link>

<script type="text/javascript" src="prototype.js"></script>
<script type="text/javascript" src="check_line.js"></script>

<title>単語比較グラフ</title>

</head>
<body>
<?php
include ('../header.php'); ヘッダー

?>
<br><br><br><br>

<?php
//先月の年
$to_date=date('Y/m/d', strtotime(date('Y-m-1') . '-1 month'));
//
$last_date=date('Y/m/t', mktime(0,0,0, date('m'), 0, date('Y')));

$week = $to_date."～".$last_date;


//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
//------------------Python処理----------------------

		require_once('../cgi/CounterCaller.php');
		try{
			$caller = new CounterCaller();
			$user_id = (string)$_SESSION['id'];
			$from_date_str = (string)$to_date. " 0:0:0";  // 年-月-日 時:分:秒で指定する
			$to_date_str = (string)date('Y/m/d', strtotime($last_date. '+1 day')). " 0:0:0";
			print $user_id;
			print $from_date_str;
			print $to_date_str;
			$caller->setArgs($user_id, $from_date_str, $to_date_str);

			$count_arr = $caller->call(PIE_CHAR);  // どのグラフの処理をするか定数で指定
			if($count_arr == null){  // 失敗した時や見つからない時はnullが帰ってくる
				$word = "";
				$pie_word_arr = "";
				$pie_point_arr = "";
			}
			else{
				$word = $count_arr['word'];
				// $pie_word_arr = implode(" ", $count_arr['word_arr']);
				// $pie_point_arr = implode(" ", $count_arr['point_arr']);
				// $pie_arg = "word=". $pie_word_arr. "&point=". $pie_point_arr;
				$pie_arg = http_build_query($count_arr);
			}

			$count_arr = $caller->call(BAR_GRAPH);  // どのグラフの処理をするか定数で指定
			if($count_arr == null){  // 失敗した時や見つからない時はnullが帰ってくる
				$bar_word_arr = "";
				$bar_point_arr = "";
			}
			else{
				// $bar_word_arr = implode(" ", $count_arr['word_arr']);
				// $bar_point_arr = implode(" ", $count_arr['point_arr']);
				// $bar_arg = "word=". $bar_word_arr. "&point=". $bar_point_arr;
				$bar_arg = http_build_query($count_arr);
			}

			$count_arr = $caller->call(LINE_GRAPH);  // どのグラフの処理をするか定数で指定
			if($count_arr == null){  // 失敗した時や見つからない時はnullが帰ってくる
				$line_word_arr = "";
				$line_point_arr = "";
			}
			else{
				// $line_word_arr = $count_arr['word_arr'];
				// $line_point_arr = implode(" ", $count_arr['point_arr']);
				// $line_arg = "point=". $line_point_arr;
				$line_arg = http_build_query($count_arr);
			}
		}
		catch(InvalidArgumentException $e){
			print "InvalidArgumentException：". $e->getMessage();
		}
		catch(FileNotFoundException $e){
			print "FileNotFoundException：". $e->getMessage();
		}
		catch(ExecuteException $e){
			print "ExecuteException：". $e->getMessage();
		}
		catch(Exception $e){
			print "Exception：". $e->getMessage();
		}
//------------------Python処理----------------------

?>


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
	<img src="pie_char.php?<?=$pie_arg?>" alt="円グラフ" />
</div><!-- Fin_pie_chart -->

<div id="bar_graph" class="graph">
	<h3>ランキング</h3>
	<img src="bar_graph.php?<?=$bar_arg?>" alt="棒グラフ" />
</div><!-- Fin_bar_graph -->

<div id="line_graph" class="graph">
	<h3>単語比較</h3>

<div id="graph">
	<img src="line_graph.php?<?=$line_arg?>" alt="折れ線グラフ" /><br/>
</div>

<form id="form1">
<?php
$font_color_arr = array("blue", "orange", "green", "red", "black");
for($i=0; $i<5; $i++){
echo <<<HTML
	<input type="checkbox" id="check$i" value="" checked="checked" onclick="checked1()"/><FONT color="$font_color_arr[$i]"">$line_word_arr[$i]</FONT>

HTML;
}
?>
<!-- 	<input type="checkbox" id="check2" value=""checked="checked"onclick="checked1()"/><FONT color="yellow">単語2</FONT>
	<input type="checkbox" id="check3" value=""checked="checked"onclick="checked1()"/><FONT color="green">単語3</FONT>
	<input type="checkbox" id="check4" value=""checked="checked"onclick="checked1()"/><FONT color="red">単語4</FONT>
	<input type="checkbox" id="check5" value=""checked="checked"onclick="checked1()"/><FONT color="black">単語5</FONT> -->
</form>
</div><!-- Fin_line_graph -->
</div><!-- Fin_main -->
</body>
</html>