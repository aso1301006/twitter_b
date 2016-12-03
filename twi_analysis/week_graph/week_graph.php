<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" href="flickity.min.css"></link>
<link rel="stylesheet" type="text/css" href="week.css"></link>
<link rel="stylesheet" type="text/css" href="../css/back_button.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/css.css"></link>
<script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.js"></script>
<script src="flickity.pkgd.min.js"></script>
<script src="vanilla.js"></script>
<script type="text/javascript">
//戻るボタン
function frameClick() {
    document.location.href = "../your_page/your_page.php";
  }

$(function(){
$('.main-gallery').flickity({
	cellAlign: 'center', // 各画像（セル）の基準位置をしていできます。デフォルトはcenter。
	wrapAround: true, // trueで無限スライダーになります。
	contain: true, // trueでラッパー内に収まるようにスライドします。
	pageDots: true, // falseで下のドットを非表示にします。
	prevNextButtons: true,
});
});

//jQuery
function listener(/* parameters */) {
  console.log('eventName happened');
}
// bind event listener
// $carousel.on( 'eventName.flickity', listener );
// $carousel.on( 'scroll.flickity', function( event, progress ) {
//   console.log( 'Flickity scrolled ' + progress * 100 + '%' )
// })

$carousel.on( 'scroll.flickity', function( event, progress ) {
  progress = Math.max( 0, Math.min( 1, progress ) );
  $progressBar.width( progress * 100 + '%' );
});
// unbind event listener
$carousel.off( 'eventName.flickity', listener );
// bind event listener to trigger once. note ONE not ON
$carousel.one( 'eventName.flickity', function() {
  console.log('eventName happened just once');
});



</script>
<title>曜日比較グラフ</title>
</head>
<body>
<?php
include ('../header.php');
include '../DBManager.php';
?>
<?php
set_time_limit(180);
include ('w_graph_data_mon.php');
include ('w_graph_data_tue.php');
include ('w_graph_data_wed.php');
include ('w_graph_data_thu.php');
include ('w_graph_data_Fri.php');
include ('w_graph_data_sat.php');
include ('w_graph_data_sun.php');
?>
<?php
//テスト用の値
	//週
// 	$prev = '日曜日';
// 	$week = '月曜日';
// 	$next = '火曜日';
	//単語
//	$word = '楽しい';

//echo $word;
$year=date("Y");
$month=date("m");

$youbi_select= "Mon";
if(isset($_POST['youbi_select'])){
	$youbi_select=$_POST['youbi_select'];
}

switch ($youbi_select){
	case "Mon":
		$select_week ="月曜日";
		break;
	case "Tue":
		$select_week ="火曜日";
		break;
	case "Wed":
		$select_week ="水曜日";
		break;
	case "Thu":
		$select_week ="木曜日";
		break;
	case "Fri":
		$select_week ="金曜日";
		break;
	case "Sat":
		$select_week ="土曜日";
		break;
	case "Sun":
		$select_week ="日曜日";
		break;
}

//DBから取得し、ネガポジ判定
$i=0;
$k=0;
$pozitive=array();
$negative=array();



$select=tweets_search(array("user_id"=>$_SESSION['id'],"year" =>$year,"month" =>$month,"dow" =>$youbi_select))->limit(2);
foreach ($select as $day =>$value) {
	$retu_day[$i]=array("day"=>$value['day'],"hour"=>$value['hour'],"noun"=>$value['noun']);
	$i++;
	foreach ($value['noun'] as $motoi =>$value2){
		$word[$k]=$value['noun'];
	}
	$k++;
}
var_dump($retu_day);
var_dump(array_values($word));

foreach ($word as $motoi) {
    if (array_values($word) > 0) {
		array_push($pozitive, current($word));
		echo "あいう";
	}
	else if(array_values($word) < 0){
		array_push($negative, current($word));
		echo "かきく";
	}
	next($word);

}
//var_dump($pozitive);
//var_dump($negative);

//グラフに値を送信する方法
	//<img>内のsrcに呼び出すグラフの.php後にGet送信のように値を書き込み
	//例：<img src="test.php?parameter1=aaa&parameter2=bbb" alt="テスト"/>
?>


<div class="main">
<div id="header2">
		<div class="general-button" onclick="frameClick();" style="float: left; margin: 10px;">
			<div class="button-content">
				<span class="button-text">戻る</span>
			</div>
		</div>
	<h1>曜日ごとの比較</h1>
	<div class="clear" />
	<div class="clear" />
</div><!-- Fin_header2 -->

<div id="table">
<form action="week_graph.php" method="post" name="youbi">
	<select name="youbi_select" onChange="this.form.submit()">
		<option selected>曜日選択</option>
		<option value="Mon">月曜日</option>
		<option value="Tue">火曜日</option>
		<option value="Wed">水曜日</option>
		<option value="Thu">木曜日</option>
		<option value="Fri">金曜日</option>
		<option value="Sat">土曜日</option>
		<option value="Sun">日曜日</option>
	</select>
</form>
<?php

echo "<a id='week_select'><font size='4em'>　　　".$select_week."</font></a>";

?>
<br><br>
<div id="table_first" class="table" style="border: medium solid #ff0000;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('xxxxx').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">1週目ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ▼</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="xxxxx" style="display:none;">
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

				<div class='row'>
					<div class="time">3:00</div>
					<div>いいね</div>
					<div>0.5</div>
					<div>駄目ね</div>
					<div>-0.7</div>
				</div>

				<div class='row'>
					<div class="time">4:00</div>
					<div>良い</div>
					<div>0.4</div>
					<div>悪い</div>
					<div>-0.5</div>
				</div>
			</div>
			</a>
		</div>

	</div>
	<!--// 折りたたまれ -->
</div><!-- Fin_table_first -->

<div id="table_second" class="table" style="border: medium solid #0080ff;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('yyy').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">2週目ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ▼</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="yyy" style="display:none;">
		<div onclick="obj=document.getElementById('01_n').style; obj.display=(obj.display=='none')?'block':'none';">
			<a style="cursor:pointer;">
			<div id="point" style='border:solid 1px #AAA'>
				<div class="row">
					<div class="time">時間</div>
					<div class="posi">ポジティブ</div>
					<div class="posi">値</div>
					<div class="nega">ネガティブ</div>
					<div class="nega">値</div>
				</div>

				<div class='row'>
					<div class="time">5.00</div>
					<div>楽しい</div>
					<div>0.9</div>
					<div>疲れた</div>
					<div>-0.3</div>
				</div>

				<div class='row'>
					<div class="time">6.00</div>
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

<div id="table_third" class="table" style="border: medium solid #ffff00;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('zzzzz').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">3週目ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ▼</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="zzzzz" style="display:none;">
		<div onclick="obj=document.getElementById('01_a').style; obj.display=(obj.display=='none')?'block':'none';">
			<a style="cursor:pointer;">
			<div id="point" style='border:solid 1px #AAA'>
				<div class="row">
					<div class="time">時間</div>
					<div class="posi">ポジティブ</div>
					<div class="posi">値</div>
					<div class="nega">ネガティブ</div>
					<div class="nega">値</div>
				</div>

				<div class='row'>
					<div class="time">3.00</div>
					<div>いいね</div>
					<div>0.5</div>
					<div>駄目ね</div>
					<div>-0.7</div>
				</div>

				<div class='row'>
					<div class="time">4.00</div>
					<div>良い</div>
					<div>0.4</div>
					<div>悪い</div>
					<div>-0.5</div>
				</div>
			</div>
			</a>
		</div>

	</div>
	<!--// 折りたたまれ -->
</div><!-- Fin_table_third -->

<div id="table_forth" class="table" style="border: medium solid #7cfc00;">
	<!-- 折りたたみ -->
	<div onclick="obj=document.getElementById('zzz').style; obj.display=(obj.display=='none')?'block':'none';">
		<a style="cursor:pointer;">4週目ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ▼</a>
	</div>
	<!--// 折りたたみ -->

	<!-- 折りたたまれ -->
	<div id="zzz" style="display:none;">
		<div onclick="obj=document.getElementById('01_b').style; obj.display=(obj.display=='none')?'block':'none';">
			<a style="cursor:pointer;">
			<div id="point" style='border:solid 1px #AAA'>
				<div class="row">
					<div class="time">時間</div>
					<div class="posi">ポジティブ</div>
					<div class="posi">値</div>
					<div class="nega">ネガティブ</div>
					<div class="nega">値</div>
				</div>

				<div class='row'>
					<div class="time">3.00</div>
					<div>いいね</div>
					<div>0.5</div>
					<div>駄目ね</div>
					<div>-0.7</div>
				</div>

				<div class='row'>
					<div class="time">4.00</div>
					<div>良い</div>
					<div>0.4</div>
					<div>悪い</div>
					<div>-0.5</div>
				</div>
			</div>
			</a>
		</div>

	</div>
	<!--// 折りたたまれ -->
</div><!-- Fin_table_forth -->
<div style="height:400px; background-color:orange"></div>
</div><!--  Fin_table -->

<div class="main-gallery">
	<img src="line_graph.php?con_mon_week1=<?=$con_mon_week1?>&&con_mon_week2=<?=$con_mon_week2?>&&con_mon_week3=<?=$con_mon_week3?>&&con_mon_week4=<?=$con_mon_week4?>&&con_mon_week5=<?=$con_mon_week5?>" alt="月曜日" class="gallery-cell"/>
	<img src="line_graph2.php?con_tue_week1=<?=$con_tue_week1?>&&con_tue_week2=<?=$con_tue_week2?>&&con_tue_week3=<?=$con_tue_week3?>&&con_tue_week4=<?=$con_tue_week4?>&&con_tue_week5=<?=$con_tue_week5?>" alt="火曜日" class="gallery-cell"/>
	<img src="line_graph3.php?con_wed_week1=<?=$con_wed_week1?>&&con_wed_week2=<?=$con_wed_week2?>&&con_wed_week3=<?=$con_wed_week3?>&&con_wed_week4=<?=$con_wed_week4?>&&con_wed_week5=<?=$con_wed_week5?>" alt="水曜日" class="gallery-cell"/>
	<img src="line_graph4.php?con_thu_week1=<?=$con_thu_week1?>&&con_thu_week2=<?=$con_thu_week2?>&&con_thu_week3=<?=$con_thu_week3?>&&con_thu_week4=<?=$con_thu_week4?>&&con_thu_week5=<?=$con_thu_week5?>" alt="木曜日" class="gallery-cell"/>
	<img src="line_graph5.php?con_fri_week1=<?=$con_fri_week1?>&&con_fri_week2=<?=$con_fri_week2?>&&con_fri_week3=<?=$con_fri_week3?>&&con_fri_week4=<?=$con_fri_week4?>&&con_fri_week5=<?=$con_fri_week5?>" alt="金曜日" class="gallery-cell"/>
	<img src="line_graph6.php?con_sat_week1=<?=$con_sat_week1?>&&con_sat_week2=<?=$con_sat_week2?>&&con_sat_week3=<?=$con_sat_week3?>&&con_sat_week4=<?=$con_sat_week4?>&&con_sat_week5=<?=$con_sat_week5?>" alt="土曜日" class="gallery-cell"/>
	<img src="line_graph7.php?con_sun_week1=<?=$con_sun_week1?>&&con_sun_week2=<?=$con_sun_week2?>&&con_sun_week3=<?=$con_sun_week3?>&&con_sun_week4=<?=$con_sun_week4?>&&con_sun_week5=<?=$con_sun_week5?>" alt="日曜日" class="gallery-cell"/>
</div><!-- Fin_line_graph -->
</div><!-- Fin_main -->
</body>
</html>
