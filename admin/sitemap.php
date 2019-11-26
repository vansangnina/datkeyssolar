<?php	
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
		
	function CreateXML($tbl='',$com='',$cap=''){
		global $domtree,$xmlRoot,$config_url;
		
		if($tbl == '') return false;
		
		$result = mysql_query("select id,tenkhongdau from table_$tbl where hienthi=1 order by stt,id desc");
		if($cap=='1')
		{
			while ($row = mysql_fetch_array($result)) {
				$url = $domtree->createElement("url");
				$url = $xmlRoot->appendChild($url);
				/* you should enclose the following two lines in a cicle */
				$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/'.$com.'/'.$row['tenkhongdau'].'-'.$row['id']));
			}
		}
		if($cap=='2')
		{
			while ($row = mysql_fetch_array($result)) {
				$url = $domtree->createElement("url");
				$url = $xmlRoot->appendChild($url);
				/* you should enclose the following two lines in a cicle */
				$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/'.$com.'/'.$row['tenkhongdau'].'-'.$row['id'].'/'));
			}
		}
		if($cap=='3')
		{
			while ($row = mysql_fetch_array($result)) {
				$url = $domtree->createElement("url");
				$url = $xmlRoot->appendChild($url);
				/* you should enclose the following two lines in a cicle */
				$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/'.$com.'/'.$row['tenkhongdau'].'-'.$row['id'].'.htm'));
			}
		}
		else
		{
			while ($row = mysql_fetch_array($result)) {
				$url = $domtree->createElement("url");
				$url = $xmlRoot->appendChild($url);
				/* you should enclose the following two lines in a cicle */
				$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/'.$com.'/'.$row['tenkhongdau'].'-'.$row['id'].'.html'));
			}
		}
		return $url;
	}
	
	
	/* create a dom document with encoding utf8 */
    $domtree = new DOMDocument('1.0', 'UTF-8');
    /* create the root element of the xml tree */
    $xmlRoot = $domtree->createElement("xml");
    /* append it to the document created */
    $xmlRoot = $domtree->appendChild($xmlRoot);
	
	CreateXML('product','san-pham');
	CreateXML('news','tin-tuc');
	CreateXML('tuyendung','tuyen-dung');
	CreateXML('khuyenmai','khuyen-mai');
	CreateXML('dichvu','dich-vu');
	CreateXML('duan','du-an');
	CreateXML('congtrinh','cong-trinh');
	
	CreateXML('product_danhmuc','san-pham','1');
	CreateXML('product_list','san-pham','2');
	CreateXML('product_cat','san-pham','3');
	
	CreateXML('news_item','tin-tuc','1');
	CreateXML('dichvu_item','dich-vu','1');
	CreateXML('tuyendung_item','tuyen-dung','1');
	CreateXML('khuyenmai_item','khuyen-mai','1');
	CreateXML('duan_item','du-an','1');
	CreateXML('congtrinh_item','cong-trinh','1');
	
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/gioi-thieu.html'));
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/lien-he.html'));
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/dang-ky.html'));
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/dang-nhap.html'));
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/gio-hang.html'));
	
	$url = $domtree->createElement("url");
	$url = $xmlRoot->appendChild($url);
	/* you should enclose the following two lines in a cicle */
	$url->appendChild($domtree->createElement('loc','http://'.$config_url.'/thanh-toan.html'));
			
    /* get the xml printed */
	if($domtree->save('../sitemap.xml'))
		transfer('Đã tạo thành công sitemap.', 'index.php');
	else
		transfer('Khời tạo dữ liệu thất bại.', 'index.php');

?>
