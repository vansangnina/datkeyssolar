<?php
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid'],$_REQUEST['size'],$_REQUEST['mausac']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
	else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$size=$_SESSION['cart'][$i]['size'];
			$mausac=$_SESSION['cart'][$i]['mausac'];
			$q=intval($_REQUEST['product'.$pid.$size.$mausac]);
			
			if($q>0 && $q<=99999){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 99999';
			}
		}
	}
?>


<script type="text/javascript">
	function del(pid,size,mausac){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.size.value=size;
			document.form1.mausac.value=mausac;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}
	function quaylai()
	{
		history.go(-1);
	}
	
	function doEnter_update(evt){
		var key;
		if(evt.keyCode == 13 || evt.which == 13){
			update_cart(evt);
		}
	}
</script>

<div class="box_container"> 
	<div class="tieude_giua"><div><?=_giohang?></div></div>
	<div class="content">
    	<div class="left_gh">
        	<div class="td_gh"><?=_thongtingiohang?></div>
			<form name="form1" method="post">
			<input type="hidden" name="pid" />
            <input type="hidden" name="size" />
            <input type="hidden" name="mausac" />
			<input type="hidden" name="command" /> 
				<table id="giohang" border="0" cellpadding="5px" cellspacing="1px" style="color:#000; background:#dadada; width:100%; font-size:13px;">
    	   <?php
			if(is_array($_SESSION['cart'])){
            	echo '<tr bgcolor="#F0F0F0" height="55px"><td align="center">'._xoa.'</td><td style="text-align:center;">'._hinhanh.'</td><td style="text-align:center;">'._ten.'</td> <td align="center">'._dongia.'</td><td align="center">'._soluong.'</td> <td align="center" class="gh_an">'._thanhtien.'</td></tr>';
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
                    <td width="10%" align="center"><a style="text-decoration: none;color: #5F7ABB;" href="javascript:del(<?=$pid?>,'<?=$size?>','<?=$mausac?>')"><?=_xoa?></a></td>
                   
            		<td width="15%" align="center"><img src="<?=_upload_sanpham_l.$pphoto?>" style="max-height:50px; margin:5px 0;" /></td>
                    <td width="25%" style="padding:0px 10px; box-sizing:border-box;"><?=$pname?></td>
                    <td width="15%" align="center"><?=number_format(get_price($pid),0, ',', '.')?>&nbsp;<sup>đ</sup></td>
                    <td width="10%" align="center"><input onblur="update_cart()" onKeyPress="doEnter_update(event)"  type="text" name="product<?=$pid?><?=$size?><?=$mausac?>" value="<?=$q?>" maxlength="5" size="2" style="text-align:center; border:1px solid #d2d2d2; padding:3px 0;" />&nbsp;</td>                    
                    <td width="15%" align="center" class="gh_an"><?=number_format(get_price($pid)*$q,0, ',', '.') ?>&nbsp;<sup>đ</sup></td>
            		</tr>
            <?php					
				}
			?>
				<tr>
                	<td colspan="6" style="background:#F0F0F0; height:55px; text-align:right; padding-right:10px;"><?=_tongtien?>: <?=number_format(get_order_total(),0, ',', '.')?>&nbsp;<sup>đ</sup></td>
                	
                </tr>
			<?php
            }
			else{
				echo "<tr><td>"._khongcosanphamtronggiohang."</td>";
			}
		?>
        </table>	
        <div class="clear" style="height:40px;"></div>
  </form>
  </div><!--.left_gh-->
  
  
  <div class="right_gh">
  		<div class="td_gh"><?=_thongtinkhachhang?></div>
        
     <div class="frm_lienhe">
    <form method="post" name="frm_order" id="frm_order" action="" enctype="multipart/form-data" onsubmit="return check();">
    
    	<div class="item_lienhe"><p class="no"><?=_htthanhtoan?>:<span>*</span></p>
        <select name="httt" id="httt">
            <option value=""><?=_chonhinhthucthanhtoan?></option>
            <?php for($i=0,$count_get_httt=count($get_httt);$i<$count_get_httt;$i++) { ?>
            <option value="<?=$get_httt[$i]['id']?>"><?=$get_httt[$i]['ten']?></option>
            <?php } ?>
        </select></div>
        
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
            <select name="quan" id="quan">
            	<option><?=_chonquanhuyen?></option>
            </select>
        </div>
        
         <div class="item_lienhe"><p class="no"><?=_diachi?>:<span>*</span></p><input name="diachi" type="text" id="diachi" value="<?php if($_POST['diachi']!='')echo $_POST['diachi'];else echo $info_user['diachi']?>" /></div>

        <div class="item_lienhe"><p class="no">E-mail:</p><input name="email" type="text" id="email" value="<?php if($_POST['email']!='')echo $_POST['email'];else echo $info_user['email']?>" /></div>
        
        <div class="item_lienhe"><p class="no"><?=_ghichu2?>:</p><textarea name="noidung"  cols="50" rows="4" ><?=$_POST['noidung']?></textarea></div>
      </form>
      </div>
      
      <div style="text-align:center;">
        <input class="btn button click_ajax" type="button" value="<?=_tieptucmuahang?>" onclick="window.location.href='index.html'" style=" border:1px solid #000; color:#000; background:#fff; padding:6px 25px; border-radius:0;" />
         <input title='<?=_dathang?>' type="button" class="click_ajax click_ajax2" value="<?=_dathang?>" style="background:#000; color:#fff; border:1px solid#000;padding:6px 25px; border-radius:0; margin-left:12px;" />	
        </div>
  </div>
</div>
</div>

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
		
		$('.click_ajax2').click(function(){
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