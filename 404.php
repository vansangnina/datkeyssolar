<?php
	session_start();
	$session=session_id();

	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	
	include_once _lib."Mobile_Detect.php";
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	
	$lang_default = array("","en");
	if(!isset($_SESSION['lang']) or !in_array($_SESSION['lang'], $lang_default))
	{
		$_SESSION['lang'] = $company['lang_default'];
	}
	$lang=$_SESSION['lang'];

	require_once _source."lang$lang.php";	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";	
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
?>
<!doctype html>
<html lang="vi">
<head>
	<base href="http://<?=$config_url?>/"  />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <meta http-equiv="REFRESH" content="10; url=http://<?=$config_url?>">   
    <title><?=_loi404?></title>  
</head>

<body style="background:#fff; padding:0; margin:0;">
	<div id="e404">
    	<div>
            <div class="kott"><?=_duonglinkkhongtontai?></div>
            <div class="loi404"><?=_loi404?></div>
        </div>
    </div>
    <style>
		div#e404{position:absolute;top: 50%;left: 50%;margin-right: -50%;transform: translate(-50%, -50%); font-size:30px; color:#b9b9b9; background:url(images/404.png) center bottom no-repeat; padding-bottom:190px; text-align:center;}
		div.kott a{ color:#EE0000; }
		div.loi404{font-size:100px; padding:15px 0;}
		@media screen and (max-width: 460px) {
			div#e404{ font-size:18px;}
			div.loi404{font-size:60px; padding:15px 0;}
		}
	</style>
</body>
</html>