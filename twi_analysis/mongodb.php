<?php

// MongoDBクライアントの作成
$mongo = new MongoClient("35.162.58.174:27017");

// データベースの選択
$db = $mongo->selectDB("twi_analysis");

// コレクションの選択
$collection = $db->selectCollection("tweetdata");

//データ挿入
// $collection->insert(array("twi_id" => "1", "text" => "日本語化のテスト", "create_at" => "2016.11.16"));
// $collection->insert(array("twi_id" => "2", "text" => "test", "create_at" => "2016.11.16"));
// $collection->insert(array("twi_id" => "3", "text" => "日本語化", "create_at" => "2016.11.16"));
// $collection->insert(array("twi_id" => "3", "text" => "日本語化", "create_at" => "2016.11.16"));

//データ取得
$acquisition = $collection->find();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
</head>
<body>
<?php
echo "mongoのステータス<br>";
var_dump($mongo);
echo "<br><br>";

echo "データベースのリスト<br>";
var_dump($mongo->listDBs());
echo "<br><br>";

echo "データベースの情報<br>";
var_dump($db);
echo "<br><br>";

echo "コレクションの情報<br>";
var_dump($collection);
echo "<br><br>";

echo "データの数:";
print $collection->count();
echo "<br><br>";

echo 'データ表示';
foreach ( $acquisition as $id => $value )
{
    echo "$id: ";
    var_dump( $value );
}
echo "<br><br>";
?>
</body>
</html>