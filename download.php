<?php
	session_start();
	$session=session_id();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	@define ( _upload_folder , './media/upload/' );

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";	
	include_once _lib."file_requick.php";			
		
//các file upload được để trong 1 thư mục riêng
$upload_dir = "upload/news/";
 
//lấy tên file cần download từ URL
$id=$_GET['id'];
settype($id,'int');

$sql="SELECT photo FROM table_congtrinh where id=$id";

$rs_file = mysql_query($sql) or die(mysql_error());	
$row_file = mysql_fetch_array($rs_file);


$filename = $row_file['photo'];
 
//thực hiện quá trình kiểm tra
if(!preg_match('/^[a-z0-9\_\-][a-z0-9\_\-\. ]*$/i',$filename)  || !is_file($upload_dir.$filename) || !is_readable($upload_dir.$filename) ) {
    echo "Error: File not found!";
    exit(-1);
} //end if
 
 
 
//mở file để đọc với chế độ nhị phân (binary)
$fp = fopen($upload_dir.$filename, "rb");
 
//gởi header đến cho browser
header('Content-type: application/octet-stream');
header('Content-disposition: attachment; filename="'.$filename.'"');
header('Content-length: ' . filesize($upload_dir.$filename));


//đọc file và trả dữ liệu về cho browser
fpassthru($fp);
fclose($fp); 
ob_flush ();
?>