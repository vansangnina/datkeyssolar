

<?php 
$d->reset();
$sql="select ten$lang as ten,tenkhongdau,id,thumb from #_product_danhmuc where   type='sanpham' and hienthi=1 order by stt asc,id desc";
$d->query($sql);
$danhmuc_nb=$d->result_array();

$d->reset();
$sql_bg_duan = "select photo from #_background where type='bg_duan' limit 0,1";
$d->query($sql_bg_duan);
$bg_duan = $d->fetch_array();

if(count($danhmuc_nb)>0) { ?>
<!--Tags sản phẩm-->
<link href="css/tab.css" type="text/css" rel="stylesheet" />


<div id="duan_noibat"   style="background:url(<?=_upload_hinhanh_l.$bg_duan['photo']?>) repeat-y top center">
<div class="box_container">
  
    <div class="tieude_index2"><span>THIẾT BỊ MÔI TRƯỜNG</span> </div>
    
    <ul id="title_tab" class="ultabs">		
    <?php for($i=0;$i<count($danhmuc_nb);$i++) {  ?>		 
    <li data-id="<?=$danhmuc_nb[$i]['id']?>"><?=$danhmuc_nb[$i]['ten']?></li>
    <?php } ?>
       
    </ul>
    <div style="clear:both"></div>
                
    <div id="content_tabs">               
         
        
          
    </div><!---END #content_tabs-->

</div>

</div>


<?php } ?>