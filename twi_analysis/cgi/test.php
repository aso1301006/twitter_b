<?php
	$html_content = "";
	if(isset($_GET['filename'])){
		$path = $_GET['filename'];

//---------------------- ここから必要 ------------------------
		include('PythonCaller.php');
		// $path = "analysis_mecab.py";  // 呼び出したいPythonへのパスを記述
		$caller = new PythonCaller($path);
		try{
			$isExec = $caller->call();
			if(isExec){
				$html_content = ($caller->getParsedPara());
			}
		}
		catch(FileNotFoundException $e){
			$html_content = $e->getMessage();
		}
		catch(ExecuteException $e){
			$html_content = $e->getMessage();
		}
		catch(Exception $e){
			$html_content = $e->getMessage();
		}
//----------------------- ここまで必要 ------------------------
	}
?>

<form action="" method="GET">
	<div style="margin-bottom: 10px"><?php include('file_list.php') ?></div>
	<div><input type="text" name="filename" /></div>
	<div><input type="submit" value="実行" /></div>
	<hr />
	<div><?=$html_content?></div>
</form>
