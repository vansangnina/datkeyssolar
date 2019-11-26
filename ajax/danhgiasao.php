<?php 

	include ("ajax_config.php");
	
	$data['giatri'] = intval($_POST['giatri']);
	$data['link'] = $_POST['url'];
	$data['code'] = $session;
	$data['time'] = time();
	
	$d->reset();
	$sql = "select time from #_danhgiasao where link='".$data['link']."' and code='".$session."' order by time desc limit 0,1";		
	$d->query($sql);
	$kiemtra = $d->fetch_array();	
		
	if(time() < $kiemtra['time']+86400)
	{
		echo 2;exit;
	}
	
	$d->setTable('danhgiasao');
	
	if($d->insert($data)){
		echo 1;
	}else{
		echo 0;
	}
	
?>
