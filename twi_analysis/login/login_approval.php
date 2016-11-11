<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="login.css"></link>
<title>login_approval</title>

<!--
function error(){       //ID又はパスワードの不一致アラート
	window.confirm('IDまたはパスワードが間違っています。再度入力してください。')
}
 -->


</head>
<body>
<div class="main">
<?php
$id=$_POST['id'];
$pw=$_POST['pw'];

//include 'DB.php';

/*
$sql = "SELECT * FROM user WHERE id = ?";
$data = $pdo->prepare($sql);
$data->execute(array($id));//要らないかも？


//----繰り返しでSERECTでとってきた値を表示----------
while($row = $data ->fetch(PDO::FETCH_ASSOC)){
	$D_id = $row['user_id'];
	$D_pw=$row['user_pw'];
}
*/

//メールアドレスとパスワードで認証
if($id == $D_id){
	if($pw == $D_pw){
		$_SESSION['user_id']=$D_id;
		header('location: index.php');
	}else{error();
	}
}else {error();}
?>
</div>
</body>
</html>