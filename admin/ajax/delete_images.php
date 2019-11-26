<?php
		session_start();
	@define ( '_lib' , '../../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";

	$d = new database($config['database']);
	
	$id=$_POST['id'];
	$table=$_POST['table'];
	$links=$_POST['links'];

	$d->reset();
	$sql = "select id,photo,thumb from #_$table where id='".$id."'";
	$d->query($sql);
	$row = $d->result_array();

	if(count($row)>0){
		for($i=0;$i<count($row);$i++){
			delete_file('../'.$links.$row[$i]['photo']);
			delete_file('../'.$links.$row[$i]['thumb']);
		}
		$sql = "delete from #_$table where id='".$id."'";
		$d->query($sql);
	}
	
?>
