<?php
	$d = new database($config['database']);
	$d->reset();
	$d->setTable("lang");
	$d->select("tenbien,tenko");
	$result_lang = $d->result_array();
	foreach ($result_lang as $key => $value) {
		@define($value['tenbien'],$value['tenko']);
	}
?>