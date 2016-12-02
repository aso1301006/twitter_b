<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<!--jquery.min.js読み込みは必須-->
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
<script type="text/javascript">
	$(function(){
		$("#load").load("./tweets.php");
	});
</script>
</head>
<body>
<div id="load" align="center">
	<img src="../img/ajax-loader.gif"alt="Now Loading..." />	<!--ローディング画像-->
	<h2>最新ツイート情報を取得しています・・・・</h2>
</div>
</body>
</html>