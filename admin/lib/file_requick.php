<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	
	#Thông tin công ty
	$d->reset();
	$sql_company = "select *,ten$lang as ten,diachi$lang as diachi from #_company limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();
	$lang_default = array("","en");
	
	if(isset($_SESSION['lang']) && $_SESSION['lang']=='en')
	{
		$lang=$_SESSION['lang'];
	}
	else
	{
		$lang="";
	}

	include_once "lang/lang$lang.php";	
	$url_w = get_http();
	$data = array(
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"ve-chung-toi","type"=>"vechungtoi"),
		array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"san-pham","type"=>"sanpham"),
		array("tbl"=>"product_danhmuc","field"=>"id_danhmuc","source"=>"product","com"=>"san-pham","type"=>"sanpham"),
		array("tbl"=>"product_list","field"=>"id_list","source"=>"product","com"=>"san-pham","type"=>"sanpham"),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"dich-vu","type"=>"dichvu"),
		array("tbl"=>"news_danhmuc","field"=>"id_danhmuc","source"=>"news","com"=>"dich-vu","type"=>"dichvu"),
		array("tbl"=>"news_list","field"=>"id_list","source"=>"news","com"=>"dich-vu","type"=>"dichvu"),
		array("tbl"=>"product_cat","field"=>"id_cat","source"=>"product","com"=>"san-pham","type"=>"sanpham"),
		//array("tbl"=>"product_item","field"=>"id_item","source"=>"product","com"=>"san-pham","type"=>"san-pham"),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"tin-tuc","type"=>"tintuc"),
		array("tbl"=>"news_danhmuc","field"=>"id_danhmuc","source"=>"news","com"=>"tin-tuc","type"=>"tintuc"),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"nang-luong-mat-troi","type"=>"nangluongmattroi"),
		array("tbl"=>"news_danhmuc","field"=>"id_danhmuc","source"=>"news","com"=>"nang-luong-mat-troi","type"=>"nangluongmattroi"),

		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"giai-phap","type"=>"giaiphap"),
		array("tbl"=>"news_danhmuc","field"=>"id_danhmuc","source"=>"news","com"=>"giai-phap","type"=>"giaiphap"),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"cham-soc-khach-hang","type"=>"chamsockhachhang"),
		array("tbl"=>"news","field"=>"id","source"=>"news","com"=>"du-an","type"=>"duan"),
		array("tbl"=>"news_danhmuc","field"=>"id_danhmuc","source"=>"news","com"=>"du-an","type"=>"duan"),
		);
	
	if($com!=''){
		
		foreach($data as $k=>$v){
		if($com!=''){
		$d->query("select id, tenkhongdau from #_".$v['tbl']." where tenkhongdau ='".$com."' and type='".$v['type']."'");
		}
		if($d->num_rows()>0){
		$row = $d->fetch_array();
		$_GET[$v['field']] = $row['tenkhongdau'];
		$com = $v['com'];
		break;
		}
	}
}
	switch($com)
	{
		case 've-chung-toi':
			$type = "vechungtoi";
			$title = _vechungtoi;
			$title_cat = _vechungtoi;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
			
		case 'tin-tuc':
			$type = "tintuc";
			$title = _tintuc;
			$title_cat = _tintuc;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news_v2";
			break;
		case 'nang-luong-mat-troi':
			$type = "nangluongmattroi";
			$title = _nangluongmattroi;
			$title_cat = _nangluongmattroi;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
		case 'giai-phap':
			$type = "giaiphap";
			$title = _giaiphap;
			$title_cat = _giaiphap;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
		case 'cham-soc-khach-hang':
			$type = "chamsockhachhang";
			$title = _chamsockhachhang;
			$title_cat = _chamsockhachhang;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
			
			
		case 'dich-vu':
			$type = "dichvu";
			$title = _dichvu;
			$title_cat = _dichvu;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
			
		case 'du-an':
			$type = "duan";
			$title = _duan;
			$title_cat = _duan;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "duan";
			break;
			
		case 'chinh-sach':
			$type = "chinhsach";
			$title = _chinhsach;
			$title_cat = _chinhsach;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
			
		case 'tai-lieu':
			$type = "tailieu";
			$title = _tailieu;
			$title_cat = _tailieu;
			$title_other = _tailieu;
			$source = "news";
			$template = "download";
			break;
		case 'linh-vuc':
			$type = "linhvuc";
			$title = _linhvuchoatdong;
			$title_cat = _linhvuchoatdong;
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'album':
			$type = "album";
			$title = "HÌNH ẢNH";
			$title_cat = "HÌNH ẢNH";
			$title_other = _tinlienquan;
			$source = "news";
			$template = isset($_GET['id']) ? "congtrinh_detail" : "news";
			break;
			
		case 'lien-he':
			$type = "lienhe";
			$title = _lienhe;
			$title_cat = _lienhe;
			$source = "contact";
			$template = "contact";
			break;

		case 'tim-kiem':
			$type = "sanpham";
			$title = _ketquatimkiem;
			$title_cat = _ketquatimkiem;
			$source = "search";
			$template = "product";
			break;
			
		case 'tags':
			$type = "sanpham";
			$title = _tagsanpham;
			$title_cat = _tagsanpham;
			$source = "product";
			$template = "product";
			break;	
			
		case 'tag':
			$type = "tintuc";
			$title = _tagbaiviet;
			$title_cat = _tagbaiviet;
			$source = "news";
			$template = "news";
			break;	
							
		case 'san-pham':
			$type = "sanpham";
			$title = _sanpham;
			$title_cat = _sanpham;
			$title_other = _sanphamkhac;
			$source = "product";
			$template = isset($_GET['id']) ? "product_detail" : "product";
			break;


			
		case 'video':
			$title = 'Video Clip';
			$title_cat = "Video Clip";
			$source = "video";
			$template = "video";
			break;
		
		case 'gio-hang':
			$type = "giohang";
			$title = _giohang;
			$title_cat = _giohang;
			$source = "giohang";
			$template = "giohang";
			break;	
			
		case 'thanh-toan':
			$type = "thanhtoan";
			$title = _thanhtoan;
			$title_cat = _thanhtoan;
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;
			
		case 'dang-ky':
			$type = "dangky";
			$title = _dangky;
			$title_cat = _dangky;
			$source = "dangky";
			$template = "dangky";
			break;
			
		case 'dang-nhap':
			$type = "dangnhap";
			$title = _dangnhap;
			$title_cat = _dangnhap;
			$source = "dangnhap";
			$template = "dangnhap";
			break;
		
		case 'quen-mat-khau':
			$type = "quenmatkhau";
			$title = _quenmatkhau;
			$title_cat = _quenmatkhau;
			$source = "quenmatkhau";
			$template = "quenmatkhau";
			break;
			
		case 'thay-doi-thong-tin':
			$type = "thaydoithongtin";
			$title = _thaydoithongtin;
			$title_cat = _thaydoithongtin;
			$source = "thaydoithongtin";
			$template = "thaydoithongtin";
			break;
			
		case 'dang-xuat':
			logout();
			break;
				
			
		case 'ngonngu':
			if(isset($_GET['lang']))
			{
				switch($_GET['lang'])
					{
						case '':
							$_SESSION['lang'] = '';
							break;
						case 'en':
							$_SESSION['lang'] = 'en';
							break;
						default: 
							$_SESSION['lang'] = '';
							break;
					}
			}
			else{
				$_SESSION['lang'] = '';
			}
		redirect($_SERVER['HTTP_REFERER']);
		break;
											
		default: 
			$source = "index";
			$template = "index";
			break;
	}
	
	if($source!="") include _source.$source.".php";	
	if($_REQUEST['com']=='logout')
	{
		session_unregister($login_name);
		header("Location:index.php");
	}

	$arr_animate =array("wow bounce","wow flash","wow pulse","wow rubberBand","wow shake","wow swing","wow tada","wow wobble","wow jello","wow bounceIn","wow bounceInDown","wow bounceInLeft","wow bounceInRight","wow bounceInUp","wow bounceOut","wow bounceOutDown","wow bounceOutLeft","wow bounceOutRight","wow bounceOutUp","wow fadeIn","wow fadeInDown","wow fadeInDownBig","wow fadeInLeft","wow fadeInLeftBig","wow fadeInRight","wow fadeInRightBig","wow fadeInUp","wow fadeInUpBig","wow fadeOut","wow fadeOutDown","wow fadeOutDownBig","wow fadeOutLeft","wow fadeOutLeftBig","wow fadeOutRight","wow fadeOutRightBig","wow fadeOutUp","wow fadeOutUpBig","wow flip","wow flipInX","wow flipInY","wow flipOutX","wow flipOutY");		
?>