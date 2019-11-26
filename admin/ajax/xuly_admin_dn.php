<?php
session_start();
@define('_source', '../sources/');
@define('_lib', '../lib/');
error_reporting(0);
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";
$d = new database($config['database']);
$act = $_REQUEST['act'];
switch ($act) {
    case 'remove_image':
		remove_images();
		break;
	case 'remove_image1':
		remove_images1();
		break;
}
?>
<?php
function remove_images(){
		global $d,$act,$item;	
		$id=$_POST['id'];
		$d->reset();
		$sql_kt="select * from #_hinhanh where id='".$id."'";
		$d->query($sql_kt);
		if($d->num_rows()>0){
			$rs=$d->fetch_array();
			delete_file(_upload_product . $rs['photo']);
			
			$sql="delete from #_hinhanh where id='".$id."' ";
			if($d->query($sql)){
				echo json_encode(array("md5"=>md5($id)));
			}
		}
		
		
		die;
		
	}
function remove_images1(){
	global $d,$act,$item;	
	$id=$_POST['id'];
	$d->reset();
	$sql_kt="select * from #_hinhanh where id='".$id."'";
	$d->query($sql_kt);
	if($d->num_rows()>0){
		$rs=$d->fetch_array();
		delete_file(_upload_hinhanh . $rs['photo']);
		
		$sql="delete from #_hinhanh_hinhanh where id='".$id."' ";
		if($d->query($sql)){
			echo json_encode(array("md5"=>md5($id)));
		}
	}
	
	
	die;
	
}