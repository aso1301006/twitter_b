<?php
// $html_content = "";
// if(isset($_GET['filename'])){
// 		$path = $_GET['filename'];

// //---------------------- ここから必要 ------------------------
// 		include('PythonCaller.php');
// 		// $path = "analysis_mecab.py";  // 呼び出したいPythonへのパスを記述
// 		$caller = new PythonCaller($path);
// 		try{
// 			$isExec = $caller->call();
// 			if(isExec){
// 				$html_content = ($caller->getParsedPara());
// 			}
// 		}
// 		catch(FileNotFoundException $e){
// 			$html_content = $e->getMessage();
// 		}
// 		catch(ExecuteException $e){
// 			$html_content = $e->getMessage();
// 		}
// 		catch(Exception $e){
// 			$html_content = $e->getMessage();
// 		}
// //----------------------- ここまで必要 ------------------------
		require_once('CounterCaller.php');
		try{
			$caller = new CounterCaller();
			$user_id = "791505177299726336";
			$from_date_str = "2016/11/1 0:0:0";  // 年-月-日 時:分:秒で指定する
			$to_date_str = "2016/12/1 0:0:0";    // 開始日時 ≦ Ｘ < 終了日時 で検索される
			$caller->setArgs($user_id, $from_date_str, $to_date_str);

			$count_arr = $caller->call(PIE_CHAR);  // どのグラフの処理をするか定数で指定
			if($count_arr == null){  // 失敗した時や見つからない時はnullが帰ってくる
				print "見つかりませんでした";
			}
			else{
				var_dump($count_arr);
			}

			$count_arr = $caller->call(BAR_GRAPH);  // どのグラフの処理をするか定数で指定
			if($count_arr == null){  // 失敗した時や見つからない時はnullが帰ってくる
				print "見つかりませんでした";
			}
			else{
				var_dump($count_arr);
			}
		}
		catch(InvalidArgumentException $e){
			print "InvalidArgumentException：". $e->getMessage();
		}
		catch(FileNotFoundException $e){
			print "FileNotFoundException：". $e->getMessage();
		}
		catch(ExecuteException $e){
			print "ExecuteException：". $e->getMessage();
		}
		catch(Exception $e){
			print "Exception：". $e->getMessage();
		}
// }
?>
<!-- 
<form action="" method="GET">
	<div style="margin-bottom: 10px"><?php //include('file_list.php') ?></div>
	<div><input type="text" name="filename" /></div>
	<div><input type="submit" value="実行" /></div>
	<hr />
	<div><?=$html_content?></div>
</form>
 -->