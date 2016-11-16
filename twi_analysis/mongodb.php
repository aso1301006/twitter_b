<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
</head>
<body>
<?php
include 'DBManager.php';

echo 'ツイートデータ全件取得';
$all_tweets = tweets_all_search();
foreach ($all_tweets as $key => $value){
	var_dump($value);
}
echo '-------------------------------------------------------------';

echo 'ユーザデータ1件取得';
$user_name = user_search(array('screen_id'=>'6clover_1301003'));
foreach ($user_name as $key => $value){
	var_dump($value);
}
echo '-------------------------------------------------------------';

echo 'ツイート1件挿入';
$insert =tweets_one_insert(array('negapozi'=>-0.999, 'text'=>'インサート1件', 'create_at'=>date('Y年　m月　d日')));
?>
</body>
</html>