<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

switch($act){
	case "login":
		if(!empty($_POST)) login();
		$template = "user/login";
		break;
	case "admin_edit":
		edit();
		$template = "user/admin_add";
		break;
	case "logout":
		logout();
		break;	
	case "man":
		get_items();
		$template = "user/items";
		break;
	case "add":
		$template = "user/item_add";
		break;
	case "edit":
		get_item();
		$template = "user/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	default:
		$template = "index";
}

//////////////////
function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	/* if($_SESSION['login']['role']!='3'){
		transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	
	if($_REQUEST['key']!='')
	{
		$where.=" and (ten like '%".$_REQUEST['key']."%' or username like '%".$_REQUEST['key']."%')";
	}
	$where.=" and com!='admin' order by username";
	
	$sql="SELECT count(id) AS numrows FROM #_user where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_user where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=user&act=man".$urlcu;
}

function get_item(){
	global $d, $item;
	
	/* if($_SESSION['login_admin']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
	
	$sql = "select * from #_user where id='".$id."' and com!='admin'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=user&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	/* if($_SESSION['login_admin']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	} */
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){ // cap nhat
		$id =  themdau($_POST['id']);
		
		$data['username'] = $_POST['username'];
		if($_POST['oldpassword']!=""){
			$data['password'] = md5($_POST['oldpassword']);
		}
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['nick_yahoo'] = $_POST['nick_yahoo'];
		$data['nick_skype'] = $_POST['nick_skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['country'] = $_POST['country'];
		$data['city'] = $_POST['city'];
		$data['quyen'] = $_POST['quyen'];
		$data['nhom'] = (int)$_POST['group'];
		$data['role'] = (int)$_POST['role'];
		
		
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		//$d->setWhere('role', 1);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=user&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man");
	
	}else{ // them moi
	
		// kiem tra ten trung
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_POST['username']);
		$d->select();
		if($d->num_rows()>0) transfer("Tên dăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=edit&id=".$id);
		
		if($_POST['oldpassword']=="") transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add");
		
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['oldpassword']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['nick_yahoo'] = $_POST['nick_yahoo'];
		$data['nick_skype'] = $_POST['nick_skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['country'] = $_POST['country'];
		$data['city'] = $_POST['city'];
		$data['nhom'] = (int)$_POST['group'];
		$data['role'] = (int)$_POST['role'];
		
		$data['quyen'] = $_POST['quyen'];
		
		//$data['role'] = 1;
		$data['com'] = "user";
		
		$d->setTable('user');
		if($d->insert($data)){

			transfer("Dữ liệu đã được lưu", "index.php?com=user&act=man");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man");
	}
}

function delete_item(){
	global $d;
	if($_SESSION['login_admin']['role']!='3'){
			transfer("Chỉ có admin mới được vào mục này . ", "index.php");
	}
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		// kiem tra
		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role'] == 3) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man");
		}
		
		// xoa item
		$sql = "delete from #_user where id='".$id."'";
		if($d->query($sql))
			transfer("Dữ liệu đã được xóa", "index.php?com=user&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=user&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
}

///////////////////////

function edit(){
	global $d, $item, $login_name_admin,$salt_pw;
	
	if(!empty($_POST)){
		$sql = "select * from #_user where username!='".$_SESSION['login_admin']['username']."' and username='".$_POST['username']."' and role=3";
		$d->query($sql);
		if($d->num_rows() > 0) transfer("Tên đăng nhập này đã có","index.php?com=user&act=edit");
		
		$sql = "select * from #_user where username='".$_SESSION['login_admin']['username']."'";
		$d->query($sql);
		if($d->num_rows() == 1){
			$row = $d->fetch_array();
			if($row['password'] != md5($_POST['oldpassword'].$salt_pw)) transfer("Mật khẩu không chính xác","index.php?com=user&act=edit");
		}else{
			die('Hệ thống bị lỗi. Xin liên hệ với admin. <br>Cám ơn.');
		}
		
		$data['username'] = $_POST['username'];
		if($_POST['new_pass']!="")
			$data['password'] = md5($_POST['new_pass'].$salt_pw);
		$data['ten'] = $_POST['ten'];
		$data['email'] = $_POST['email'];
		$data['nick_yahoo'] = $_POST['nick_yahoo'];
		$data['nick_skype'] = $_POST['nick_skype'];
		$data['dienthoai'] = $_POST['dienthoai'];
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_SESSION['login_admin']['username']);
		if($d->update($data)){
			session_unset();
			transfer("Dữ liệu đã được lưu.","index.php");
		}
	}
	
	$sql = "select * from #_user where username='".$_SESSION['login_admin']['username']."'";
	$d->query($sql);
	
	if($d->num_rows() == 1){
		$item = $d->fetch_array();
	}
}
	
function logout(){
	global $login_name_admin;
	$_SESSION[$login_name_admin] = false;
	transfer("Đăng xuất thành công", "index.php?com=user&act=login");
}
?>