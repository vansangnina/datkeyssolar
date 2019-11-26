<?php
	include ("ajax_config.php");

	if($_SESSION['chat_facebook']==fasle or $_SESSION['chat_facebook']==NULL or $_SESSION['chat_facebook']==0)
	{
		$_SESSION['chat_facebook']=1;		
	}
	else
	{
		$_SESSION['chat_facebook']=0;
	}
?>