<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="word.css"></link>
<link rel="stylesheet" type="text/css" href="../css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="../css/css.css"></link>

<script type="text/javascript"src="prototype.js"></script>
<script type="text/javascript"src="check_line.js"></script>

<title>単語比較グラフ</title>

</head>
<body>
<?php
include ('../header.php'); ヘッダー

?>


<?php
//先月の年
$to_year=date('Y/m/d', strtotime(date('Y-m-1') . '-1 month'));
//
$last_date=date('Y/m/t', mktime(0,0,0, date('m'), 0, date('Y')));

//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
//------------------Python処理----------------------

		require_once('../cgi/CounterCaller.php');
		try{
			$caller = new CounterCaller();
			$user_id = "791505177299726336";
			$from_date_str = "2016/11/1 0:0:0";  // 年-月-日 時:分:秒で指定する
			$to_date_str = "2016/12/1 0:0:0";    // 開始日時 ≦ Ｘ < 終了日時 で検索される
			$caller->setArgs($user_id, $from_date_str, $to_date_str);

			$count_arr = $caller->call(PIE_CHAR);  // どのグラフの処理をするか定数で指定
			if($count_arr == null){  // 失敗した時や見つからない時はnullが帰ってくる
				print "見つかりませんでした";
			}
			else{
				$word = $count_arr['word'];
			}

			$count_arr = $caller->call(BAR_GRAPH);  // どのグラフの処理をするか定数で指定
			if($count_arr == null){  // 失敗した時や見つからない時はnullが帰ってくる
				print "見つかりませんでした";
			}
			else{
				var_dump($count_arr);
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


		//テスト用の値
		//週
		$week =(string)$to_year."～".$last_date;
		//単語
		//$word = '楽しい';

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
	<img src="pie_char.php" alt="円グラフ" />
</div><!-- Fin_pie_chart -->

<div id="bar_graph" class="graph">
	<h3>ランキング</h3>
	<img src="bar_graph.php" alt="棒グラフ" />
</div><!-- Fin_bar_graph -->

<div id="line_graph" class="graph">
	<h3>単語比較</h3>

<div id="graph">
	<img src="line_graph.php" alt="折れ線グラフ" /><br/>
</div>

<form id="form1">
	<input type="checkbox" id="check1" value=""checked="checked"onclick="checked1()"/><FONT color="blue">単語1</FONT>
	<input type="checkbox" id="check2" value=""checked="checked"onclick="checked1()"/><FONT color="yellow">単語2</FONT>
	<input type="checkbox" id="check3" value=""checked="checked"onclick="checked1()"/><FONT color="green">単語3</FONT>
	<input type="checkbox" id="check4" value=""checked="checked"onclick="checked1()"/><FONT color="red">単語4</FONT>
	<input type="checkbox" id="check5" value=""checked="checked"onclick="checked1()"/><FONT color="black">単語5</FONT>
</form>
</div><!-- Fin_line_graph -->
</div><!-- Fin_main -->
</body>
</html>