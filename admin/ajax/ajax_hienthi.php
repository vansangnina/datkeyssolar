<?php 
	session_start();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../lib/');
		
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	
	$login_name_admin = 'NINACO';
	if(!isset($_SESSION[$login_name_admin]) || $_SESSION[$login_name_admin]==false){
		die();
	}

	if(isset($_POST["id"])){
		echo $sql = "update ".$_POST["bang"]." SET ".$_POST["type"]."=".$_POST["value"]." WHERE  id = ".$_POST["id"]."";
		
		$data = mysql_query($sql) or die("Not query sql");
	}
?>