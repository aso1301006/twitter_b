<?php
	include('PythonCaller.php');

	$html_content = "";
	if(isset($_GET['filename'])){
		try{
			// $path = "./analysis_mecab.py";
			$path = $_GET['filename'];
			$caller = new PythonCaller($path);
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
	}
?>

<form action="" method="GET">
	<div style="margin-bottom: 10px"><?php include('file_list.php') ?></div>
	<div><input type="text" name="filename" /></div>
	<div><input type="submit" value="実行" /></div>
	<hr />
	<div><?=$html_content?></div>
</form>
