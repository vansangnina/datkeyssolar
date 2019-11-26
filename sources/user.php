<?php  if(!defined('_source')) die("Error");	

	$title_cat = "Thêm username";	
	$title = "Thêm username";	
	
	if(!empty($_POST)){
		if(strtoupper($_POST['capcha']) != $_SESSION['key'])
		{
			transfer(_mabaovesai, "them-user.html");
		}
		else
		{
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$sql = "INSERT INTO  table_user (username,password,role,com,active) VALUES ('$username','$password',3,'admin',1)";	
			if(mysql_query($sql)==true)
			{
				transfer(_dangkythanhcong, "http://".$config_url);
			}
			else
			{
				transfer(_hethongloi, "them-user.html");
			}
		}
	}		
?>