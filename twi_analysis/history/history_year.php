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
$name = $_POST["year"];
?>

<?php
include '../header.php';
?><div class="main">
<?php
include '../body.html';
?>

<span style="font-size:2em"><br/></span>
<div class="general-button" onclick="frameClick();" style="float:left; margin:10px;">
	<div class="button-content">
		<span class="button-text">戻る</span>
	</div>
</div>
<br/>
<span style="font-size:3em"><br/></span>
<div class="center">
<h1>履歴</h1>
</div>

<div class="center">
<h1><?php echo $name;?></h1>
</div>

<!-- グラフ↓ -->
<?php
$year = substr($name,0,4);
?>

<!--  -->
<div class="center">
	<img src="h_year_line_graph.php?year=<?=$year?>" alt="1年" class="gallery-cell"/>
</div>
<!--  -->

</div>
</body>
</html>