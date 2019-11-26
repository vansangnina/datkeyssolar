<!-- slick -->
<script type="text/javascript">
    $(document).ready(function(){
		$('.slick2').slick({
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  autoplay:false,  //Tự động chạy
			  autoplaySpeed:5000,  //Tốc độ chạy
			  asNavFor: '.slick'			 
		});
		$('.slick').slick({
			  slidesToShow: 4,
			  slidesToScroll: 1,
			  asNavFor: '.slick2',
			  dots: false,
			  centerMode: false,
			  focusOnSelect: true
		});
		 return false;
    });
</script>
<!-- slick -->

<link href="magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
<script type="text/javascript">
	var mzOptions = {
		zoomMode:true,
		onExpandClose: function(){MagicZoom.refresh();}
	};
</script>

<!--Tags sản phẩm-->
<link href="css/tab.css" type="text/css" rel="stylesheet" />

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$('#content_tabs .tab').hide();
		$('#content_tabs .tab:first').show();
		$('#ultabs li:first').addClass('active');
		
		$('#ultabs li').click(function(){
			var vitri = $(this).data('vitri');
			$('#ultabs li').removeClass('active');
			$(this).addClass('active');
			
			$('#content_tabs .tab').hide();
			$('#content_tabs .tab:eq('+vitri+')').show();
			return false;
		});	
	});
</script>
<!--Tags sản phẩm-->
<?php if (count($backgroud_type)<=0) { ?>
 <h1 class="tieude_giua"><span><?=$title_cat?></span></h1>
<?php } ?>
<div class="box_container">
    <div class="wap_pro">
    <div class="zoom_slick">    
        <div class="slick2">                
            <a data-zoom-id="Zoom-detail" id="Zoom-detail" class="MagicZoom" href="<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['photo'];else echo 'images/noimage.gif';?>" title="<?=$row_detail['ten']?>"><img class='cloudzoom' src="<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['photo'];else echo 'images/noimage.gif';?>" /></a>
            
            <?php $count=count($hinhthem); if($count>0) {?>
            <?php for($j=0,$count_hinhthem=count($hinhthem);$j<$count_hinhthem;$j++){?>
                <a data-zoom-id="Zoom-detail" id="Zoom-detail" class="MagicZoom" href="<?php if($hinhthem[$j]['photo']!=NULL) echo _upload_hinhthem_l.$hinhthem[$j]['photo']; else echo 'images/noimage.gif';?>" title="<?=$row_detail['ten']?>" ><img src="<?php if($hinhthem[$j]['photo']!=NULL) echo _upload_hinhthem_l.$hinhthem[$j]['photo']; else echo 'images/noimage.gif';?>" /></a>	
            <?php }} ?>
        </div><!--.slick-->
        
     
        <?php $count=count($hinhthem); if($count>0) {?>
        <div class="slick">                
                <p><img src="<?=_upload_sanpham_l.$row_detail['thumb']?>" /></p>
                <?php for($j=0,$count_hinhthem=count($hinhthem);$j<$count_hinhthem;$j++){?>
                <p><img src="<?=_upload_hinhthem_l.$hinhthem[$j]['thumb']?>" /></p>
                <?php } ?>
        </div><!--.slick-->
        <?php } ?>
        
    </div><!--.zoom_slick--> 
    
    <ul class="product_info">
    		<?php if($row_detail['masp'] != '') { ?><li><b><?=_masanpham?>:</b> <?=$row_detail['masp']?></span></li><?php } ?>
                 <?php if($row_detail['giacu'] > 0) { ?><li class="giacu">Giá cũ: <?=number_format($row_detail['giacu'],0, ',', '.').' vnđ';?></li><?php } ?>
                 <li class="gia"><?=_gia?>: <?php if($row_detail['gia'] > 0)echo number_format($row_detail['gia'],0, ',', '.').'  vnđ';else echo _lienhe; ?></li>
            
             <?php if($row_detail['mota'] != '') { ?><li><?=$row_detail['mota'.$lang]?></li><?php } ?>
             <li>
            <li class="tailieu_v"> <a href="<?=_upload_sanpham_l.$row_detail['file_upload']?>"><?=_xemtailieu?></a></li>
              <!--share mxh-->
            <div id="mxh_all" style="display: flex;">
                <div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>
                <a href="<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="share_g"></a>
                <div class="addthis_native_toolbox"></div>
            </div>
        <!--end share-->
             </li>          
    </ul>
    <div class="clear"></div>  
    </div><!--.wap_pro-->
    
    
    <div class="wap_pro">
   
           <div id="tabs">
                                <ul id="ultabs">
                                    <li style="text-transform: none;" data-vitri="0"><?=_thongtinchitiet?></li>
                                    <li style="text-transform: none;" data-vitri="1"><?=_binhluan?></li>
                                </ul>

                                <div style="clear:both"></div>
                                
                                <div id="content_tabs">
                                    <div class="tab">
                                        <div id="gallery-2">
                                                <?=$row_detail['noidung'.$lang]?>   
                        
                                        </div>
                                    </div>
                                    <div class="tab">
                                        
                                            <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-width="100%"></div>
                                    </div>
                                </div>
                                <!---END #tabs-->   
                        <div class="clear"></div>
                    </div><!--.box_containerlienhe-->
            
            </div>
            <!---END #tabs-->   
    <div class="clear"></div>
</div><!--.box_containerlienhe-->
<div class="clear"></div>
<div class="tieude_giua"><span><?=$title_other?></span></div>
<div class="box_max clearfix">
    <?php foreach ($product as $key => $value) { ?>
        <div class="box_sanpham">
            <div class="img">
                <a href="<?=$value['tenkhongdau'] ?>">
                    <img src="thumb/350x504/2/<?=_upload_sanpham_l.$value['photo'] ?>" alt="">
                </a>
            </div>
            <div class="info">
                <a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a>
                <p><?=catchuoi($value['mota'],100); ?></p>
            </div>
            <div class="xemthemmmsp">
                <a href="<?=$value['tenkhongdau'] ?>"><?=_xemthem ?></a>
            </div>
        </div>
    <?php } ?>


