<div class="tieude_giua"><?=$title_cat?></div>
<div class="box_container">
    <div class="content">   
    	
		<?php if(count($hinhthem) > 0) { ?>
            <link href="css/fotorama.css" rel="stylesheet">
            <script src="js/fotorama.js" type="text/javascript"></script>
            <div class="fotorama" data-nav="thumbs" data-maxheight="550" data-arrows="true" data-thumbwidth="" data-thumbheight="" data-loop="true" data-autoplay="4000" data-fit="contain" data-allowfullscreen="true" data-stopautoplayontouch="false">        
                <?php for($j=0,$count_hinhthem=count($hinhthem);$j<$count_hinhthem;$j++){?>
                    <img src="<?=_upload_hinhthem_l.$hinhthem[$j]['photo']; ?>" />
                <?php } ?>
            </div>
        <?php } ?>
    

        <?=$row_detail['noidung']?>  
        <div class="addthis_native_toolbox"></div>  

        <?php if(count($tintuc_khac) > 0) { ?>   
        <div class="othernews">
             <div class="cactinkhac"><?=_cacbaikhac?></div>
             <ul>
                <?php for($i = 0, $count_tintuc_khac = count($tintuc_khac); $i < $count_tintuc_khac; $i++){ ?>
                    <li><a href="<?=$com?>/<?=$tintuc_khac[$i]['tenkhongdau']?>-<?=$tintuc_khac[$i]['id']?>.html" title="<?=$tintuc_khac[$i]['ten']?>"><?=$tintuc_khac[$i]['ten']?></a> (<?=make_date($tintuc_khac[$i]['ngaytao'])?>)</li>
                <?php }?>
             </ul>
        </div><!--.othernews-->
        <?php }?>
        
    </div><!--.content-->
</div><!--.box_container-->
         