<?php
include '../DBManager.php';
set_time_limit(0);//処理制限時間を無期限に
$y = '2018'; //検索する年
$m = '07'; //検索する月
$d = '08'; //検索する日

$start =  date("Y-m-d H:i:s", strtotime('first day of ' . $y.$m.$d));//検索する月の初めを取得
$end = date("Y-m-d H:i:s", strtotime('last day of ' . $y.$m.$d));//検索する月の終わりを取得
$start_day = first_week_date($start);//指定した日の週の日曜日の日付取得
$end_day = fin_week_date($end);//指定した日の週の土曜日の日付取得
//----------------------------週配列--------------------------------------------------
$loop = 1;//週をカウント
while($start_day < $end_day){//week[第何週目][曜日] = 名詞+形容詞+日付
	for($J=0;$J<7;$J++){//1週間作成
		$date = date('Y-m-d', strtotime("$start_day +$J day"));
		$key = date("D",strtotime($date));
		$week[$loop][$key] = null;
	}
	$sunday = new MongoDate(strtotime(date_utc_to_jp($start_day)));
	$saturday = next_first_week_date($start_day);
	$saturday = new MongoDate(strtotime(date_utc_to_jp($saturday)));
	$data = tweets_search(array("created_at"=>array('$gt'=>$sunday, '$lte'=>$saturday)),null,array("month"=>1,"day"=>1));
	foreach ($data as $key =>$value){
		if(isset($value['noun'])){$week[$loop][$value['dow']] = $value['noun'];}
		if(isset($value['adjective'])){$week[$loop][$value['dow']] += $value['adjective'];}
		$week[$loop][$value['dow']] += array("date"=>$value['month'].'/'.$value['day']);
	}
	$start_day = date('Y-m-d', strtotime('+1 week' . $start_day));
	$key = date('D', strtotime("$key +1 week"));
	$loop++;
}

foreach ($week as $key =>$value){//配列weekにあるnullを取り除く
	foreach ($value as $key2 =>$value2){
		foreach ($value2 as $key3 =>$value3){
			if(empty($value3)){unset($week[$key][$key2][$key3]);}
		}
	}
}

foreach ($week as $key =>$value){//配列weekの値をmax,min
	foreach ($value as $key2 =>$value2){
		$day = $week[$key][$key2]['date'];
		unset($week[$key][$key2]['date']);
		if(empty($week[$key][$key2])){
			$max_name = '～データが存在しません～';
			$max_value = '～データが存在しません～';
			$min_name = '～データが存在しません～';
			$min_value = '～データが存在しません～';
		}else{
			$max_name = max(array_keys($week[$key][$key2],max($week[$key][$key2])));
			$max_value = max($week[$key][$key2]);
			$min_name = min(array_keys($week[$key][$key2],min($week[$key][$key2])));
			$min_value = min($week[$key][$key2]);
		}
		if($max_value <= 0){
			$max_name = '～データが存在しません～';
			$max_value = '～データが存在しません～';
		}
		if($min_value >= 0){
			$min_name = '～データが存在しません～';
			$min_value = '～データが存在しません～';
		}

		$week_day[$key][$key2] = array("max_name"=>$max_name);
		$week_day[$key][$key2] += array("max_value"=>$max_value);
		$week_day[$key][$key2] += array("min_name"=>$min_name);
		$week_day[$key][$key2] += array("min_value"=>$min_value);
		$week_day[$key][$key2] += array("date"=>$day);
	}
}

function first_week_date($ymd) {//指定した日の週の週初めの日付を取得
	$date =
	date("Y-m-d H:i:s", strtotime("last sunday", strtotime($ymd)));
	return $date;
}

function fin_week_date($ymd) {//指定した日の週の週終わりの日付を取得
	$date =
	date("Y-m-d H:i:s", strtotime("next saturday", strtotime($ymd)));
	return $date;
}

function next_first_week_date($ymd) {//指定した日の次の週初めの日付を取得
	$date =
	date("Y-m-d H:i:s", strtotime("next sunday", strtotime($ymd)));
	return $date;
}

function date_utc_to_jp($utc_date){//日付を東京のタイムゾーンへ変更
	return date("Y-m-d H:i:s", strtotime($utc_date. " +9 hour"));
}

function page_start($id,$title_text){//折りたたみページを作成
	$text = <<<EOT
	<div onclick="show({$id})">
		<a style="cursor:pointer;">{$title_text}</a>
	</div>
	<div id="{$id}" style="display:none;clear:both;">

EOT;
	return $text;
}

function page_fin(){//折りたたみページを閉じる
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
foreach ($week_day as $k => $v){
	$title_text = $k.'週目';
	echo page_start($k, $title_text);//折り畳みページ開始
	echo $text;
		foreach ($v as $k2 => $v2){//表作成
			echo cell($v2['date'].' '.$k2,$v2['max_name'],$v2['max_value'],$v2['min_name'],$v2['min_value']);
		}
		echo '</div>';
	echo page_fin();//折り畳みページ終了

}
//------------------------------週---------------------------------------
?>
</body>
</html>