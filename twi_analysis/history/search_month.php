<?php
include 'DBManager.php';

error_reporting(0);

$group = tweets_search(null,array("year"=>1,"month"=>1),null);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
</head>
<body>
<?php
$array_yearmonth = array();
$array_year = array();
foreach ($group as $val){
	if(isset($val['year'])){
		$push_year = $val["year"];
		array_push($array_year, $push_year);
	}
	if(isset($val['month'])){
		$push_month = $val['month'];
		array_push($array_yearmonth, $push_year.$push_month);
	}

//			array_push($array_group,array($push_year => $push_month));

}
//配列で重複している物を削除する
$array_yearmonth = array_unique($array_yearmonth);
$array_year = array_unique($array_year);

//キーが飛び飛びになっているので、キーを振り直す
$array_yearmonth = array_values($array_yearmonth);
$array_year = array_values($array_year);

//echo '<pre>';
// print_r($array_yearmonth);
// print_r($array_year);
//echo '</pre>';
// $array_group = array_count_values($array_group);
// ksort($array_group);
?>
</body>
</html>