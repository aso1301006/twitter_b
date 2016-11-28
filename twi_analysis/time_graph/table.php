<?php
include '../DBManager.php';
$y = '2018'; //検索する年
$m = '07'; //検索する月
//2018年7月のツイートデータを日の昇順で取得
$data = tweets_search();
// $data = tweets_search(array("year"=>$y,"month"=>$m),null,array("day"=>1));//where,sortを指定
// $data = tweets_search(array("year"=>$y,"month"=>$m),array("_id"=>1,"dow"=>1),array("day"=>1));

//配列初期値
$sun = array();
$mon = array();
$tue = array();
$wed = array();
$thu = array();
$fri = array();
$sat = array();

foreach ($data as $val){//曜日を見て、各週の配列にデータを追加
	switch ($val['dow']){
		case "Sun"://日
			array_push($sun, $val);
			break;
		case "Mon"://月
			array_push($mon, $val);
			break;
		case "Tue"://火
			array_push($tue, $val);
			break;
		case "Wed"://水
			array_push($wed, $val);
			break;
		case "Thu"://木
			array_push($thu, $val);
			break;
		case "Fri"://金
			array_push($fri, $val);
			break;
		case "Sat"://土
			array_push($sat, $val);
			break;
	}
// echo $val['dow'];
}
echo '<pre>';
print_r($sun);
print_r($mon);
print_r($tue);
print_r($wed);
print_r($thu);
print_r($fri);
print_r($sat);
echo '</pre>';

// function page($id,$title_text){//折りたたみページを作成
// $text = <<<EOT
// 	<div onclick="show({$id})">
// 		<a style="cursor:pointer;">{$title_text}</a>
// 	</div>
// 	<div id="{$id}" style="display:none;clear:both;">
// 			{$id}
// 	</div>
// EOT;
// 	return $text;
// }

// function cell($time,$good,$good_value,$bad,$bad_value){//折りたたみページ内のテーブル作成
// $text = <<<EOT
// 	<div class='row'>
// 		<div class="time" style="border-bottom-style: none;">{$time}</div>
// 		<div>{$good}</div>
// 		<div>{$good_value}</div>
// 		<div>{$bad}</div>
// 		<div>{$bad_value}</div>
// 	</div>
// EOT;
// 	return $text;
// }
// function cell2($time,$good,$good_value,$bad,$bad_value){//折りたたみページ内のテーブル作成
// 	$text = <<<EOT
// 	<div class='row'>
// 		<div class="time" style="border-top-style: none;border-bottom-style: none;">{$time}</div>
// 		<div>{$good}</div>
// 		<div>{$good_value}</div>
// 		<div>{$bad}</div>
// 		<div>{$bad_value}</div>
// 	</div>
// EOT;
// 	return $text;
// }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="time.css"></link>
<script type="text/javascript">
function show(id){
	var obj = document.getElementById(id).style;
	var r = obj.display=(obj.display=='none')?'block':'none';
	return r;
}
</script>
</head>
<body>

<!-- 	<div id="point" style='border:solid 1px #AAA'>
		<div class="row">
			<div class="time">時間</div>
			<div class="posi">ポジティブ</div>
			<div class="posi">値</div>
			<div class="nega">ネガティブ</div>
			<div class="nega">値</div>
		</div>

		<?php
// 		for($i=0;$i<5;$i++){
// 			echo cell('3:00','いいね','0.5','駄目','-0.7');
// 			if($i%2 == 0){echo cell2(null,'d','0.5','s','-0.7');}
// 		}
		?>
	</div>
	 -->
<?php
// for($i=0;$i<3;$i++){
// 	echo '<div align="center">';
// 	echo page($i,"テスト用に作成しています_No.".$i);
// 	echo '</div>';
// }


?>
</body>
</html>