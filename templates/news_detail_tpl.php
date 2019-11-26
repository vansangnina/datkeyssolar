
<?php if (count($backgroud_type)<=0) { ?>
 <h1 class="tieude_giua"><span><?=$title_cat?></span></h1>
<?php } ?>

<div class="box_container">
    <div class="content">   	    
        <?=$row_detail['noidung'.$lang]?> 
        
        <?php if(!empty($tags_sp)) { ?>
            <div class="tukhoa">
                <div id="tags">
                    <span>Tags:</span>
                    <?php foreach($tags_sp as $k=>$tags_sp_item) { ?>
                       <a href="tag/<?=changeTitle($tags_sp_item['ten'])?>/<?=$tags_sp_item['id']?>" title="<?=$tags_sp_item['ten']?>"><?=$tags_sp_item['ten']?></a>
                    <?php } ?>
                    <div class="clear"></div>
                </div>					
            </div>   
        <?php } ?>
        
        <!--share mxh-->
            <div id="mxh_all" style="display: flex;">
                <div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>
                <a href="<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="share_g"></a>
                <div class="addthis_native_toolbox"></div>
            </div>
            <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-width="100%"></div>
        <!--end share-->

        <?php if(count($tintuc) > 0) { ?>   
        <div class="othernews">
             <div class="cactinkhac"><?=$title_other?></div>
             <ul class="phantrang">
                <?php for($i = 0, $count_tintuc = count($tintuc); $i < $count_tintuc; $i++){ ?>
                    <li><a href="<?=$tintuc[$i]['tenkhongdau']?>" title="<?=$tintuc[$i]['ten']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?=$tintuc[$i]['ten']?></a> (<?=make_date($tintuc[$i]['ngaytao'])?>)</li>
                <?php }?>
             </ul> 
             <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div> 
        </div><!--.othernews-->
        
        <?php }?>     
    </div><!--.content-->
</div><!--.box_container-->
         