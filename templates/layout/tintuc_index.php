<?php
$d->reset();
$sql = "select id,ten$lang as ten,tenkhongdau,link from #_video where hienthi=1 limit 1";		
$d->query($sql);
$video_i = $d->result_array();

$d->reset();
$sql_tt = "select id,ten$lang as ten,tenkhongdau,thumb,photo,mota$lang as mota,ngaytao FROM #_news where type='tintuc' and noibat>0 and hienthi=1 order by stt asc limit 0,20";		
$d->query($sql_tt);
$tintuc_i = $d->result_array();


?>



<div id="tintuc_index">


	<div class="content_noidung">
    
    
    
    <div class="col_w70 wow fadeInUp" data-wow-delay="500ms">
    
        <div class="title_tintuc"><span>Tin tức nổi bật</span></div>
        
        <?php if(count($tintuc_i)>0) { ?>
        <div class="box_first_news">
            <a href="tin-tuc/<?=$tintuc_i[0]['tenkhongdau']?>.html" title="<?=$tintuc_i[0]['ten']?>"><img class="img" src="<?=_upload_tintuc_l.$tintuc_i[0]['photo']?>" alt="<?=$tintuc_i[0]['ten']?>" /></a>  
        
            <h3 class="ten"><a href="tin-tuc/<?=$tintuc_i[0]['tenkhongdau']?>.html" title="<?=$tintuc_i[0]['ten']?>"><?=$tintuc_i[0]['ten']?></a></h3>
            <div class="mota"><?=catchuoi($tintuc_i[0]['mota'],150)?></div>  
            
        </div><!---END .box_new-->
        <?php } ?>
     	
        
        <div id="slick_tintuc_i" class="list_news_nb">
            <?php for($i=0;$i<count($tintuc_i);$i++){	?>
        
            <div class="box_news n_index">
                <a href="tin-tuc/<?=$tintuc_i[$i]['tenkhongdau']?>.html" title="<?=$tintuc_i[$i]['ten']?>"><img class="img" src="<?=_upload_tintuc_l.$tintuc_i[$i]['thumb']?>" alt="<?=$tintuc_i[$i]['ten']?>" /></a>  
           
                <h3 class="ten"><a href="tin-tuc/<?=$tintuc_i[$i]['tenkhongdau']?>.html" title="<?=$tintuc_i[$i]['ten']?>"><?=$tintuc_i[$i]['ten']?></a></h3>
                <div class="mota"><?=catchuoi($tintuc_i[$i]['mota'],80)?></div>  
                
            </div><!---END .box_new-->
        
                  
            <?php } ?> 
        </div>

    
    </div>
    
    
    <div class="col_w30 wow fadeInUp" data-wow-delay="500ms">
    	<div class="title_tintuc"><span>VIDEO CLIP</span></div>
    
        <div class="load_video">
        
        </div><!---END .load_video-->
    
    </div>
    
    <div class="clear"></div>
    </div>
    

</div>







