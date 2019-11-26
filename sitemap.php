<?php 
	session_start();
	error_reporting(0);
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	if(!isset($_SESSION['lang']))
	{
		$_SESSION['lang']='';
	}
	$lang=$_SESSION['lang'];
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	include_once _source."lang_$lang.php";
	include_once _lib."file_requick.php";

	$uutien=1;

	function urlElement($url, $pri) {
		echo '<url>'; 
		echo '<loc>'.$url.'</loc>'; 
		echo '<changefreq>weekly</changefreq>'; 
		echo '<priority>'.$pri.'</priority>';
		echo '</url>';
	}


header("Content-Type: application/xml; charset=utf-8"); 
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'; 
 
	urlElement($url_w.$config_url.'','1.0');
	foreach($data as $k=>$v){
			if($v['field']=='id'){
				urlElement($url_w.$config_url.'/'.$v['com'],'1.0');
			}
			$d->query("select tenkhongdau from #_".$v['tbl']." where type='".$v['type']."'");
			if($d->num_rows()>0){
					$link_seo = $d->result_array();
					foreach ($link_seo as $key => $value) { 
							urlElement($url_w.$config_url.'/'.$value['tenkhongdau'],$uutien);
						}
					
				}
	}
echo '</urlset>'; 
?>