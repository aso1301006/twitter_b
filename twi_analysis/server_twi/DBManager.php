<?php
// MongoDBクライアントの作成
$mongo = new MongoClient("35.162.58.174:27017");

// データベースの選択
$db = $mongo->selectDB("twi_analysis");

//全ての変数は配列が引数

function tweets_search($where = null,$select = null,$sort = null){//ツイートデータ取得
	//グローバル変数宣言
	global $mongo, $db;
	// コレクションの選択
	$collection = $db->selectCollection("tweetdata");

	//データ取得
	if(empty($where) and empty($select) and empty($sort)){//select,where,orderbyが指定
		$acquisition = $collection->find($where,$select)->sort($sort);
	}
	elseif(empty($where) and empty($select)){//昇順・降順のみ指定
		$acquisition = $collection->find()->sort($sort);
	}
	elseif(empty($where) and empty($sort)){//selectのみ指定
		$acquisition = $collection->find(array(),$select);
	}
	elseif(empty($select) and empty($sort)){//whereのみ指定
		$acquisition = $collection->find($where);
	}
	elseif(empty($where)){//select,orderbyが指定
		$acquisition = $collection->find(array(),$select)->sort($sort);
	}
	elseif(empty($select)){//where,orderbyが指定
		$acquisition = $collection->find($where)->sort($sort);
	}
	elseif(empty($sort)){//select,whereが指定
		$acquisition = $collection->find($where,$select);
	}
	else{//条件なしで全件取得
		$acquisition = $collection->find();
	}
	//返り値
	return $acquisition;
}

function tweets_count($where = null){//ツイート件数取得
	//グローバル変数宣言
	global $mongo, $db;
	// コレクションの選択
	$collection = $db->selectCollection("tweetdata");

	if(empty($where)){//データ取得
		$acquisition = $collection->find()->count();
	}else{
		$acquisition = $collection->find($where)->count();
	}
	//返り値
	return $acquisition;
}

function user_search($where = null,$select = null){//ユーザー情報取得
	//グローバル変数宣言
	global $mongo, $db;
	// コレクションの選択
	$collection = $db->selectCollection("user_data");

	//データ取得
	if(empty($where) and empty($select)){//select,whereが指定
		$acquisition = $collection->find($where,$select);
	}
	elseif(empty($where)){//selectのみ指定
		$acquisition = $collection->find(array(),$select);
	}
	elseif(empty($select)){//whereのみ指定
		$acquisition = $collection->find($where);
	}
	else{//条件なしで全件取得
		$acquisition = $collection->find();
	}

	//返り値
	return $acquisition;
}

function user_count($where = null){//ユーザ件数取得
	//グローバル変数宣言
	global $mongo, $db;
	// コレクションの選択
	$collection = $db->selectCollection("user_data");

	if(empty($where)){//データ取得
		$acquisition = $collection->find()->count();
	}else{
		$acquisition = $collection->find($where)->count();
	}
	//返り値
	return $acquisition;
}

function tweets_one_insert($insert){//ツイートDBに1件挿入
	//グローバル変数宣言
	global $mongo, $db;
	// コレクションの選択
	$collection = $db->selectCollection("tweetdata");

	//データ挿入
	$collection->insert($insert);
}
?>