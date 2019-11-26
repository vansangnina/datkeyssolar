<?php
	
$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,thumb from #_product_danhmuc where hienthi=1 and type='sanpham' order by stt,id desc";
$d->query($sql);
$p_danhmuc=$d->result_array();

$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,thumb from #_news_danhmuc where hienthi=1 and type='nangluongmattroi' order by stt,id desc";
$d->query($sql);
$nangluong=$d->result_array();



$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,thumb from #_news_danhmuc where hienthi=1 and type='giaiphap' order by stt,id desc";
$d->query($sql);
$giaiphap=$d->result_array();

$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,thumb from #_news_danhmuc where hienthi=1 and type='duan' order by stt,id desc";
$d->query($sql);
$duan_menu=$d->result_array();

$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,thumb from #_news_danhmuc where hienthi=1 and type='tintuc' order by stt,id desc";
$d->query($sql);
$tintuc_menu=$d->result_array();
    

    

$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,thumb from #_news where hienthi=1 and type='vechungtoi' order by stt,id desc";
$d->query($sql);
$ve_chungtoi=$d->result_array();


	
?>


<nav id="menu_mobi" style="height:0; overflow:hidden;"></nav>
<div class="header">

<a href="#menu_mobi" class="hien_menu"><i class="fa fa-bars" aria-hidden="true"></i> </a>

<a href="tel:<?=$company['dienthoai']?>">
<p class="hotline_m">Hotline: <?=$company['dienthoai']?></p>
</a>
</div>
<nav id="menu">
<ul>
	
    <li><a class="<?php if($_REQUEST['com'] == 've-chung-toi') echo 'active'; ?>" href="ve-chung-toi">
	<?=_vechungtoi?></a>

    <ul>
        <?php foreach ($ve_chungtoi as $key => $value) { ?>
        <li><a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a></li>
        <?php } ?>
    </ul>

    </li>

	<li><a class="<?php if($_REQUEST['com'] == 'san-pham') echo 'active'; ?>" href="san-pham"><?=_sanpham?></a>
        <ul>
			<?php for($i = 0; $i < count($p_danhmuc); $i++){ 
            $d->reset();
            $sql_dvquan="select ten$lang as ten,tenkhongdau,id from #_product_list where id_danhmuc=".$p_danhmuc[$i]['id']." and type='sanpham' and hienthi=1 order by stt asc,id desc";
            $d->query($sql_dvquan);
            $p_list=$d->result_array();
            
            ?>
            <li><a href="<?=$p_danhmuc[$i]['tenkhongdau']?>"><?=$p_danhmuc[$i]['ten']?></a>
				<?php if(count($p_list)>0) { ?>
                <ul class="dm_cap2">
                <?php for($j=0;$j<count($p_list);$j++) { ?>
                    <li><a href="<?=$p_list[$j]['tenkhongdau']?>"><?=$p_list[$j]['ten']?></a>
                        <ul>
                            
                        
                        <?php
                            $d->reset();
                            $sql_dvquan="select ten$lang as ten,tenkhongdau,id from #_product_cat where id_list=".$p_list[$j]['id']." and type='sanpham' and hienthi=1 order by stt asc,id desc";
                            $d->query($sql_dvquan);
                            $p_cat=$d->result_array();
                         ?>
                         <?php foreach ($p_cat as $key => $value) { ?>
                             <li><a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a></li>
                         <?php } ?>
                         </ul>

                    </li>



                <?php } ?>



                </ul>
                <?php } ?>



            
            </li>
            <?php } ?>
        </ul>
    </li>
    
    <li><a class="<?php if($_REQUEST['com'] == 'nang-luong-mat-troi') echo 'active'; ?>" href="nang-luong-mat-troi"><?=_nangluongmattroi?></a>
    <ul>
        <?php foreach ($nangluong as $key => $value) { ?>
            <li><a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a></li>
        <?php } ?>
    </ul>

    </li>
    <li><a class="<?php if($_REQUEST['com'] == 'tin-tuc') echo 'active'; ?>" href="tin-tuc">
    <?=_tintuc?></a>
    
        <ul>
            <?php foreach ($tintuc_menu as $key => $value) { ?>
            <li><a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a></li>
            <?php } ?>
        </ul>

    </li>

     <li><a class="<?php if($_REQUEST['com'] == 'du-an') echo 'active'; ?>" href="du-an">
    <?=_duan?></a>
         <ul>
                <?php foreach ($duan_menu as $key => $value) { ?>
                    <li><a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a></li>
                <?php } ?>
        </ul>
    </li>
    <li><a class="<?php if($_REQUEST['com'] == 'giai-phap') echo 'active'; ?>" href="giai-phap">
	<?=_giaiphap?></a>

        <ul>
            <?php foreach ($giaiphap as $key => $value) { ?>
                <li><a href="<?=$value['tenkhongdau'] ?>"><?=$value['ten'] ?></a></li>
            <?php } ?>
        </ul>

    </li>
     <li class="padding"><a class="<?php if($_REQUEST['com'] == 'cham-soc-khach-hang') echo 'active'; ?>" href="cham-soc-khach-hang">
    <?=_chamsockhachhang?></a></li>

     <li class="mobile"><a class="<?php if($_REQUEST['com'] == 'tai-lieu') echo 'active'; ?>" href="tai-lieu">
    <?=_tailieu?></a></li>
     <li class="mobile"><a class="<?php if($_REQUEST['com'] == 'lien-he') echo 'active'; ?>" href="lien-he">
    <?=_lienhe?></a></li>
</ul>

</nav>


<div class="search" style="display: none;">
<input type="text" name="keyword" id="keyword" placeholder="Nhập từ khóa..." value="<?=@$tukhoa?>" >
<p class="btn_search" aria-hidden="true" 
title="<?=_search?>" onclick="onSearch(event,'keyword');" ></p>
</div>


<?php /*?><div class="mxh_top">

<!--share_this-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "c5c97f0c-e226-4405-add0-b24c933fe981", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_googleplus_large' displayText='Google +'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_pinterest_large' displayText='Pinterest'></span>
<span class='st_sharethis_large' displayText='ShareThis'></span>
</div><?php */?>