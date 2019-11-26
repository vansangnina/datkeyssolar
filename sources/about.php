<?php  if(!defined('_source')) die("Error");
	
	#Chi tiết bài viết
	$sql = "select ten$lang as ten,noidung$lang as noidung,title,keywords,description from #_about where type='".$type."' and hienthi=1 limit 0,1";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	
	#Thông tin seo web
	//$title_cat = 'Giới thiệu';		
	$title = $tintuc_detail['title'];
	$keywords = $tintuc_detail['keywords'];
	$description = $tintuc_detail['description'];
	
?>