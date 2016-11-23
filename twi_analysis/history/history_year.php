<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="history_year.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/back_button.css" />
<title>タイトル</title>
</head>

<body>
<?php
$name = $_POST['2016'];
include ('../header.php');
?>
<div class="main">

<span style="font-size:2em"><br/></span>
<div class="left">
<form action="history_top.php" method="post">
<input type="submit"value="戻る">
</form>
</div>
<span style="font-size:1em"><br/></span>
<a href="history_top.php">戻る</a>
<div class="rireki">
<h1>履歴</h1>
</div>

<div class="center">
<h1><?php echo $name;?></h1>
</div>
</div>


</body>
</html>