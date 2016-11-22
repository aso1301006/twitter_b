<?php
function Authentication($request_url, $params_a){
	// 設定
	// APIキー
	$api_key = 'vfQ2SASQcoLdl1cqdwmMOD2yJ' ;
	// APIシークレット
	$api_secret = 'zspEuzKLR1QgraXnqaZOXxBBgTSSa0dOwyWpUYHLWnvjND7eqa' ;
	// アクセストークン
	$access_token = $_SESSION['access_token']["oauth_token"] ;
	// アクセストークンシークレット
	$access_token_secret = $_SESSION['access_token']["oauth_token_secret"] ;
	// エンドポイント
	$request_url;
	//メソッド 読み取り「GET」 書き込み「POST」
	$request_method = 'GET' ;

	// 	パラメータA (オプション)
	$params_a;

	//署名を作成開始----------------------------------------------------------------------------------------------------
	// キーを作成する (URLエンコードする)
	$signature_key = rawurlencode( $api_secret ) . '&' . rawurlencode( $access_token_secret ) ;

	// パラメータB (署名の材料用)
	$params_b = array(
			'oauth_token' => $access_token ,
			'oauth_consumer_key' => $api_key ,
			'oauth_signature_method' => 'HMAC-SHA1' ,
			'oauth_timestamp' => time() ,
			'oauth_nonce' => microtime() ,
			'oauth_version' => '1.0' ,
	) ;

	// パラメータAとパラメータBを合成してパラメータCを作る
	$params_c = array_merge( $params_a , $params_b ) ;
	// 連想配列をアルファベット順に並び替える
	ksort( $params_c ) ;
	// パラメータの連想配列を[キー=値&キー=値...]の文字列に変換する
	$request_params = http_build_query( $params_c , '' , '&' ) ;
	// 一部の文字列をフォロー
	$request_params = str_replace( array( '+' , '%7E' ) , array( '%20' , '~' ) , $request_params ) ;
	// 変換した文字列をURLエンコードする
	$request_params = rawurlencode( $request_params ) ;
	// リクエストメソッドをURLエンコードする
	// ここでは、URL末尾の[?]以下は付けないこと
	$encoded_request_method = rawurlencode( $request_method ) ;
	// リクエストURLをURLエンコードする
	$encoded_request_url = rawurlencode( $request_url ) ;
	// リクエストメソッド、リクエストURL、パラメータを[&]で繋ぐ
	$signature_data = $encoded_request_method . '&' . $encoded_request_url . '&' . $request_params ;
	// キー[$signature_key]とデータ[$signature_data]を利用して、HMAC-SHA1方式のハッシュ値に変換する
	$hash = hash_hmac( 'sha1' , $signature_data , $signature_key , TRUE ) ;
	// base64エンコードして、署名[$signature]が完成する
	$signature = base64_encode( $hash ) ;
	//署名を作成終了---------------------------------------------------------------------------------------------
	// パラメータの連想配列、[$params]に、作成した署名を加える
	$params_c['oauth_signature'] = $signature ;
	// パラメータの連想配列を[キー=値,キー=値,...]の文字列に変換する
	$header_params = http_build_query( $params_c , '' , ',' ) ;
	// リクエスト用のコンテキスト
	$context = array(
			'http' => array(
					'method' => $request_method , // リクエストメソッド
					'header' => array(			  // ヘッダー
							'Authorization: OAuth ' . $header_params ,
					) ,
			) ,
	) ;

	// パラメータがある場合、URLの末尾に追加
	if( $params_a )
	{
		$request_url .= '?' . http_build_query( $params_a ) ;
	}

	//cURLセッションを初期化
	$curl = curl_init() ;

	//転送時のオプションを設定
	//取得するURL
	curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
	//TRUE を設定すると、ヘッダの内容も出力
	// 		curl_setopt( $curl , CURLOPT_HEADER, 1 ) ;
	//HTTP リクエストで "GET" あるいは "HEAD" 以外に 使用するカスタムメソッド。
	curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;
	// 	FALSE を設定すると、cURL はサーバー証明書の検証を行わない。
	curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;
	//TRUE を設定すると、curl_exec() の返り値を 文字列で返します。
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;
	//設定する HTTP ヘッダフィールドの配列。
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;

	// タイムアウトの秒数
	curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;
	//転送を実行
	$res1 = curl_exec( $curl ) ;
	//セッションを終了
	curl_close( $curl ) ;

	// JSONをオブジェクトに変換
	$obj = json_decode( $res1, true ) ;

	return $obj;
}//end function Authentication
?>