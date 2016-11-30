<?php
include '../DBManager.php';
$y = '2016'; //検索する年
$m = '11'; //検索する月
$d = '29'; //検索する日
//2018年7月のツイートデータを日の昇順で取得
// $data = tweets_search(array("year"=>$y,"month"=>$m),null,array("day"=>1));//where,sortを指定
$data = tweets_search(array("year"=>$y,"month"=>$m),array("_id"=>1,"dow"=>1,"noun"=>1),array("day"=>1));
// $data = tweets_search(array("year"=>$y,"month"=>$m,"day"=>$d),null,array("hour"=>1));

//----------------------------週配列--------------------------------------------------
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
}

$week = array();
foreach ($data as $key => $value){//取得したデータ全体
// 	var_dump($value);
	if(isset($value['noun'])){//nounが存在する値
		foreach ($value['noun'] as $key2 => $value2){//1ツイートの名詞の中
			if(isset($value2)){
				$week[$value['dow']][$key2] = $value2;
			}
		}
	}
}
echo '<pre>';
// print_r($week['Mon']);
// echo max(array_keys($week['Mon'],max($week['Mon']))).':'.max($week['Mon']);
// echo min(array_keys($week['Mon'],min($week['Mon']))).':'.min($week['Mon']);
// print_r($sun);
// print_r($mon);
// print_r($tue);
// print_r($wed);
// print_r($thu);
// print_r($fri);
// print_r($sat);
echo '</pre>';
//------------------------------------週配列--------------------------------------
//-------------------------------------日配列-------------------------------------
// $positive = array();
// $negative = array();
// foreach ($data as $key=>$val){//ポジティブ・ネガティブの配列を作成
// 	$h = (int)$val['hour'];
// 	if(isset($val['noun'])){//nounが存在する値
// 		foreach ($val['noun'] as $key2=>$val2){//
// 			if($val2 > 0){//ポジティブ[時][名詞] = ポジティブ値
// 				$positive[$h][$key2] =$val2;
// 			}elseif($val2 < 0){//ネガティブ[時][名詞] = ネガティブ値
// 				$negative[$h][$key2] =$val2;
// 			}
// 		}
// 	}
// }

// //ポジティブ名詞
// foreach ($positive as $key=>$val){
// // var_dump($val);
// 	echo '時間：'.$key.'時'.'<br>';
// 	foreach ($positive[$key] as $keys=>$value){
// 		echo $keys.':'.$value.'<br>';
// 	}
// 	echo '<br>';
// }

// echo '<pre>';
// echo 'ポジティブ';print_r($positive);
// echo 'ネガティブ';print_r($negative);
// echo '</pre>';
//-------------------------------------日配列-------------------------------------
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

		<?php
		//ポジティブ名詞
		foreach ($positive as $key=>$val){
			foreach ($positive[$key] as $keys=>$value){
				foreach($negative[$key] as $keys2 =>$value2){
// 					if($key != null && $key2 != null){
// 						$keys3 = array_shift($negative[$key]);
// 						echo cell($key.":00",$keys,$value,$keys2,$value2);
// 						break;
// 					}
				if($keys != null){
					echo cell($key.":00",$keys,$value,$keys2,$value2);
					$keys = array_shift($key);
				}
				else if($keys2 = null){
					echo cell($key.":00",$keys,$value,$keys2,$value2);
					break;
				}
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="time.css"></link>
<link rel="stylesheet" type="text/css" href="../css/css.css"></link>
<script type="text/javascript">
function show(id){
	var obj = document.getElementById(id).style;
	var r = obj.display=(obj.display=='none')?'block':'none';
	return r;
}
</script>
</head>
<body>

	<div id="point" style='border:solid 1px #AAA'>
		<div class="row">
			<div class="time">時間</div>
			<div class="posi">ポジティブ</div>
			<div class="posi">値</div>
			<div class="nega">ネガティブ</div>
			<div class="nega">値</div>
		</div>

		<?php
//------------------------------週---------------------------------------
		$w = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
		foreach ($w as $v){
			$max_name = max(array_keys($week[$v],max($week[$v])));
			$max_value = max($week[$v]);
			$min_name = min(array_keys($week[$v],min($week[$v])));
			$min_value = min($week[$v]);

			echo cell($v,$max_name,$max_value,$min_name,$min_value);
		}

//------------------------------週---------------------------------------
//---------------------------時間----------------------------------------
		//ポジティブ名詞
// 		foreach ($positive as $key=>$val){
// 			foreach ($positive[$key] as $keys=>$value){
// 				echo cell($key,$keys,$value,null,null);
// 			}
// 		}
// 		if(count($positive) < count($negative)){
// 			$count = count($positive);
// 		}else{
// 			$count = count($negative);
// 		}
// 		for($i=0;$i<$count;$i++){
// 			echo cell('3:00','いいね','0.5','駄目','-0.7');
// 		}
//---------------------------時間-----------------------------------------
		?>
	</div>
<?php
// for($i=0;$i<3;$i++){
// 	echo '<div align="center">';
// 	echo page($i,"テスト用に作成しています_No.".$i);
// 	echo '</div>';
// }


?>
</body>
</html>