<?php
function cell($time,$good,$good_value,$bad,$bad_value){//折りたたみページ内のテーブル作成
$text = <<<EOT
	<div class='row'>
		<div class="time" style="border-bottom-style: none;">{$time}</div>
		<div>{$good}</div>
		<div>{$good_value}</div>
		<div>{$bad}</div>
		<div>{$bad_value}</div>
	</div>
EOT;
	return $text;
}
function cell2($time,$good,$good_value,$bad,$bad_value){//折りたたみページ内のテーブル作成
	$text = <<<EOT
	<div class='row'>
		<div class="time" style="border-top-style: none;border-bottom-style: none;">{$time}</div>
		<div>{$good}</div>
		<div>{$good_value}</div>
		<div>{$bad}</div>
		<div>{$bad_value}</div>
	</div>
EOT;
	return $text;
}
?>
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
include ('../header.php');
include ('../DBManager.php');
?>
<?php
//テスト用の値
$year = date('Y');
$month = date('m');
$date = date('d');

//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
?>
<?php
echo $year;
echo $month;
echo $date;

try{
// $j = tweets_search(array("year"=>$year));
// foreach ($j as $val){
// 	$hour = $val['hour'];

// 	echo array_key($val);
// 	$select=tweets_search(array("user_id"=>$_SESSION['id'],"year" =>$year,"month" =>$month,"dow" =>$youbi_select))->limit(1);
// 	$i=0;
// 	foreach ($select as $day =>$value) {
// 		$retu_day[$i]=array("day"=>$value['day'],"hour"=>$value['hour'],"noun"=>array($value['noun']));
// 		$i++;
// 	}

	$select=tweets_search(array("year" =>$year,"month" =>$month,"day" =>$date))->limit(10);
	$hour=0;
	$i=0;
	foreach ($select as $day =>$value){
		$retu_day[$i]=array("day"=>$value['day'],"hour"=>$value['hour'],"noun"=>$value['noun']);
		$i++;
	}
	print_r ($retu_day[0]['noun']);
 }
catch (Exception $e){
	echo '捕捉した例外: ',  $e->getMessage(), "\n";
}
?>
<div class="main">
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
<div id="table_first" class="table" style="border: medium solid #ff0000;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('ddd').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">一日の比較ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ▼</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="ddd" style="display:none;">
		<div onclick="obj=document.getElementById('01_p').style; obj.display=(obj.display=='none')?'block':'none';">
			<a style="cursor:pointer;">
				<div id="point" style='border:solid 1px #AAA'>
		<div class="row">
			<div class="time">時間</div>
			<div class="posi">ポジティブ</div>
			<div class="posi">値</div>
			<div class="nega">ネガティブ</div>
			<div class="nega">値</div>
		</div>

		<?php
		for($i=0;$i<5;$i++){
			echo cell('3:00','いいね','0.5','駄目','-0.7');
			if($i%2 == 0){echo cell2(null,'d','0.5','s','-0.7');}
		}
		?>
	</div>
			</a>
		</div>

	</div>
	<!--// 折りたたまれ -->
</div><!-- Fin_table_first -->

<div id="table_second" class="table" style="border: medium solid #0080ff;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('www').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">一週間の比較ㅤㅤㅤㅤㅤㅤㅤㅤㅤ▼</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="www" style="display:none;">
		<div onclick="obj=document.getElementById('01_n').style; obj.display=(obj.display=='none')?'block':'none';">
			<a style="cursor:pointer;">
			<div id="point" style='border:solid 1px #AAA'>
				<div class="row">
					<div class="day">曜日</div>
					<div class="posi">ポジティブ</div>
					<div class="posi">値</div>
					<div class="nega">ネガティブ</div>
					<div class="nega">値</div>
				</div>

				<div class='row'>
					<div class="day">月</div>
					<div>楽しい</div>
					<div>0.9</div>
					<div>疲れた</div>
					<div>-0.3</div>
				</div>

				<div class='row'>
					<div class="day">火</div>
					<div>面白い</div>
					<div>0.6</div>
					<div>つらい</div>
					<div>-0.8</div>
				</div>
			</div>
			</a>
		</div>
	</div>
	<!--// 折りたたまれ -->
</div><!-- Fin_table_second -->
</div><!-- Fin table -->

<div class="main-gallery">
	<img src="line_graph.php" alt="折れ線グラフ" />
	<img src="line_graph2.php" alt="折れ線グラフ" />
</div><!-- Fin_main_gallery -->
</div><!-- Fin_main -->
</body>
</html>