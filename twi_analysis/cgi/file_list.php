<?php

	if ($dir = opendir(".")) {
		echo "<p>ファイル一覧</p>";
		echo "<ul>";
	    while (($file = readdir($dir)) !== false) {
	        if ($file != "." && $file != "..") {
	            echo "<li><a href='$file'>$file</a></li>";
	        }
	    } 
	    closedir($dir);
	    echo "</ul>";
	}

?>