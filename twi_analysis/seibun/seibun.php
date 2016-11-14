<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="seibun.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twitter_anarysis/css/css.css"></link>
<title>助言</title>
</head>
<body>
<?php
	include '../header.php';

	$week_weak = "月";
	$nega_time="2";
	$pozi_time="17";
	$lucky_word = array("宮下","本井","福田","原田");
	var_dump($lucky_word);

// 	for($i=0;$i > 5;$i++){

// 		$lucky_word[$i]=$_POST[''];

// 	}
?>
<div class="main">
	<div id="page_title">現在のあなたの構成</div>

	<div id="Dr_mind">
		<img src="../img/20150726_04.jpg" alt="Dr.mind"></img>
	</div>

	<div class="seibun">
		構成成分表(1人当たり)
			<table id="table">
			<tr>
			<td>エネルギー</td><td>100Tcal</td>
			</tr>
			<tr>
				<td>嬉しい</td><td>50%</td>
			</tr>
			<tr>
				<td>くそ</td><td>38%</td>
			</tr>
		</table>
	</div>

	<div clss="advice">
		<div id="week">
			<?php echo $week_weak;?>曜日は元気がなさそうです。
		</div>

		<div id="nega">
			<?php echo $nega_time;?>時は注意！
		</div>

		<div id="pozi">
			<?php echo $pozi_time;?>時は絶好調！！
		</div>

		<div id="lucky">
			ラッキーワードは<?php
			for($k =0;$k>count($lucky_word);$k++){
				echo $lucky_word[$k];
			}
			?>
		</div>
	</div>
</div>
</body>
</html>
