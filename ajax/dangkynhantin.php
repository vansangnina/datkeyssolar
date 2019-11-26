<?php 

	include ("ajax_config.php");
	if(isset($_POST['email_nhantin']))
	{		
		$email_nhantin = $_POST['email_nhantin'];		
		$d->reset();
		$sql_kt_mail="SELECT email FROM table_newsletter WHERE email='".$email_nhantin."'and type='nhantin'";
		$d->query($sql_kt_mail);
		$kt_mail=$d->result_array();
		if(count($kt_mail)>0)
			echo 1;
		else
		{
			$email_nhantin = trim(strip_tags($email_nhantin));
			$email_nhantin = mysql_real_escape_string($email_nhantin);	
			$data['email']=$email_nhantin;
			$data['type']='nhantin';
			$d->setTable('newsletter');
			if($d->insert($data)== true)
				echo 0;
			else
				echo 2;
		}		
	}
	
?>
