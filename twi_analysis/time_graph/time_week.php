<?php
include '../DBManager.php';
$y = '2016'; //検索する年
$m = '11'; //検索する月
$d = '07'; //今日の日付
$w=3;  //今日の曜日
//2018年7月のツイートデータを日の昇順で取得
//$data = tweets_search(array("year"=>$y,"month"=>$m),null,array("day"=>1));//where,sortを指定
//$data = tweets_search(array("year"=>$y,"month"=>$m),array("_id"=>1,"dow"=>1,"noun"=>1),array("day"=>1));
//$data = tweets_search(array("year"=>$y,"month"=>$m,"day"=>$d),null,array("hour"=>1));

//----------------------------週配列--------------------------------------------------
//---------日曜日に合わせる------------------------------
//echo $w;
$day_idou;

switch($w){
	case 0:
		$day_idou=-7;
		break;
	case 1:
		$day_idou=-8;
		break;
	case 2:
		$day_idou=-9;
		break;
	case 3:
		$day_idou=-10;
		break;
	case 4:
		$day_idou=-11;
		break;
	case 5:
		$day_idou=-12;
		break;
	case 6:
		$day_idou=-13;
		break;
}
//Betweenが使えないので一週間分の日付をそれぞれ格納
$sun_day=$d+($day_idou);//表示が始まる日曜日
$sat_day=$sun_day+6;    //表示が終わる土曜日
//-------------------------------------------------------
//月が変わった時、先月文を抽出

$before_month=array();//先月
$now_month=array();   //今月
$before_last_day=date('d', mktime(0, 0, 0, date('m'), 0, date('Y')));
$before_last_month=date('m', mktime(0, 0, 0, date('m'), 0, date('Y')));


//先月にまたぐ場合、先月末日から―して日曜日を算出
if($sun_day <= 0){
	$sun_day=$sun_day+($before_last_day);
	$sun_day=$y."-".$before_last_month."-".$sun_day;
}else{
	$sun_day=date('Y-m')."-".$sun_day;
}
//先月にまたぐ場合、今月の日曜日を表示する


//--------------------------------------------------------
//-----------------------------------------------------

if(isset($before_month)){
$data = tweets_search(array("year"=>$y,"month"=>$m),null,array("day"=>1));
}
//配列初期値
$sun = array();
$mon = array();
$tue = array();
$wed = array();
$thu = array();
$fri = array();
$sat = array();

foreach ($data as $dow){//曜日を見て、各週の配列にデータを追加
	var_dump($dow);
	switch ($dow['dow']){
		case "Sun"://日
			array_push($sun, $dow);
			break;
		case "Mon"://月
			array_push($mon, $dow);
			break;
		case "Tue"://火
			array_push($tue, $dow);
			break;
		case "Wed"://水
			array_push($wed, $dow);
			break;
		case "Thu"://木
			array_push($thu, $dow);
			break;
		case "Fri"://金
			array_push($fri, $dow);
			break;
		case "Sat"://土
			array_push($sat, $dow);
			break;
	}
}

$week = array();
foreach ($data as $key => $value){//取得したデータ全体
	var_dump($value);
	if(isset($value['noun'])){//nounが存在する値
		foreach ($value['noun'] as $key2 => $value2){//1ツイートの名詞の中
			if(isset($value2)){
				$week[$value['dow']][$key2] = $value2;
			}
		}
	}
}

// echo '<pre>';
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
// echo '</pre>';
//------------------------------------週配列--------------------------------------
//-------------------------------------日配列-------------------------------------
$positive = array();
$negative = array();
foreach ($data as $key=>$val){//ポジティブ・ネガティブの配列を作成
	var_dump($val);
	$h = (int)$val['hour'];
	if(isset($val['noun'])){//nounが存在する値
		foreach ($val['noun'] as $key2=>$val2){//
			if($val2 > 0){//ポジティブ[時][名詞] = ポジティブ値
				$positive[$h][$key2] =$val2;
			}elseif($val2 < 0){//ネガティブ[時][名詞] = ネガティブ値
				$negative[$h][$key2] =$val2;
			}
		}
	}
}

//ポジティブ名詞
foreach ($positive as $key=>$val){
// var_dump($val);
	echo '時間：'.$key.'時'.'<br>';
	foreach ($positive[$key] as $keys=>$value){
		echo $keys.':'.$value.'<br>';
	}
	echo '<br>';
}

// echo '<pre>';
// echo 'ポジティブ';print_r($positive);
// echo 'ネガティブ';print_r($negative);
// echo '</pre>';
//-------------------------------------日配列-------------------------------------
function page($id,$title_text){//折りたたみページを作成
$text = <<<EOT
	<div onclick="show({$id})">
		<a style="cursor:pointer;">{$title_text}</a>
	</div>
	<div id="{$id}" style="display:none;clear:both;">
			{$id}
	</div>
EOT;
	return $text;
}

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

		<?php
		//ポジティブ名詞
		foreach ($positive as $key=>$val){
			foreach ($positive[$key] as $keys=>$value){
				foreach($negative[$key] as $keys2 =>$value2){
					if($key != null && $key2 != null){
						$keys3 = array_shift($negative[$key]);
						echo cell($key.":00",$keys,$value,$keys2,$value2);
						break;
					}
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
		$w3 = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
// 		foreach ($w3 as $v){
// 			$max_name = max(array_keys($week[$v],max($week[$v])));
// 			$max_value = max($week[$v]);
// 			$min_name = min(array_keys($week[$v],min($week[$v])));
// 			$min_value = min($week[$v]);

// 			echo cell($v,$max_name,$max_value,$min_name,$min_value);
// 		}

//------------------------------週---------------------------------------

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