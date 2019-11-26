<?php

$d->reset();
$sql_slider = "select ten$lang as ten,link,photo from #_slider where  type='slider' and hienthi=1 order by stt,id desc";
$d->query($sql_slider);
$slider=$d->result_array();
	
?>
<div id="slick_slide_index">
	 <?php  for($i=0;$i<count($slider);$i++){ ?>
	    <a target="_blank" href="<?=$slider[$i]['link']?>"><img src="<?=_upload_hinhanh_l.$slider[$i]['photo']?>" alt="<?=$slider[$i]['ten']?>" id="" title="<?=$slider[$i]['ten'] ?>" /></a>
    <?php } ?>  
</div>
    
  
    
 