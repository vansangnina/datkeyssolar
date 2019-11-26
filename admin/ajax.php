<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');
		
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$login_name_admin = 'NINACO';
	$d = new database($config['database']);
	$do = (isset($_REQUEST['do'])) ? addslashes($_REQUEST['do']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	
	if($do=='admin'){
		if($act=='login'){
			
			$ip = getRealIPAddress();
			//Kiểm tra có IP bị khóa login hay không
			$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit WHERE login_ip =  '$ip'  ORDER BY id DESC LIMIT 1 ";
			$d->query($sql);
			if($d->num_rows() == 1){				
			$row = $d->result_array();			  
			$id_login = $row[0]['id'];			
			$time_now = time();
			//Kiểm tra thời gian bị khóa đăng nhập
			if($row[0]['locked_time']>0){
				$locked_time = $row[0]['locked_time'];		   
				$delay_time = $config['login']['delay'];
				$interval = $time_now  - $locked_time;
				if($interval <= $delay_time*60){
					$time_remain = $delay_time*60 - $interval;
					$msg = "Xin lỗi..!Vui lòng thử lại sau ". round($time_remain/60)." phút..!";
					die('{"mess":"'.$msg.'"}');	    
				}else{				        	       
					$sql="update #_user_limit set login_attempts = 0,attempt_time = '$time_now' ,locked_time = 0 where id = '$id_login'";
					$d->query($sql);			          
				}	
			}		   
			}	
			
			
			$username = $_POST['email'];
			$password = $_POST['pass'].$salt_pw;
	
			$sql = "select * from #_user where username='".$username."'";
			$d->query($sql);
			if($d->num_rows() == 1){
				$row = $d->fetch_array();
				if($row['password'] == md5($password)){
					$_SESSION[$login_name_admin] = true;
					$_SESSION['login_admin']['role'] = $row['role'];
					$_SESSION['login_admin']['nhom'] = $row['nhom'];
					$_SESSION['login_admin']['com'] = $row['com'];
					$_SESSION['isLoggedIn'] = true;
					$_SESSION['login_admin']['username'] = $username;
					$_SESSION['login_admin']['name'] = $row['ten'];
					$_SESSION['ck'] = $config_url;
					echo '{"page":"index.php"}';
					
					$d->reset();
					$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip =  '$ip'  order by  id desc limit 1";
					$d->query($sql);
    				if($d->num_rows()==1){
    					$row_limitlogin = $d->result_array();
				        $id_login = $row_limitlogin[0]['id'];						
				        $sql="update #_user_limit set login_attempts = 0,locked_time = 0 where id = '$id_login'";
						$d->query($sql);
				   	}	

					
				}else
				{ 
					$d->reset();
					$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip =  '$ip'  order by  id desc limit 1";
					$d->query($sql);			
					if($d->num_rows()==1){//Trường hơp đã tồn tại trong database				
						$row = $d->result_array();				
						$id_login = $row[0]['id'];
						$attempt =$row[0]['login_attempts'];//Số lần thực hiện
						$noofattmpt = $config['login']['attempt'];//Số lần giới hạn
						 if($attempt<$noofattmpt){//Trường hợp còn trong giới hạn
							$attempt = $attempt +1;					
							$sql="update #_user_limit set login_attempts = '$attempt' where id = '$id_login'";
							$d->query($sql);					
							$no_ofattmpt =  $noofattmpt+1;
							$remain_attempt = $no_ofattmpt - $attempt;
							$msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';
						 }else{//Trường hợp vượt quá giới hạn
							if($row[0]['locked_time']==0){
								  $attempt = $attempt +1;
								  $timenow = time();
								  $sql="update #_user_limit set login_attempts = '$attempt' ,locked_time = '$timenow' where id = '$id_login'";
								  $d->query($sql);	                  
							 }else{
								  $attempt = $attempt +1;	                  
								  $sql="update #_user_limit set login_attempts = '$attempt' where id = '$id_login'";
								  $d->query($sql);
							 }
		
							$delay_time = $config['login']['delay'];
							$msg = "Bạn đã hết lần thử. Vui lòng thử lại sau ".$delay_time." phút!";
						 }
					}else{//Trường hợp IP lần đầu tiên đăng nhập sai
						$timenow = time();
						$d->reset();
						$sql="insert into #_user_limit (login_ip,login_attempts,attempt_time,locked_time) values('$ip',1,'$timenow',0)";
						$d->query($sql);
						$remain_attempt = $config['login']['attempt'];
						$msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';		               
					}
						die('{"mess":"'.$msg.'"}');

				
				}
			}else
			echo '{"mess":"Tên đăng nhập không tồn tại!"}';
		
			
		}				
	}	

	//Cap nhat so thu tu
	if($do=='number'){
		if($act=='update'){
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);;
			$num=(int)$_POST['num'];
			$sql="update #_$table set stt='$num' where id='$id' ";
			$d->query($sql);
		}
	}
	
	//Cap nhat trang thai
	if($do=='status'){
		if($act=='update'){						
			$table=addslashes($_POST['table']);
			$id=addslashes($_POST['id']);
			$field=addslashes($_POST['field']);
			$d->reset();						
			$sql="update #_$table set $field =  where id='$id' ";
						
			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($id_cart));
			echo json_encode($cart);
		}
	}
	
	//Cap nhat gio hang
	if($do=='cart'){
		if($act=='update'){						
			$id=(int)$_POST['id'];
			$sl=(int)$_POST['sl'];			
			
			$d->reset();						
			$d->query("update #_chitietdonhang set soluong='".$sl."' where id='".$id."'");
			
			$d->reset();
			$sql="select * from #_chitietdonhang where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();			
			$thanhtien=$result['gia']*$result['soluong'];
			$cart=array('thanhtien'=>$thanhtien,'tongtien'=>get_tong_tien($result['madonhang']));
			
			$d->reset();						
			$d->query("update #_donhang set tonggia='".get_tong_tien($result['madonhang'])."' where madonhang='".$result['madonhang']."'");
			
			echo json_encode($cart);
		}
	}
	
	//Xoa gio hang
	if($do=='cart'){
		if($act=='delete'){						
			$id=(int)$_POST['id'];
			$id_order=(int)$_POST['id_order'];			
			$d->reset();			
			$d->query("delete from #_chitietdonhang where id='".$id."'");
			
			$d->reset();
			$sql="select * from #_chitietdonhang where id='".$id."'";
			$d->query($sql);
			$result=$d->fetch_array();
			
			$d->reset();						
			$d->query("update #_donhang set tonggia='".get_tong_tien($id_order)."' where id='".$id_order."'");
									
			$cart=array('tongtien'=>get_tong_tien($id_order));
			echo json_encode($cart);
			
		}
	}
	
	//Xoa tag san pham
	if($do=='products'){
		if($act=='tags'){						
			$uni_tag = $_POST['uni_tag'];
			$id=(int)$_POST['id'];			
			$d->reset();			
			$d->query("delete from #_tag where item_id='".$id."' and  	unique_key_tag='$uni_tag'");
		}
	}
?>