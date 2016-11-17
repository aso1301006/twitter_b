
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="layout.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/back_button.css" />
<title>タイトル</title>
</head>

<body>

<div class="main">
<?php
include ('../header.php');

if(isset($_POST["rireki"])){
$year=$_POST["rireki"];
}
//echo $year;
?>
<div class="site">
<div class="center">
<span style="font-size:3em"><br/></span>
<form action="history_year.php" method="post">
<input type="submit" value="<?php if(isset($year)){echo $year;}else{echo "2016年";}?>" name="2016" style="width:15%; height:40px;">
</form>
</div>

<div>
<form action="###" method="post">
<input  class="modoru" type="button" value="戻る">
</form>
</div>
<span style="font-size:1em"><br/></span>
<div class="select-box02 entypo-down-open-mini">
<form action="history_top.php" method="post">
<select name="rireki" onChange="this.form.submit()">
<option value="0" selected>　履歴</option>
<option value="2016年">　2016</option>
<option value="2015年">　2015</option>
<option value="2014年">　2014</option>
</select>
</form>
</div>
<div class="left"><!--左半分  -->
<div class="button_left">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　1月" name="1" style="margin-left:80px">
</p>
<input  type="image" src="../img/1.png" name="1">
</form>
</div>



<span style="font-size:2em"><br/></span>
<div class="button_left">

<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　2月" name="1">
</p>
<input type="image" src="../img/2.png" name="2" >
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_left">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　3月" name="1">
</p>
<input type="image" src="../img/3.png" name="3">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_left">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　4月" name="1">
</p>
<input type="image" src="../img/4.png" name="4">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_left">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　5月" name="1">
</p>
<input type="image" src="../img/5.png" name="5">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_left">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　6月" name="1">
</p>
<input type="image" src="../img/6.png" name="6">
</form>
</div>
<span style="font-size:1em"><br/></span>
</div><!--左半分  -->


<div class="right"><!--右半分  -->
<div></div>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　7月" name="1">
</p>
<input  type="image" src="../img/7.png" name="7">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　8月" name="1">
</p>
<input type="image" src="../img/8.png" name="8">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　9月" name="1">
</p>
<input type="image" src="../img/9.png" name="9">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　10月" name="1">
</p>
<input type="image" src="../img/10.png" name="10">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　11月" name="1">
</p>
<input type="image" src="../img/11.png" name="11">
</form>
</div>
<span style="font-size:2em"><br/></span>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="2016年　12月" name="1">
</p>
<input type="image" src="../img/12.png" name="12">
</form>
</div>
</div><!--右半分  -->
</div>
</div>


</body>
</html>