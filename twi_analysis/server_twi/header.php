<?php
// session_start();



//ログインしていないorセッションが切れた場合------------
if(!isset($_SESSION['access_token'])){
	header('Location: login/Welcome.html');
	}
	else{
		$t_id=$_SESSION['screen_name'];
		$t_name=$_SESSION['name'];
		$t_icon=$_SESSION['profile_image_url_https'];
	}
?>

<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<link rel="stylesheet" type="text/css" href="http://localhost/twi_analysis/css/css.css"></link>
</head>
<body>
	<div class="header">
		<div id="home_button">
			<a href="http://localhost/twi_analysis/main/main.php"><img src="http://localhost/twi_analysis/img/home_icon.png." alt="home" width="45px" height="45px"></img></a>
		</div>

		<div id="system_name">
			<img src="http://localhost/twi_analysis/img/twi析.png" alt="システム名" width="100px" height="45px"></img>
		</div>

		<div id="user_info">
			<div class="icon">
				<ul id="fade-in" class="dropmenu">
					<li><a href="#"><img src="<?php echo $t_icon;?>" alt="user_icon" width="50px" height="50px"	style="border:solid 1px #AAA;"></img></a>
						<ul>
							<li><a href="http://localhost/twi_analysis/login/logout.php">ログアウト</a></li>
						</ul>
					</li>
				</ul>
			</div>

			<div class="info">
				<a>@<?php echo $t_id?></a><br></br><a><font size="5em"><?php echo $t_name;?></font></a>
			</div>
		</div>

		<div class="border" style="margin-top:5.5%;"></div>
</div>
<span style="Font-Size:4em"><br></br></span>