<?php
	// file name: call_python.php
    $fullPath = 'python ./analysis_mecab.py';
    exec($fullPath, $outpara);
    echo '<PRE>';
    var_dump($fullPath);
    var_dump($outpara[0]);
    echo '<PRE>';
?>