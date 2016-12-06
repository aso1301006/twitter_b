<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="history_year.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/back_button.css" />
<title>タイトル</title>
<script type="text/javascript">
    function frameClick() {
      document.location.href = "history_top.php";
    }
  </script>
</head>
<body>
<?php
$name = $_POST['1'];
?>
<div class="main">
<?php
include '../header.php';
//include ('month_acquisition.php');
?>

<span style="font-size:2em"><br/></span>
<div class="general-button" onclick="frameClick();" style="float:left; margin:10px;">
	<div class="button-content">
		<span class="button-text">戻る</span>
	</div>
</div>

<span style="font-size:4em"><br/></span>
<div class="center">
<h1>履歴</h1>
</div>

<div class="center">
<h1><?php echo $name;?></h1>
</div>

<?php
$name = str_replace(array(" ", "　"), "", $name);
$year = substr($name,0,4);
$month = substr($name,4,2);
$test=$year.$month;
?>
<p><?php echo$test;?></p>
<!--  -->
<div class="center">
	<img src="h_month_line_graph.php?year=<?=$year?>&month=<?=$month?>" alt="1カ月" class="gallery-cell"/>

</div>
<!--  -->

</div>
</body>
</html>