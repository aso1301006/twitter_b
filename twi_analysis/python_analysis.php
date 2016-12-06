<?php
include('cgi/PythonCaller.php');

function morpheme_emotion(){//形態素解析・感情値算出
	$path = "analysis_mecab.py";  // 呼び出したいPythonへのパスを記述
	$caller = new PythonCaller($path);

	try{//形態素解析・感情値算出
		$i = $caller->call();//形態素解析
		$path = "analysis_emotion.py";
		$caller->setPath($path);//パスの切り替え
		$caller->call();//感情値算出
	}catch(Exception $e){
		//return true;
		return $e;
	}

	return false;
}
?>