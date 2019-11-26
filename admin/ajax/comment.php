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
	
	insert_comment();
	
	function insert_comment(){
			global $d;
			$data['product_id'] = intval($_POST['product_id']);
			$data['parent_id'] = intval($_POST['parent_id']);
			$data['lang'] = $lang;
			$data['ten'.$lang] = magic_quote(trim(strip_tags($_POST['ten'])));
			$data['email'] = magic_quote(trim(strip_tags($_POST['email'])));
			$data['mota'] = magic_quote(trim(strip_tags($_POST['mota'])));
			$data['type'] = magic_quote(trim(strip_tags($_POST['type'])));
			$data['hienthi'] = 1;
			$data['ngaytao'] = time();
			
			$d->setTable('comment');
			if($d->insert($data)){
				$return['thongbao'] = 'Bình luận thành công';
				$return['nhaplai'] = 'nhaplai';
			}
			else
			{
				$return['thongbao'] = 'Hệ thống lỗi,vui lòng liên hệ nhà cung cấp website';
				$return['nhaplai'] = '0';
			}
			
		echo json_encode($return);
	}

?>
