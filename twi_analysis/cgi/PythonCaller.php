<?php
	class PythonCaller{
		private $outPara;
		private $filePath;

		public function __construct($path){
			$this->outPara = array();
			$this->setPath($path);
		}

		public function setPath($path){
			$this->filepath = $path;	
		}

		public function call(){
		    $fullPath = 'python '. $this->filepath;
			if($this->outPara != array()){
				$this->outPara = array();  // 配列に追加される形になるので毎回初期化する
			}

		    exec($fullPath, $this->outPara, $returnPara);
		    if($this->returnPara === 0){
			    echo '<PRE>';
			    var_dump($this->fullPath);
			    var_dump($this->outPara);
			    echo '<PRE>';
		    }
		    else{
		    	echo 'エラーが発生しました：' + $this->outPara;
		    }
		}
	}
	$path = "./analysis_mecab.py";
	$test = new PythonCaller($path);
	$test->call();
?>