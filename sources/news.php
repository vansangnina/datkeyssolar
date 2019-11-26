<?php  if(!defined('_source')) die("Error");

	@$id_danhmuc =  trim(strip_tags(addslashes($_GET['id_danhmuc'])));
	@$id_list =   trim(strip_tags(addslashes($_GET['id_list'])));
	@$id_cat =   trim(strip_tags(addslashes($_GET['id_cat'])));
	@$id_item =   trim(strip_tags(addslashes($_GET['id_item'])));
	@$id =   trim(strip_tags(addslashes($_GET['id'])));	
		
    if($id!='')
	{
		//Cập nhật lượt xem
		$d->reset();
		$sql_lanxem = "UPDATE #_news SET luotxem=luotxem+1 WHERE tenkhongdau ='$id'";
		$d->query($sql_lanxem);
		
		//Chi tiết tin tức
		$d->reset();
		$sql_detail = "select * FROM #_news where hienthi=1 and tenkhongdau='$id' limit 0,1";
		$d->query($sql_detail);
		$row_detail = $d->fetch_array();
		if(empty($row_detail)){redirect("http://".$config_url.'/404.php');}	
		
		$title_cat = $row_detail['ten'];
		$title = $row_detail['title'];	
		$keywords = $row_detail['keywords'];
		$description = $row_detail['description'];
		
		#Thông tin share facebook
		$images_facebook = 'http://'.$config_url.'/'._upload_tintuc_l.$row_detail['photo'];
		$title_facebook = $row_detail['ten'];
		$description_facebook = trim(strip_tags($row_detail['mota']));
		$url_facebook = getCurrentPageURL();
		
		//Hình ảnh khác của tin tức
		$d->reset();
		$sql_hinhthem = "select id,ten$lang as ten,thumb,photo FROM #_hinhanh where id_hinhanh='".$row_detail['id']."' and type='".$type."' and hienthi=1 order by stt,id desc";
		$d->query($sql_hinhthem);
		$hinhthem = $d->result_array();
		
		//Đánh giá sao
		$d->reset();
		$sql = "select ROUND(AVG(giatri)) as giatri FROM #_danhgiasao where link='".getCurrentPageURL()."' order by time desc";
		$d->query($sql);
		$danhgiasao = $d->fetch_array();
		
		if($danhgiasao['giatri']<6){$num_danhgiasao=6;}else{$num_danhgiasao=$danhgiasao['giatri'];};
		
		//tin tức cùng loại
		$where = " type='".$type."' and id_danhmuc='".$row_detail['id_danhmuc']."' and id<>'".$row_detail['id']."' and hienthi=1 order by stt,id desc";	
	}
	//Danh mục tin tức cấp 4
	elseif($id_item!='')
	{
		$d->reset();
		$sql = "select id,ten$lang as ten,title,keywords,description FROM #_news_item where tenkhongdau='$id_item' limit 0,1";
		$d->query($sql);
		$title_bar = $d->fetch_array();
		if(empty($title_bar)){redirect("http://".$config_url.'/404.php');}
		
		$title_cat = $title_bar['ten'];
		$title = $title_bar['title'];
		$keywords = $title_bar['keywords'];
		$description = $title_bar['description'];
	
		$where = " type='".$type."' and id_item='$id_item' and hienthi=1 order by stt,id desc";
	}
	//Danh mục tin tức cấp 3
	elseif($id_cat!='')
	{
		$d->reset();
		$sql = "select id,ten$lang as ten,title,keywords,description FROM #_news_cat where tenkhongdau='$id_cat' limit 0,1";
		$d->query($sql);
		$title_bar = $d->fetch_array();
		if(empty($title_bar)){redirect("http://".$config_url.'/404.php');}
		
		$title_cat = $title_bar['ten'];
		$title = $title_bar['title'];
		$keywords = $title_bar['keywords'];
		$description = $title_bar['description'];
	
		$where = " type='".$type."' and id_cat='$id_cat' and hienthi=1 order by stt,id desc";
	}
	//Danh mục tin tức cấp 2
	elseif($id_list!='')
	{
		$d->reset();
		$sql = "select id,ten$lang as ten,title,keywords,description FROM #_news_list where tenkhongdau='$id_list' limit 0,1";
		$d->query($sql);
		$title_bar = $d->fetch_array();
		if(empty($title_bar)){redirect("http://".$config_url.'/404.php');}
		
		$title_cat = $title_bar['ten'];
		$title = $title_bar['title'];
		$keywords = $title_bar['keywords'];
		$description = $title_bar['description'];
	
		$where = " type='".$type."' and id_list=".$title_bar['id']." and hienthi=1 order by stt,id desc";
	}
	
	//Danh mục tin tức cấp 1
	else if($id_danhmuc!='')
	{		
		$d->reset();
		$sql = "select id,ten$lang as ten,title,keywords,description FROM #_news_danhmuc where tenkhongdau='$id_danhmuc' limit 0,1";
		$d->query($sql);
		$title_bar = $d->fetch_array();
		if(empty($title_bar)){redirect("http://".$config_url.'/404.php');}
				
		$title_cat = $title_bar['ten'];
		$title = $title_bar['title'];
		$keywords = $title_bar['keywords'];
		$description = $title_bar['description'];
		
		$where = " type='".$type."' and id_danhmuc=".$title_bar['id']." and hienthi=1 order by stt,id desc";
	}
	//Tất cả tin tức
	else
	{
		$where = " type='".$type."' and hienthi=1 order by stt,id desc";
	}
	
	#Lấy tin tức và phân trang
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_news where $where";
	$d->query($sql);	
	$dem = $d->fetch_array();
	
	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	if($id > 0)
	{
		$pageSize = $company['soluong_tink'];//Số item cho 1 trang
	}
	else
	{
		$pageSize = $company['soluong_tin'];//Số item cho 1 trang
	}
	
	$offset = 5;//Số trang hiển thị				
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;		
	
	$d->reset();
	$sql = "select *,ten$lang as ten, mota$lang as mota FROM #_news where $where limit $bg,$pageSize";		
	$d->query($sql);
	$tintuc = $d->result_array();	
	$url_link = getCurrentPageURL();
	
?>