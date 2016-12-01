<?php
include '../DBManager.php';
$y = '2016'; //検索する年
$m = '11'; //検索する月
$d = '01'; //検索する日

$start =  date('Y-m-d', strtotime('first day of ' . $y.$m.$d));//検索する月の初めを取得
$end = date('Y-m-d', strtotime('last day of ' . $y.$m.$d));//検索する月の終わりを取得
$sdays = first_week_date($start);//指定した日の週の日曜日の日付取得
$edays = fin_week_date($end);//指定した日の週の土曜日の日付取得

$first = new MongoDate(strtotime($sdays));
$fin = new MongoDate(strtotime($edays));

//2018年7月のツイートデータを日の昇順で取得
// $data = tweets_search(array("year"=>$y,"month"=>$m),null,array("day"=>1));//where,sortを指定
$data = tweets_search(array("created_at"=>array('$gt'=>$first, '$lte'=>$fin)),array("_id"=>1,"day"=>1,"dow"=>1,"noun"=>1),array("day"=>1));
// $data = tweets_search(array("year"=>$y,"month"=>$m,"day"=>$d),null,array("hour"=>1));

//----------------------------週配列--------------------------------------------------
$loop = 1;//週をカウント
while($start < $end){//week[第何週目][日] = array();を作成
	for($J=0;$J<7;$J++){//1週間
		$date = date('Y-m-d', strtotime("$sdays +$J day"));
		$key = date("j",strtotime($date));
		$week[$loop][$key] = array();
	}
	$start = date('Y-m-d', strtotime('+1 week' . $start));
	$sdays = date('Y-m-d', strtotime('+1 week' . $sdays));
	$key = date('j', strtotime("$key +1 week"));
	$loop++;
}

foreach ($data as $value){
	echo $value['day'].'<br>';
	var_dump($value);
}

// $count = 0;
// $w = array();
// foreach ($week as $k => $v){
// 	foreach ($v as $k2 => $v2){//1週め、2週めと配列分け $w[週目][曜日] = 名詞
// 		$v2['day'] = $k2;//日付追加
// 		$w[$count][$k] = $v2;
// 		foreach ($v2 as $k3 =>$v3){
// 			if(empty($v3)){unset($w[$count][$k][$k3]);}
// 		}
// 		$count++;
// 	}
// 	$count = 0;
// }

// foreach ($w as $key => $value){
// 	foreach ($value as $key2 => $value2){//1週の曜日の最大値・最小値
// 		$D = $value2['day'];
// 		unset($value2['day']);
// 		if(!empty($value2)){
// 			$w[$key][$key2] = array("day"=>$D,"max_name"=>max(array_keys($value2,max($value2))),"max_value"=>max($value2),"min_name"=>min(array_keys($value2,min($value2))),"min_value"=>min($value2));
// 		}
// 	}
// }
echo '<pre>';
// print_r($w);
print_r($week);
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
// $merge = array();
// foreach ($data->limit(20) as $key=>$val){//ポジティブ・ネガティブの配列を作成
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
function page_start($id,$title_text){//折りたたみページを作成
$text = <<<EOT
	<div onclick="show({$id})">
		<a style="cursor:pointer;">{$title_text}</a>
	</div>
	<div id="{$id}" style="display:none;clear:both;">

EOT;
	return $text;
}

function page_fin(){
$text = '</div>';
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

function first_week_date($ymd) {//指定した日の週の週初めの日付を取得
	$w = date("w",strtotime($ymd));
	$date =
	date('Y-m-d', strtotime("last sunday", strtotime($ymd)));
	return $date;
}

function fin_week_date($ymd) {//指定した日の週の週終わりの日付を取得
	$w = date("w",strtotime($ymd));
	$date =
	date('Y-m-d', strtotime("next saturday", strtotime($ymd)));
	return $date;
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
<?php
//------------------------------週---------------------------------------
$text = <<<EOT
<div id="point" style='border:solid 1px #AAA'>
		<div class="row">
			<div class="time">曜日</div>
			<div class="posi">ポジティブ</div>
			<div class="posi">値</div>
			<div class="nega">ネガティブ</div>
			<div class="nega">値</div>
		</div>
EOT;
// 		foreach ($w as $k => $v){
// 			$title_text = ($k+1).'週目';
// 			echo page_start($k, $title_text);//折り畳みページ開始
// 			echo $text;
// 				foreach ($v as $k2 => $v2){//表作成
// 					echo cell($k2,$v2['max_name'],$v2['max_value'],$v2['min_name'],$v2['min_value']);
// 				}
// 				echo '</div>';
// 			echo page_fin();//折り畳みページ終了

// 		}
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

// for($i=0;$i<3;$i++){
// 	echo '<div align="center">';
// 	echo page($i,"テスト用に作成しています_No.".$i);
// 	echo '</div>';
// }


?>
</body>
</html>