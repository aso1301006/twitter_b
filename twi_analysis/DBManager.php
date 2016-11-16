<?php
// MongoDBクライアントの作成
$mongo = new MongoClient("35.162.58.174:27017");

// データベースの選択
$db = $mongo->selectDB("twi_analysis");

function tweets_all_search(){//ツイートデータ全件取得
	//グローバル変数宣言
	global $mongo, $db;

	// MongoDBクライアントの作成
	$mongo = new MongoClient("35.162.58.174:27017");

	// データベースの選択
	$db = $mongo->selectDB("twi_analysis");

	// コレクションの選択
	$collection = $db->selectCollection("tweetdata");
	//データ取得
	$acquisition = $collection->find();
	//返り値
	return $acquisition;
}

function user_search($array){//ユーザー情報取得
	//グローバル変数宣言
	global $mongo, $db;

	// コレクションの選択
	$collection = $db->selectCollection("user_data");

	//データ取得
	$acquisition = $collection->find($array);

	//返り値
	return $acquisition;
}

function tweets_one_insert($array){//ツイートDBに1件挿入
	//グローバル変数宣言
	global $mongo, $db;

	// コレクションの選択
	$collection = $db->selectCollection("tweetdata");

	//データ挿入
	$collection->insert($array);
}
?>