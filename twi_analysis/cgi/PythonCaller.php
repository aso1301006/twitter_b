<?php

class PythonCaller{
	private $args;
	private $parsedPara;
	private $filePath = "";
	private $isTime = true;  // 実行時間を表示するか

	public function __construct($path, $args = array()){
		$this->setPath($path);
		$this->setArgs($args);
		$this->parsedPara = array();
	}

	public function setPath($path){
		$path = dirname(__FILE__). "/". $path;
		if(file_exists($path)){
			$this->filePath = $path;	
		}
		else{
			throw new FileNotFoundException("指定されたファイルが存在しません：". $path);
		}
	}

	public function getPath(){
		return $this->filePath;
	}

	public function setArgs($args){
		if(is_array($args)){
			$this->args = $args;
		}
		else{
			$this->args = array();
		}
	}

	public function getParsedPara(){
		return $this->parsedPara;
	}

	public function parseOutPara($outpara){
		// 0番目から1つ取り出し代入、引数の配列は取り出した分詰める
		$controlString = array_splice($outpara, 0, 1);
		$returnArray = array();
		switch ($controlString[0]) {
			case 'Success':
				foreach ($outpara as $value) {
					if($value == 'Finish'){
						// 時刻表示をする設定にしていれば繰り返しを続ける
						if($this->isTime){
							continue;
						}
						else{
							break;
						}
					}
					$returnArray = $value;
				}
				break;
			case 'Exception':
				$errorCode = 'E20';
			case 'RuntimeError':
				$errorCode = isset($errorCode) ? $errorCode : 'RE30';
			case 'Error':
				$errorCode = isset($errorCode) ? $errorCode : 'E10';
				throw new ExecuteException(
					sprintf("内部プログラム実行中にエラーが発生しました：ErrorCode(%s)". $errorCode)
					);
				break;
			default:
				throw new Exception("予期せぬエラーが発生しました");
				break;
		}

		return $returnArray;
	}

	public function call(){
		// パスが指定されていなければ実行を終了する
		if($this->filePath == ""){
			return false;
		}
	    $fullPath = 'python '. $this->filePath;
	    if($this->args != array()){
	    	$p = implode("' '", $this->args);
	    	$fullPath .= " '". $p. "'";
	    }
	    $fullPath .= ' 2>&1';  // エラー出力を標準出力にすることで $outPara に代入できる

	    exec($fullPath, $outPara, $returnPara);

	    if($returnPara == 0){
	    	$this->parsedPara = $this->parseOutPara($outPara);
	    }
	    else{
	    	throw new ExecuteException(
	    		sprintf("エラーが発生しました：ErrorCode(%d)", $returnPara)
	    		);
	    }
	    return true;
	}
}
class FileNotFoundException extends Exception{
}
class ExecuteException extends Exception{
}
?>
