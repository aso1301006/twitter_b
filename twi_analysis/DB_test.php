<?php
//PDOでDB接続
try {
 $pdo = new PDO('mysql:host=127.0.0.1;dbname=marina_twitter', 'root', 'root',array(PDO::ATTR_EMULATE_PREPARES => false));

// UTF8
 $pdo->exec("set names utf8");
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}



?>
