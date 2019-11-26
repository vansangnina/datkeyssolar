<?php
function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
		
function hinhthucgiaohang($i=0)
	{
		$sql="select * from table_hinhthucgiaohang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="hinhthucgiaohang" name="hinhthucgiaohang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<?php

	$d->reset();
	$sql_chitietdonhang = "select * from #_chitietdonhang where hienthi=1 and madonhang='".$item['madonhang']."' order by stt,id desc";
	$d->query($sql_chitietdonhang);
	$chitietdonhang = $d->result_array();

	$tongtiendonhang = 0;
?>
<script type="text/javascript">

function TreeFilterChanged2(){		
	$('#validate').submit();		
}
function update(id){

	if(id>0){
		var sl=$('#product'+id).val();
		if(sl>0){
			$('#ajaxloader'+id).css('display', 'block');
				
			jQuery.ajax({
				type: 'POST',
				url: "ajax.php?do=cart&act=update",
				data: {'id':id, 'sl':sl},				
				success: function(data) {	
					$('#ajaxloader'+id).css('display', 'none');	
					var getData = $.parseJSON(data);
					$('#id_price'+id).html(addCommas(getData.thanhtien)+'&nbsp;VNĐ');
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
			});			
		}else alert('Số lượng phải lớn hơn 0');
	}
}

function del(id,id_order){
	if(id>0){				
		jQuery.ajax({
			type: 'POST',
			url: "ajax.php?do=cart&act=delete",
			data: {'id':id,'id_order':id_order},			
			success: function(data) {										
					var getData = $.parseJSON(data);
					$('#productct'+id).css('display', 'none');	
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;VNĐ');
				}
		});
	}
}
</script>  


<script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("thanhpho_item");
		window.location ="index.php?com=order&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&thanhpho_item="+a.value;	
		return true;
	}
		function select_onchange1()
	{				
		var a=document.getElementById("thanhpho_item");
		var b=document.getElementById("thanhpho");
		window.location ="index.php?com=order&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&thanhpho_item="+a.value+"&thanhpho="+b.value;	
		return true;
	}
</script>

<?php
function get_httt()
	{
		$sql="select * from table_httt";
		$stmt=mysql_query($sql);
		$str='
			<select id="httt" name="httt" class="main_select">
			<option>Hình thức thanh toán</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["httt"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
function get_thanhpho_item()
	{
		$sql="select * from table_place_city order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="thanhpho_item" name="thanhpho_item" onchange="select_onchange()" class="main_select select_danhmuc" >
			<option>Tỉnh/Thành phố</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["thanhpho_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

function get_thanhpho()
	{
		$sql="select * from table_place_dist where id_city=".$_REQUEST['thanhpho_item']."  order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="thanhpho" name="thanhpho" class="main_select select_danhmuc" onchange="select_onchange1()">
			<option>Quận/Huyện</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["thanhpho"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
function get_phuong()
	{
		$sql="select * from table_place_ward where id_dist=".$_REQUEST['thanhpho']."  order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="phuong" name="phuong" class="main_select select_danhmuc" >
			<option>Phường/Xã</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["phuong"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}	
	


?>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	 <li><a href="index.php?com=order&act=mam"><span>Đơn hàng</span></a></li>
             <li class="current"><a href="#" onclick="return false;">Xem và sửa đơn hàng</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=order&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin người mua</h6>
		</div>
		
        <div class="formRow">
			<label>Hình thức thanh toán</label>
			<div class="formRight">
            <?=get_httt();?>
			</div>
			<div class="clear"></div>
		</div>
        
		<div class="formRow">
			<label>Mã đơn hàng</label>
			<div class="formRight">
            <input type="text" name="madonhang" title="Mã đơn hàng" style="width:80% !important" readonly="readonly" id="madonhang" class="tipS validate[required]" value="<?=@$item['madonhang']?>" />  
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Họ tên</label>
			<div class="formRight">
             <input type="text" name="hoten" title="Họ tên khách hàng" style="width:80% !important"  id="hoten" class="tipS validate[required] read" value="<?=@$item['hoten']?>" />
			</div>
			<div class="clear"></div>
		</div>	
        
         <div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
             <input type="text" name="dienthoai" title="Số điện thoại khách hàng" style="width:80% !important"  id="dienthoai" class="tipS validate[required] read" value="<?=@$item['dienthoai']?>" /> 
			</div>
			<div class="clear"></div>
		</div>		        
        
         <div class="formRow">
			<label>Email</label>
			<div class="formRight">
             <input type="text" name="email" title="Email khách hàng" style="width:80% !important"  id="email" class="tipS" value="<?=@$item['email']?>" />
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
             <input type="text" name="diachi" title="Địa chỉ khách hàng" style="width:30% !important" readonly="readonly" id="diachi" class="tipS validate[required] read" value="<?=@$item['diachi']?>" /> - <?=get_thanhpho_item();?> - <?=get_thanhpho();?>  <!-- <?php //get_phuong();?>-->
			</div>
			<div class="clear"></div>
		</div>	
        
         <div class="formRow">
			<label>Yêu cầu thêm</label>
			<div class="formRight">
            <textarea rows="8"  cols="" title="Yêu cầu thêm" class="tipS read" name="noidung" id="noidung"><?=@$item['noidung']?></textarea>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Phí thêm</label>
			<div class="formRight">
             <input type="text" name="phithem" title="Cộng thêm phí giao hang hoặc - khuyến mãi cho khách hang(Nếu khuyến mãi khách hàng thì thêm dấu -)" style="width:80% !important"  id="phithem" class="tipS" value="<?=@$item['phithem']?>" />
			</div>
			<div class="clear"></div>
		</div>	        
         
        </div>
		<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Chi tiết đơn hàng</h6>
		</div>
      
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
       
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">STT</a></td>      
        <td class="sortCol"><div>Tên sản phẩm<span></span></div></td>
        <td width="150">Hình ảnh</td>
        <td width="100">Giá cũ</td>
        <td width="100">Giá bán</td>
        <td width="100">Số lượng</td>
        <td width="150">Thành tiền</td>
        <td width="150">Thao tác</td>
      </tr>
    </thead> 
     <tfoot>
      <tr>
        <td colspan="6"><div class="pagination">Tổng tiền</div></td>
       
        <td><div class="pagination" id="sum_price"><?=number_format($item['tonggia'],0, ',', '.')?>&nbsp;vnđ</div></td>
        <td></td>
      </tr>
    </tfoot>   
    <tbody>
        <?php      
				$tongtien=0;          
				for($i=0,$count_donhang=count($chitietdonhang);$i<$count_donhang;$i++){	
				$tongtien += $chitietdonhang[$i]['gia']*$chitietdonhang[$i]['soluong'];				
		?>
        <tr id="productct<?=$chitietdonhang[$i]['id']?>">
          <td><?=$i+1?></td>
          <td><?=$chitietdonhang[$i]['ten']?></td>
           <td align="center"><img src="<?=_upload_sanpham.$chitietdonhang[$i]['photo']?>" height="70"  /></td>
          <td align="center"><?=number_format($chitietdonhang[$i]['giacu'],0, ',', '.')?>&nbsp;VNĐ</td>
          <td align="center">
		  	<?=number_format($chitietdonhang[$i]['gia'],0, ',', '.').'&nbsp;VNĐ';?>
		  </td>
          <td align="center"><input type="text" class="tipS" style="width:50px; text-align:center" original-title="Nhập số lượng sản phẩm" maxlength="3" value="<?=$chitietdonhang[$i]['soluong']?>" onchange="update(<?=$chitietdonhang[$i]['id']?>)" id="product<?=$chitietdonhang[$i]['id']?>">
          <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$chitietdonhang[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            &nbsp;</td>
          <td align="center" id="id_price<?=$chitietdonhang[$i]['id']?>">
		  	<?=number_format($chitietdonhang[$i]['gia']*$chitietdonhang[$i]['soluong'],0, ',', '.')?>&nbsp;VNĐ

          </td>
          <td class="actBtns"><a class="smallButton tipS" original-title="Xóa sản phẩm" href="javascript:del(<?=$chitietdonhang[$i]['id']?>,<?=$item['id']?>)"><img src="./images/icons/dark/close.png" alt=""></a></td>
        </tr>
        <?php } ?>
     </tbody>
  </table>
      
        
        </div>
        
		<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin thêm</h6>
		</div>
        
		<div class="formRow">
			<label>Mô tả ngắn:</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Viết ghi chú cho đơn hàng" class="tipS" name="ghichu" id="ghichu"><?=@$item['ghichu']?></textarea>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<label>Tình trạng</label>
			<div class="formRight">
            	<div class="selector">
					<?=tinhtrang($item['tinhtrang'])?>
                </div>
			</div>
			<div class="clear"></div>
		</div>	
        
        <div class="formRow">
			<div class="formRight">	     
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Cập nhật" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>
   

</form>  
