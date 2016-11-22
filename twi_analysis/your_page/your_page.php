<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="your_page.css"></link>
<link rel="stylesheet" type="text/css" href="../css/css.css"></link>
<title>あなたページ</title>
</head>
<body>
<?php
//session_start();
include '../header.php';
include '../mongodb.php';


//今日の日付取得
//$today = "2016年11月18日";
$today = date("y年m月d日");
$count=0;
$sum=0;
$negapozi=0;

//ネガポジ値計算
	$select=$tweets->find(array("user_id"=>$_SESSION['id'],"t_time" => new MongoRegex("/".$today."/")));

	foreach ($select as $res) {
		$sum=$sum + ($res['negapozi']);
		$count=$count + 1;
	}
//今日のツイートがない場合
if(!($count == null)){
	$ave=$sum/$count;
	$negapozi=round($ave,3);
}
//echo "合計".$sum;
//echo "件数".$count;
//echo "平均".$ave;
?>

	<div class="main">
		<div id="page_title"><h1>今日のあなた</h1></div>
		<div id="today"><?php echo $today;?></div>


<!-- ---------人-------- -->
		<div id="people">
		<?php
			if($negapozi == 0){
				echo "<img src='../img/人_黒.png' alt='people' width='30%' height='30%'></img>";
				$kind="平常";
//				$color="#F00";
			}elseif ($negapozi > 0){
				echo "<img src='../img/人_赤.png' alt='people' width='30%' height='30%'></img>";
				$kind="ポジティブ";
//				$color="#F00";
			}else {
				echo "<img src='../img/人_青.png' alt='people' width='30%' height='30%'></img>";
				$kind="ネガティブ";
//				$color="#00F";
			}
		?>
		</div>
<!-- ------------------- -->

<!-- ネガポジ表示部分 -->
		<div id="comment">
			<img src="../img/hukidasi.png" alt="comment" width="28%" height="25%"></img>
			<a id="comment_text"><?php echo $kind;?>です！<br/>ネガポジ度：<?php echo $negapozi;?></a>
		</div>
<!-- ---------------  -->

<!-- 右配置のボタンたち -->
		<div id="word_button">
			<a href="../word_graph/word_graph.php"><img src="../img/word_button.png" alt="word_link" width="40%" height="40%" class="float1"></img></a>
		</div>

		<div id="week_button">
			<a href="../week_graph/week_graph.php"><img src="../img/week_button.png" alt="word_link" width="39%" height="39%" class="float2"></img></a>
		</div>

		<div id="advice_button">
			<a href="../seibun/seibun.php"><img src="../img/advice.png" alt="advice_link" width="37%" height="37%"></img></a>
		</div>
<!-- ---------- -->

<!-- 左配置のボタンたち -->
		<div id="time_button">
			<a href="../time_graph/time_graph.php"><img src="../img/time_button.png" alt="word_link" width="40%" height="40%" class="float1"></img></a>
		</div>

		<div id="history_button">
			<a href="../history/history_top.php"><img src="../img/走る.png" alt="word_link" width="50%" height="12%"></img>
			</a>
		</div>
<!-- ---------- -->
		<Span Style="Font-Size:3pt"><br></Span>
	</div>
</body>
</html>
