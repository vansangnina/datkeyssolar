<script type="text/javascript">
	$(document).ready(function(e) {
		$('.click_ajax').click(function(){
			if(isEmpty($('#httt').val(), "<?=_chonhinhthucthanhtoan?>"))
			{
				$('#httt').focus();
				return false;
			}
			if(isEmpty($('#hoten').val(), "<?=_nhaphoten?>"))
			{
				$('#hoten').focus();
				return false;
			}
			
			if(isEmpty($('#dienthoai').val(), "<?=_nhapsodienthoai?>"))
			{
				$('#dienthoai').focus();
				return false;
			}
			if(isPhone($('#dienthoai').val(), "<?=_nhapsodienthoai?>"))
			{
				$('#dienthoai').focus();
				return false;
			}
			if(isEmpty($('#thanhpho').val(), "<?=_chontinhthanhpho?>"))
			{
				$('#thanhpho').focus();
				return false;
			}
			if(isEmpty($('#quan').val(), "<?=_chonquanhuyen?>"))
			{
				$('#quan').focus();
				return false;
			}
			if(isEmpty($('#diachi').val(), "<?=_nhapdiachi?>"))
			{
				$('#diachi').focus();
				return false;
			}
			if(isEmpty($('#email_lienhe').val(), "<?=_emailkhonghople?>"))
			{
				$('#email_lienhe').focus();
				return false;
			}
			if(isEmpty($('#noidung').val(), "<?=_nhapnoidung?>"))
			{
				$('#noidung').focus();
				return false;
			}
			frm_order.submit();
		});    
    });
</script>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('#thanhpho').change(function(){
			var id_city = $(this).val();
			$.ajax({
				type:'post',
				url:'ajax/place.php',
				data:{act:'dist',id_city:id_city},
				success:function(rs){
					$('#quan').html(rs);
				}
			});
		});
    });
</script>

<div class="tieude_giua"><div><?=_thanhtoan?></div></div>
<div class="box_container"> 
	<div class="content">
           <table id="giohang" border="0" cellpadding="5px" cellspacing="1px" style="color:#000000; background:#ECEAEA; width:100%;">
    	   <?php
			if(is_array($_SESSION['cart'])){
            	echo '<tr bgcolor="#DC0018" height="25px" style="font-weight:bold;color:#FFF"><td align="center" class="gh_an">STT</td><td style="text-align:center;">'._ten.'</td><td style="text-align:center;" class="gh_an">'._hinhanh.'</td> <td align="center" class="gh_nc">Size</td>  <td align="center" class="gh_nc">'._mausac.'</td> <td align="center">'._gia.'</td><td align="center">'._soluong.'</td><td align="center" class="gh_an">'._tonggia.'</td><td align="center">&nbsp;'._xoa.'&nbsp;</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$size=$_SESSION['cart'][$i]['size'];
					$mausac=$_SESSION['cart'][$i]['mausac'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pmasp=get_code($pid);					
					$pname=get_product_name($pid);
					$pphoto=get_product_photo($pid);
					if($q==0) continue;
			?>
            		<tr bgcolor="#FFFFFF" style="color:#000000;">
                    <td width="4%" align="center" class="gh_an"><?=$i+1?></td>
                   
            		<td width="20%"><?=$pname?></td>
                    <td width="15%" style="text-align:center;" class="gh_an"><img src="<?=_upload_sanpham_l.$pphoto?>" style="max-height:50px;" /></td>
                    <td width="5%" align="center" class="gh_nc"><?=$size?></td>
                    <td width="10%" align="center" class="gh_nc"><span style="height:40px; width:40px; background:<?=$mausac?>; display:block;"></span></td>
                    <td width="17%" align="center"><?=number_format(get_price($pid),0, ',', '.')?>&nbsp;<sup>đ</sup></td>
                    <td width="8%" align="center"><input onblur="update_cart()" type="text" name="product<?=$pid?><?=$size?><?=$mausac?>" value="<?=$q?>" maxlength="5" size="2" style="text-align:center; border:1px solid #F0F0F0" />&nbsp;</td>                    
                    <td width="10%" align="center" class="gh_an"><?=number_format(get_price($pid)*$q,0, ',', '.') ?>&nbsp;<sup>đ</sup></td>
                    <td width="5%" align="center"><a href="javascript:del(<?=$pid?>,'<?=$size?>','<?=$mausac?>')"><img src="images/delete.gif" border="0" /></a></td>
            		</tr>
            <?					
				}
			?>
				<tr><td colspan="9" style="background:#DC0018; padding-left:15px;" >
                <h3 style="color:#ffffff; margin:5px 0px;"><?=_tonggia?>: <?=number_format(get_order_total(),0, ',', '.')?>&nbsp;<sup>đ</sup></h3>
                </td></tr>
			<?
            }
			else{
				echo "<tr><td>"._khongcosanphamtronggiohang."</td>";
			}
		?>
        </table> 
           
     <div class="frm_lienhe">
     <h3 style="margin-top:20px; margin-bottom:10px;"><?=_thongtinkhachhang?></h3>
    <form method="post" name="frm_order" id="frm_order" action="" enctype="multipart/form-data" onsubmit="return check();">
		
        <div class="item_lienhe"><p class="no"><?=_hinhthucthanhtoan?>:<span>*</span></p>
            <select name="httt" id="httt">
                <option value=""><?=_chonhinhthucthanhtoan?></option>
                <?php for($i = 0, $count_hinhthuc_tt = count($hinhthuc_tt); $i < $count_hinhthuc_tt; $i++){ ?>
                    <option value="<?=$hinhthuc_tt[$i]['id']?>"><?=$hinhthuc_tt[$i]['ten']?></option>
                <?php } ?>
            </select>
        </div>
        
    	<div class="item_lienhe"><p class="no"><?=_hovaten?>:<span>*</span></p><input name="hoten" type="text" id="hoten" value="<?php if($_POST['hoten']!='')echo $_POST['hoten'];else echo $info_user['ten']?>" /></div>
        
        <div class="item_lienhe"><p class="no"><?=_dienthoai?>:<span>*</span></p><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="dienthoai" id="dienthoai" value="<?php if($_POST['dienthoai']!='')echo $_POST['dienthoai'];else echo $info_user['dienthoai']?>" type="text"  /></div>
        
        <div class="item_lienhe"><p class="no"><?=_tinhthanhpho?>:<span>*</span></p>
            	<select name="thanhpho" id="thanhpho">
                	<option value=""><?=_chontinhthanhpho?></option>
                	<?php for($i = 0, $count_place_city = count($place_city); $i < $count_place_city; $i++){ ?>
                		<option value="<?=$place_city[$i]['id']?>"><?=$place_city[$i]['ten']?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="item_lienhe"><p class="no"><?=_quanhuyen?>:<span>*</span></p>
            	<select name="quan" id="quan"></select>
            </div>
                    
        <div class="item_lienhe"><p class="no"><?=_diachi?>:<span>*</span></p><input name="diachi" type="text" id="diachi" value="<?php if($_POST['diachi']!='')echo $_POST['diachi'];else echo $info_user['diachi']?>" /></div>
        
        <div class="item_lienhe"><p class="no">E-mail:</p><input name="email" type="text" id="email" value="<?php if($_POST['email']!='')echo $_POST['email'];else echo $info_user['email']?>" /></div>
        
        <div class="item_lienhe"><p class="no"><?=_ghichu2?>:</p><textarea name="noidung"  cols="50" rows="4" ><?=$_POST['noidung']?></textarea></div>

	<div class="clear"></div>
    <div style="text-align: right; padding-top:20px;">
         <input title='<?=_hoantatdathang?>' type="button" class="click_ajax" value="<?=_hoantatdathang?>" />  
    </div>
      </form>
      </div>   
    </div>
</div>
