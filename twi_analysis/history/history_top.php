<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="history_top.css"></link>
<link rel="stylesheet" type="text/css" href="http://localhost/twitter_anarysis/css/css.css"></link>
<title>history</title>

	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript">google.load("jquery", "1.7");</script>
	<script type="text/javascript">
$(function() {
	$("#menu li").hover(function() {
		$(this).children('ul').show();
	}, function() {
		$(this).children('ul').hide();
	});
});
</script>
</head>
<body>
<?php
	include '../header.php';
	include '../DB_test.php';
//表示する年について

	if(){

	}else{	$year=date('y');}


?>
<div class="main">
	<a id="page_title">履歴</a><br/>


<!-- --------左の固定タブ------------------ -->
	<div class="tabu">
		<input type="button" id="back" name="back" value="戻る" onclick="location.href='../your_page/your_page.php'"/>

		<ul id="fade-in2" class="dropmenu">
			<li><a>履歴</a>
				<ul>
					<li><a href="#">2016年</a></li>
					<li><a href="#">2015年</a></li>
					<li><a href="#">2016年</a></li>
					<li><a href="#">2014年</a></li>
				</ul>
			</li>
		<ul>
	</div>
<!-- --------------------------------------- -->


<!-- ------年表示----------------- -->
 <div class="general-button2016" style="text-align:center">
    <span class="button-text2016" ><?php echo "20".$year;?>年</span>
</div>
<!-- ----------------------------- -->

<!-- ---------月ボタン-------------- -->

<table class="table4" border="0">

 <tr><th><div class="general-button">
  <div class="button-content">
    <span class="button-text"><font color="black">1月の履歴</font></span>
  </div>
</div></th><th><div class="general-button2">
  <div class="button-content2">
    <span class="button-text2"><font color="black">2月の履歴</font></span>
  </div>
</div></th><th><div class="general-button3">
  <div class="button-content3">
    <span class="button-text3"><font color="black">3月の履歴</font></span>
  </div>
</div></th></tr>
 <tr><td><div class="general-button4">
  <div class="button-content4">
    <span class="button-text4"><font color="black">4月の履歴</font></span>
  </div>
</div></td><td><div class="general-button5">
  <div class="button-content5">
    <span class="button-text5" ><font color="black">5月の履歴</font></span>
  </div>
</div></td><td><div class="general-button6">
  <div class="button-content6">
    <span class="button-text6"><font color="black">6月の履歴</font></span>
  </div>
</div></td></tr>
 <tr><td><div class="general-button7">
  <div class="button-content7">
    <span class="button-text7"><font color="black">7月の履歴</font></span>
  </div>
</div></td><td><div class="general-button8">
  <div class="button-content8">
    <span class="button-text8"><font color="black">8月の履歴</font></span>
  </div>
</div></td><td><div class="general-button9">
  <div class="button-content9">
    <span class="button-text9"><font color="black">9月の履歴</font></span>
  </div>
</div></td></tr>
 <tr><td><div class="general-button10">
  <div class="button-content10">
    <span class="button-text10"><font color="black">10月の履歴</font></span>
  </div>
</div></td><td><div class="general-button11">
  <div class="button-content11">
    <span class="button-text11"><font color="black">11月の履歴</font></span>
  </div>
</div></td><td><div class="general-button12">
  <div class="button-content12">
    <span class="button-text12"><font color="black">12月の履歴</font></span>
  </div>
</div></td></tr>
</table>
</div>
</body>
</html>