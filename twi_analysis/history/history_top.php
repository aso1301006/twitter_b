
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="layout.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/back_button.css" />
<title>タイトル</title>
<script type="text/javascript">

    function frameClick() {
      document.location.href = "../your_page/your_page.php";
    }

    		include ('search_month.php');
    		if(isset($array_year)){
    			$countyear=count($array_year);
    			$year=$array_year[0];
    		}

    		if(isset($array_yearmonth)){
    			$countyearmonth=count($array_yearmonth);
    		}
    		// echo $countyear;
    		// echo $countyearmonth;

    		if(isset($_POST["rireki"])){
    			$year=$_POST["rireki"];
    		}


    function button(){
            /* アラート表示 */
            alert("データがありません");
    }
  </script>
</head>

<body>


<?php
include ('../header.php');
?><div class="main">
<?php
include ('search_month.php');
include ('../body.html');


if(isset($array_year)){
	$countyear=count($array_year);
	$year=$array_year[0];
}

if(isset($array_yearmonth)){
	$countyearmonth=count($array_yearmonth);
}
// echo $countyear;
// echo $countyearmonth;

if(isset($_POST["rireki"])){
$year=$_POST["rireki"];
}
?>

<div class="site">
<div class="center">
<form action="history_year.php" method="post">
<input type="submit"  value="<?php if(isset($year)){echo $year;}else{echo "2016年";}?>" name="year" style="width:30%; height:34%; font-size:45%; margin-top:1%;">
</form>
</div>

<div class="general-button" onclick="frameClick();" style="float:left; margin:8px;">
	<div class="button-content">
		<span class="button-text">戻る</span>
	</div>
</div>
<span style="font-size:0.5em"><br/></span>

<div class="pt20">
  <div class="row">
	<div class="col-xs-12 col-sm-4 col-sm-offset-4">
      <form action="history_top.php" method="post" class="form-group">

          <div class="select-wrap select-circle ">
			<select name="rireki" class="rireki" onChange="this.form.submit()">
				<option value="0" selected>履歴</option>
			<?php for($i=0;$countyear>$i;$i++){
				?><option value="<?php if(isset($array_year[$i])){echo $array_year[$i];} ?>年"><?php if(isset($array_year[$i])){echo $array_year[$i];}?></option>
				<?php
			}
			?>
			</select>
     	  </div>
      </form>
	</div>
  </div>
</div>

<?php $year=substr($year, 0, 4); $a=$year."01";$b=$year."02";$c=$year."03";$d=$year."04";$e=$year."05";$f=$year."06";$g=$year."07";$h=$year."08";$ii=$year."09";$j=$year."10";$k=$year."11";$l=$year."12";$m="0";?>
					<!--左半分  -->
<div class="left" style="margin-top:-5%;">
<?php for($i=0;$countyearmonth>$i;$i++){if($a ==  $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　01月" name="1">
</p>
<input type="image" src="../img/1.png" name="1" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h1.png" name="" style="width:34%;">
	</div>
<?php }}}?>


<?php for($i=0;$countyearmonth>$i;$i++){if($b == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　02月" name="1">
</p>
<input type="image" src="../img/2.png" name="2" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h2.png" name="" style="width:34%;">
	</div>
<?php }}}?>


<?php for($i=0;$countyearmonth>$i;$i++){if($c == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　03月" name="1">
</p>
<input type="image" src="../img/3.png" name="3" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h3.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($d == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　04月" name="1">
</p>
<input type="image" src="../img/4.png" name="4" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h4.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($e == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　05月" name="1">
</p>
<input type="image" src="../img/5.png" name="5" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h5.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($f == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　06月" name="1">
</p>
<input type="image" src="../img/6.png" name="6" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h6.png" name="" style="width:34%;">
	</div>
<?php }}}?>

<span style="font-size:1em"><br/></span>
</div>
					<!--左半分  -->
					<!--右半分  -->
<div class="right" style="margin-top:-5%;">
<?php for($i=0;$countyearmonth>$i;$i++){if($g == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　07月" name="1">
</p>
<input type="image" src="../img/7.png" name="7" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h7.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($h == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　08月" name="1">
</p>
<input type="image" src="../img/8.png" name="8" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h8.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($ii == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　09月" name="1">
</p>
<input type="image" src="../img/9.png" name="9" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h9.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($j == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　10月" name="1">
</p>
<input type="image" src="../img/10.png" name="10" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h10.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($k == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　11月" name="1">
</p>
<input type="image" src="../img/11.png" name="11" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h11.png" name="" style="width:34%;">
	</div>
<?php }}}?>



<?php for($i=0;$countyearmonth>$i;$i++){if($l == $array_yearmonth[$i]){ ?>
<div class="button_right">
<form action="history_month.php" method="post">
<p>
<input type="hidden" value="<?php if(isset($year)){echo $year;}?>　12月" name="1">
</p>
<input type="image" src="../img/12.png" name="12" style="width:34%;">
</form>
</div>
<?php break;}else{ if($countyearmonth-1==$i){ ?>
<span style="line-height:100%"><br/></span>
	<div class="button_right" onclick="button();">
	<input type="image" src="../img/h12.png" name="" style="width:34%;">
	</div>
<?php }}}?>



</div><!--右半分  -->
</div>
</div>



</body>
</html>