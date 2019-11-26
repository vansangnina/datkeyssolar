<?php  if(!defined('_source')) die("Error");
	$act=$_GET['act'];
	if(isset($_GET['act'])){
	switch ($act){
		case 'upload':
			doUpload();
			break;
		case 'save':
			saveComment();
			break;
		case 'like':
			likeComment();
			break;
		case 'load':
			loadCmt();
			break;
		case 'delete':
			deleteCmt();
			break;	
		
	}
	die;
	}
	function getCommentId($id){
		
		global $d;
		$d->query("select id from #_comment where parent_id =".$id);
		foreach($d->result_array() as $k=>$v){
			getCommentId($v['id']);
			deleteChildCmt($v['id']);
		}
		deleteChildCmt($id);
	}
	function deleteChildCmt($id){
		global $d;
		$d->query("delete from #_comment where id = ".$id);
		echo $d->sql;
	}
	function deleteCmt(){
		$id = $_POST['id'];
		getCommentId($id);
	}
	function loadCmt(){
		global $d;
		$id= $_POST['id'];
		$d->query("select content from #_comment where id = $id");
		$r = $d->fetch_array();
		echo $r['content'];
	}
	function doUpload(){
		$id_post = $_POST['id'];
		$photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG','upload/photo/',$id_post."-".rand(0,9999));
		echo 'upload/photo/'.$photo;
		
	}
	function saveComment(){
		global $d;
		$data['product_id'] = $_POST['id'];
		$data['parent_id'] = $_POST['parent_id'];
		$data['content'] = magic_quote($_POST['textEditor']);
		$data['name'] = $_POST['sendwithname'];
		$data['email'] = $_POST['sendwithemail'];
		$data['url'] = $_POST['xurl'];

		$_SESSION['user_comment']['name'] = $data['name'];
		$_SESSION['user_comment']['email'] = $data['email'];
		
		
		$data['create_time'] = time();
		
		$d->setTable("comment");
		$d->insert($data);
		$data['first_char'] = mb_substr(trim($data['name']),0,1,'UTF-8');
		$data['time'] = "Vài giây trước";
		$data['id'] = mysql_insert_id();
		echo json_encode($data);
		die;
	}
	
	function likeComment(){
		global $d;
		$id = $_POST['id'];
		$d->query("select like,unlike from #_comment where id =".$id);
		$r = $d->fetch_array();
		$like = json_decode($r['like']);	
		$ip = $_SERVER['REMOTE_ADDR'];
		$hl = $d->fetch_array();
		
		if(in_array($ip,$like))
		//check($_COOKIE);
		die;
	}
	

?>