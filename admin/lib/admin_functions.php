<?php if(!defined('_lib')) die("Error");

class AdminTools{
	public $permission;
	public $all_permission;
	public $d;
	public function getListPer(){
		$tmp = array();
		$tmp2= array();
		if(is_array(@$this->permission)){
			foreach(@$this->permission as $k=>$v){
				$tmp2[$v['per_id']] = $v;
			}
		}
		$this->d->query("select * from #_permission");
		
		foreach($this->d->result_array() as $k=>$v){
			if(isset($tmp2[$v['id']])){	
			
				$xtmp = array();
				
				if($v['man_exec']){
					$xtmp[$v['man_exec']] = $tmp2[$v['id']]['has_man'];
				}
				if($v['edit_exec']){
					$xtmp[$v['edit_exec']] = $tmp2[$v['id']]['has_edit'];
				}
				if($v['delete_exec']){
					$xtmp[$v['delete_exec']] = $tmp2[$v['id']]['has_delete'];
				}
				if($v['add_exec']){
					$xtmp[$v['add_exec']] = $tmp2[$v['id']]['has_add'];
				}
				if($v['id_exec'] > 0){
					$xtmp['id'] = $v['id_exec'];
				}
				if($v['com_act']){
					$xtmp['com_act'] = $v['com_act'];
				}
				if($v['type']){
					$xtmp['type'] = $v['type'];
				}
				if($v['levels']){
					$xtmp['levels'] = $v['levels'];
				}
				$xtmp[$v['act_exec']] = $tmp2[$v['id']]['has_act'];
				$tmp[$v['com']][] = $xtmp;
				
			}	
		}
		$this->permission=$tmp;	
		
	}
	public function __construct($d) {
		$this->d = $d;
		
		if(isset($_SESSION['login'])){
		$this->d->query("select * from #_user_permission where user_id ='".$_SESSION['login']['role']."' ");
			foreach($this->d->result_array() as $k=>$v){
				
				$this->permission[] = $v;
			}
			
		
			
			$this->d->query("select * from #_permission");
			foreach($this->d->result_array() as $k=>$v){
				$this->all_permission[$v['com']][] = $v;
			}
		}
		$tmp = array();
		$this->getListPer();		
		
		
    }
	
	public function setFlash($name,$msg,$type="success"){
		$_SESSION[$name]['msg'] = $msg;
		$_SESSION[$name]['type'] = $type;
	}
	public function getFlash($name){
		if(isset($_SESSION[$name])){
		$data = $_SESSION[$name];
		unset($_SESSION[$name]);
		return $data;	
		}
		return false;
	}
	public  function displayFlash($name){
		$data = $this->getFlash($name);
		
		if(is_array($data)){
			echo '<div style="width: 600px;margin: 10px auto;" class="alert fade in alert-dismissible alert-'.$data['type'].'" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'.$data['msg'].'</div>';
			echo '<script>$().ready(function(){setTimeout(function(){$(".alert .close").click();},1500);})</script>';
		}
	}
	public function insertMsg($stt=true){
		if($stt){
			$this->setFlash("status_database","Thêm thành công!");
		}else{
			$this->setFlash("status_database","Thêm thất bại!","error");
		}
	}
	public function updateMsg($stt=true){
		if($stt){
			$this->setFlash("status_database","Cập nhật thành công!");
		}else{
			$this->setFlash("status_database","Cập nhật thất bại!","error");
		}
	}
	public function showDbStatus(){
		$this->displayFlash("status_database");
	}
	function generateMenu($com,$act,$list_act,$name,$id=null){
		
		
		$this->checkIssetPermission($com,$act,$list_act,$name,$id);
		
		if(isset($this->permission[$com])){
			
			$p = false;
			
			foreach($this->permission[$com] as $k=>$v){
				
				foreach($v as $k3=>$v3){
					if($v3){
						
						foreach($act as $k2=>$v2){
							
							if($p==false){
								
								if($v2==$k3){
									
									if(isset($v['id'])){
										if($v['id'] == $id & $v[end($act)] == 1){
											$p = true;
										}else{
											$p = false;
										}
									}else{
						
										$p = true;
									}
								}	
							}
						}
					}
				}
			}
			if($p){
				if($id!=null){
					
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'">'.$name.'</a></li>  ';
				}else{
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'">'.$name.'</a></li>  ';
				}
			}
			return false;
		}
		if($_SESSION['login']['role'] == 3){
				if($id!=null){
					
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'">'.$name.'</a></li>  ';
				}else{
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'">'.$name.'</a></li>  ';
				}
			
		
		}
	}
	function generateMenuType($com,$act,$list_act,$name,$id=null,$type){
		
		$this->checkIssetPermissionType($com,$act,$list_act,$name,$id,$type);
		//dump($this->permission[$com]);
		if(isset($this->permission[$com])){
			
			$p = false;
			
			foreach($this->permission[$com] as $k=>$v){
				
				foreach($v as $k3=>$v3){
					if($v3){
						
						foreach($act as $k2=>$v2){
							
							if($p==false){
								
								if($v2==$k3){
									
									if(isset($v['id'])){
										if($v['id'] == $id & $v[end($act)] == 1){
											$p = true;
										}else{
											$p = false;
										}
									}else{
						
										$p = true;
									}
								}	
							}
						}
					}
				}
			}
			if($p){
				if($id!=null){
					
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&type='.$type.'">'.$name.'</a></li>  ';
				}else{
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'&type='.$type.'">'.$name.'</a></li>  ';
				}
			}
			return false;
		}
		if($_SESSION['login']['role'] == 3){
				if($id!=null){
					
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&type='.$type.'">'.$name.'</a></li>  ';
				}else{
					return '<li class="'.$com.'_'.end($act).'"><a href="index.php?com='.$com.'&act='.end($act).'&type='.$type.'">'.$name.'</a></li>  ';
				}
			
		
		}
	}
	function generateMenuTypeList($com,$act,$list_act,$name,$id=null,$levels,$type){
		
		$this->checkIssetPermissionTypeList($com,$act,$list_act,$name,$id,$levels,$type);
		
		if(isset($this->permission[$com])){
			
			$p = false;
			
			foreach($this->permission[$com] as $k=>$v){
				
				foreach($v as $k3=>$v3){
				
					if($v3){
						
						foreach($act as $k2=>$v2){
							
							if($p==false){
								
								if($v2==$k3){
									
									if(isset($v['id'])){
										if($v['id'] == $id & $v[end($act)] == 1){
											$p = true;
										}else{
											$p = false;
										}
									}else{
						
										$p = true;
									}
								}	
							}
						}
					}
				}
			}
			if($p){
				
				if($id!=null){
					return '<li><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&levels='.$levels.'&type='.$type.'">'.$name.'</a></li>  ';
				}else{
					
					return '<li><a href="index.php?com='.$com.'&act='.end($act).'&levels='.$levels.'&type='.$type.'">'.$name.'</a></li>  ';
				}
			}
			return false;
		}
	
		if($_SESSION['login']['role'] == 3){
				if($id!=null){
					return '<li><a href="index.php?com='.$com.'&act='.end($act).'&id='.$id.'&levels='.$levels.'&type='.$type.'">'.$name.'</a></li>  ';
				}else{
					return '<li><a href="index.php?com='.$com.'&act='.end($act).'&levels='.$levels.'&type='.$type.'">'.$name.'</a></li>  ';
					
				}
			
		
		}
	}
	function checkIssetPermission($com,$act,$list_act,$name,$id){
		$this->addingPermission($com,$act,$list_act,$name,$id);
	
	
	}
	function checkIssetPermissionTypeList($com,$act,$list_act,$name,$id,$levels,$type){
		
		$this->addingPermissionTypeList($com,$act,$list_act,$name,$id,$levels,$type);
	
	
	}
	function checkIssetPermissionType($com,$act,$list_act,$name,$id,$type){
		$this->addingPermissionType($com,$act,$list_act,$name,$id,$type);
	
	
	}
	public function addingPermission($com,$act = array(),$list_act=array(),$name,$id){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		foreach($list_act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$list_act_exec=$v;
		}
		
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and  ".$per);
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and id_exec=".$id);
		}

		if($this->d->num_rows() == 0){
			
			$act['name'] = $name;
			$act['com'] = $com;
			$act['com_act'] = $list_act_exec;
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."' and com_act='".$act['com_act']."'";
			$this->d->query($sql);
			
			if(!$this->d->num_rows()){
				$this->d->setTable("permission");
				$this->d->insert($act);				
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				unset($act['name']);
				if($this->d->update($xper));		
			}

		}
	}
	public function addingPermissionType($com,$act = array(),$list_act=array(),$name,$id,$type){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		foreach($list_act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$list_act_exec=$v;
		}
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and  ".$per." and type='".$type."'");
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and id_exec=".$id." and type='".$type."'");
		}
		
		if($this->d->num_rows() == 0){
			
			$act['name'] = $name;
			$act['com'] = $com;
			$act['type'] = $type;
			$act['com_act'] = $list_act_exec;
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."' and com_act='".$act['com_act']."' and type='".$act['type']."'";
			$this->d->query($sql);
			if(!$this->d->num_rows()){
				$this->d->setTable("permission");
				$this->d->insert($act);				
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				$this->d->setWhere("com_act",$list_act_exec);
				unset($act['name']);
				if($this->d->update($act));		
			}

		}
	}
	public function addingPermissionTypeList($com,$act = array(),$list_act=array(),$name,$id,$levels,$type){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		foreach($list_act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$list_act_exec=$v;
		}
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and  ".$per." and type='".$type."' and level='".$levels."'");
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and id_exec=".$id." and type='".$type."' and level='".$levels."'");
		}
		
		if($this->d->num_rows() == 0){
			//echo 'a'; die();
			$act['name'] = $name;
			$act['com'] = $com;
			$act['type'] = $type;
			$act['levels'] = $levels;
			$act['com_act'] = $list_act_exec;
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."' and com_act='".$act['com_act']."' and type='".$type."' and level='".$levels."'";
			$this->d->query($sql);
			
			if($this->d->num_rows()==0){
				$this->d->setTable("permission");
				$this->d->insert($act);	
				unset($act);
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				$this->d->setWhere("com_act",$act['com_act']);
				$this->d->setWhere("type",$act['type']);
				$this->d->setWhere("level",$act['levels']);
				unset($act);
				if($this->d->update($xper));
			}

		}
	}
	function checkIssetPermission_check($com,$act,$name,$id){
		$this->addingPermission_check($com,$act,$name,$id);
	
	
	}
	public function addingPermission_check($com,$act = array(),$name,$id){
		
		$per = '';
		$xper = array();
		foreach($act as $k=>$v){
			$per = $k." = '".$v."'";
			$xper[$k] = $v;
			$act_exec=$v;
		}
		
		if(!$id){
			$this->d->query("select * from #_permission where com='".$com."' and  ".$per);
		}else{
			$this->d->query("select * from #_permission where com='".$com."' and ".$per." and id_exec=".$id);
		}

		if($this->d->num_rows() == 0){
			
			$act['name'] = $name;
			$act['com'] = $com;
			$act['com_act'] = $com.'_'.$act_exec;
			
			if($id){
				$act['id_exec'] = $id;
			}
			$sql="select * from #_permission where com='".$com."'";
			
			$this->d->query($sql);
			
			if(!$this->d->num_rows()){
				$this->d->setTable("permission");
				$this->d->insert($act);				
			}else{
				$this->d->setTable("permission");
				$this->d->setWhere("com",$com);
				unset($act['name']);
				if($this->d->update($xper)) ;		
			}

		}
	}
	function execPer(){
		$accept = array("save","save_bds","save_deadline","save_cd","save_date","save_duong","save_danhmuc","save_list", "save_cat","save_item","save_photo","capnhat","logout","login");
		if(!in_array($_GET['act'],$accept)){
		if(!$this->checkPermissionWhenExecute()){
			
			transfer("Bạn không có quyền truy cập VÀO ĐÂY", $_SERVER['HTTP_REFERER']);
		}
		}
	}
	function checkPermissionWhenExecute(){
		$p = false;
		$com = $_GET['com'];
		$act = $_GET['act'];
		$act_com = $_GET['com'].'_'.$_GET['act'];
		$levels=$_GET["levels"];
		$type=$_GET["type"];
		//dump($this->permission[$com]);
		$id = $_GET['id'];
		if($com==""){ return true;}
		if($_SESSION['login']['role'] == 3){
			return true;
		}
		if($act=="admin_edit"){
			return true;
		}
		if($act=="add_deadline"||$act=="add_cd"||$act=="add_date"||$act=="add_duong"||$act=="add_bds"||$act=="add_danhmuc"||$act=="add_list"||$act=="add_item"||$act=="add_cat"||$act=="add_photo"||$act=="add"){
			$has_act="add";
		}
		if($act=="edit_deadline"||$act=="edit_cd"||$act=="edit_date"||$act=="edit_duong"||$act=="edit_bds"||$act=="edit_danhmuc"||$act=="edit_list"||$act=="edit_cat"||$act=="edit_item"||$act=="edit_photo"||$act=="edit"){
			$has_act="edit";
		}
		if($act=="delete_deadline"||$act=="delete_cd"||$act=="delete_date"||$act=="delete_duong"||$act=="delete_bds"||$act=="delete_list"||$act=="delete_cat"||$act=="delete_photo"||$act=="delete"){
			$has_act="delete";
		}
		if($act=="man_deadline"||$act=="man_cd"||$act=="man_date"||$act=="man_duong"||$act=="man_bds"||$act=="man_danhmuc"||$act=="man_list"||$act=="man_item"||$act=="man_cat"||$act=="man_photo"||$act=="man"||$act=="man_brand"||$act=="man_ncc"||$act=="load"||$act=="add_user_to_per"){
			$has_act="man";
		}
		
		if(isset($this->permission[$com])){	
			
			foreach($this->permission[$com] as $k=>$v){
				if($levels!=''){
					$this->d->query("select * from #_permission where com='".$com."' and find_in_set('".$act."',com_act)>0 and type='".$type."' and level='".$levels."'");
				}else if($type!=''){
					$this->d->query("select * from #_permission where com='".$com."' and find_in_set('".$act."',com_act)>0 and type='".$type."'");
				}else{
					$this->d->query("select * from #_permission where com='".$com."' and find_in_set('".$act."',com_act)>0 ");
				}
				$rs=$this->d->fetch_array();
				
				$this->d->query("select * from #_user_permission where per_id='".$rs["id"]."' and user_id='".$_SESSION["login"]["role"]."' ");
				$rs_per=$this->d->fetch_array();
				
				//dump($rs_per);
				if($has_act=="add"){
					if($rs_per["has_add"]==1) return true; else return false;
				}else if($has_act=="edit"){
					if($rs_per["has_edit"]==1) return true; else return false;
				}else if($has_act=="delete"){
					if($rs_per["has_delete"]==1) return true; else return false;
				}else if($has_act=="man"){
					if($rs_per["has_man"]==1) return true; else return false;
				}
				/* if($v["act"]==$act){
					echo 'a'; die();
					if($v["type"]==$type){
						if($levels!=''){
							if($v["levels"]==$levels){
								if(isset($v['id']) & ($v['id'] == $id)){
									if($v[$_GET['act']] == 1){
										return true;
									}else{
										return false;
									}
								}else{
									return true;
								}
							}
						}else{
							if(isset($v['id']) & ($v['id'] == $id)){
								if($v[$_GET['act']] == 1){
									return true;
								}else{
									return false;
								}
							}else{
								return true;
							}
						}
					}else{
						$p = false;
					}
					
				}else{
					$p = false;
				}
				 */
				/* foreach($v as $k2=>$v2){
					
					if($act==$k2 & $v2){
						if(isset($v['id']) & ($v['id'] == $id)){
							if($v[$_GET['act']] == 1){
								return true;
							}else{
								return false;
							}
						}else{
							return true;
						}
					}else{
						$p = false;
					
					}
				}	 */	
			}
		}
		$has_per  = array("edit","add","delete");
		
		if(in_array($_GET['act'],$has_per)){
			$this->checkIssetPermission_check($com,array($_GET['act']."_exec"=>$_GET['act']),null,null);
		}
		
		
	}
	
	function checkAct($arr,$act){
		return ;
	
	}
}