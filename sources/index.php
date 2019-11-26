<?php  if(!defined('_source')) die("Error");


	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id,photo,thumb,mota$lang as mota from #_news_danhmuc where  type='giaiphap' and hienthi=1 order by stt asc,id desc";
	$d->query($sql);
	$giaiphap1=$d->result_array();

	$d->reset();
	$sql="select ten$lang as ten,tenkhongdau,id,photo,thumb,mota$lang as mota from #_news where  type='nangluongmattroi' and hienthi=1 order by stt asc,id desc";
	$d->query($sql);
	$nangluongmattroi=$d->result_array();
?>