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
	<img src="line_graph.php" alt="月曜日" class="gallery-cell"/>
	<img src="line_graph2.php" alt="火曜日" class="gallery-cell"/>
	<img src="line_graph3.php" alt="水曜日" class="gallery-cell"/>
	<img src="line_graph4.php" alt="木曜日" class="gallery-cell"/>
	<img src="line_graph5.php" alt="金曜日" class="gallery-cell"/>
	<img src="line_graph6.php" alt="土曜日" class="gallery-cell"/>
	<img src="line_graph7.php" alt="日曜日" class="gallery-cell"/>
</div><!-- Fin_line_graph -->
</div><!-- Fin_main -->
</body>
</html>