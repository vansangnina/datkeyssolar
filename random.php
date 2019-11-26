<?php
error_reporting(0);
$sokytu=10;
$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
for ($i=0; $i < $sokytu; $i++){
	$vitri = mt_rand( 0 ,strlen($chuoi) );
	$giatri.= substr($chuoi,$vitri,1 );
}

 ?>



 <div align="center">
 	<p>Chuổi ngẫu nhiên của bạn.</p>
 	<p><?php echo $giatri;  ?></p>
 	<p> Giá trị thời gian: <?php echo time();  ?></p>
 </div>