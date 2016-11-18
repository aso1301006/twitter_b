<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="your_page.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twitter_anarysis/css/css.css"></link>
<title>あなたページ</title>
</head>
<body>
<?php
session_start();
	include '../header.php';
//	include '../DB.php';

/*
	$sql = "SELECT * FROM user WHERE id = ?";
	$data = $pdo->prepare($sql);
	$data->execute(array($id));//要らないかも？


	//----繰り返しでSERECTでとってきた値を表示----------
	while($row = $data ->fetch(PDO::FETCH_ASSOC)){
		$negapozi = $row['negapozi'];
	}
*/
$negapozi = 0.3;
$kind;
$color;
//今日の日付取得
$today = date("Y年m月d日");
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
				$color="#F00";
			}elseif ($negapozi > 0){
				echo "<img src='../img/人_赤.png' alt='people' width='30%' height='30%'></img>";
				$kind="ポジティブ";
				$color="#F00";
			}else {
				echo "<img src='../img/人_青.png' alt='people' width='30%' height='30%'></img>";
				$kind="ネガティブ";
				$color="#00F";
			}
		?>
		</div>
<!-- ------------------- -->

<!-- ネガポジ表示部分 -->
		<div id="comment">
			<img src="../img/hukidasi.png" alt="comment" width="25%" height="25%"></img>
			<a id="comment_text"><?php echo $kind;?>です！<br/>ネガポジ度：<?php echo $negapozi;?></a>
		</div>
<!-- ---------------  -->

<!-- 右配置のボタンたち -->
		<div id="word_button">
			<a href="../word/word.php"><img src="../img/word_button.png" alt="word_link" width="43%" height="43%" ></img></a>
		</div>

		<div id="week_button">
			<a href="../week/week.php"><img src="../img/week_button.png" alt="word_link" width="37%" height="37%"></img></a>
		</div>

		<div id="advice_button">
			<a href="../seibun/seibun.php"><img src="../img/advice.png" alt="advice_link" width="37%" height="37%"></img></a>
		</div>
<!-- ---------- -->

<!-- 左配置のボタンたち -->
		<div id="time_button">
			<a href="../time/time.php"><img src="../img/time_button.png" alt="word_link" width="40%" height="40%"></img></a>
		</div>

		<div id="history_button">
			<a href="../history/history_top.php"><img src="../img/走る.png" alt="word_link" width="50%" height="12%"></img>
			</a>
		</div>
<!-- ---------- -->

	</div>
</body>
</html>
