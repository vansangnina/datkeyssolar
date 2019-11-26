<script type="text/javascript">
	$(document).ready(function(e) {
		$('.click_ajax').click(function(){
			/*if(isEmpty($('#ten_lienhe').val(), "<?=_nhaphoten?>"))
			{
				$('#ten_lienhe').focus();
				return false;
			}
			
			if(isEmpty($('#dienthoai_lienhe').val(), "<?=_nhapsodienthoai?>"))
			{
				$('#dienthoai_lienhe').focus();
				return false;
			}
			if(isPhone($('#dienthoai_lienhe').val(), "<?=_nhapsodienthoai?>"))
			{
				$('#dienthoai_lienhe').focus();
				return false;
			}
			if(isEmpty($('#email_lienhe').val(), "<?=_emailkhonghople?>"))
			{
				$('#email_lienhe').focus();
				return false;
			}
			if(isEmail($('#email_lienhe').val(), "<?=_emailkhonghople?>"))
			{
				$('#email_lienhe').focus();
				return false;
			}
			
			if(isEmpty($('#noidung_lienhe').val(), "<?=_nhapnoidung?>"))
			{
				$('#noidung_lienhe').focus();
				return false;
			}*/
		});    
    });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#reset_capcha").click(function() {
			$("#hinh_captcha").attr("src", "sources/captcha.php?"+Math.random());
			return false;
		});
	});
</script>
<div class="box_container">
   <div class="content">
   		<div class="tt_lh">
        <?=$company_contact['noidung'];?>
         
		
        </div> 
        
        <div class="frm_lienhe_index">
        <form method="post" name="frm" class="frm" action="" enctype="multipart/form-data">
            <div class="loicapcha thongbao"></div>
            
            <div class="col_w50">
            	<input name="ten_lienhe" type="text" id="ten_lienhe" class="input_lh" placeholder="<?=_hovaten?> (*)" required />
            </div>
            <div class="col_w50">
            
            	<input name="dienthoai_lienhe" type="text" id="dienthoai_lienhe" class="input_lh" placeholder="<?=_dienthoai?> (*)" required />
            </div>
            <div class="col_w50">
            	 <input name="email_lienhe" type="text" id="email_lienhe" class="input_lh"  placeholder="Email" required />
            </div>
            <div class="col_w50">
            	<input name="diachi_lienhe" type="text" id="dia_lienhe" class="input_lh" placeholder="Địa chỉ" required />
            </div>
           <div style="width: 100%;padding: 10px;">
           		<textarea name="noidung_lienhe" id="noidung_lienhe" class="input_lh"  rows="3" placeholder="<?=_noidung?>"></textarea>
           </div>
           <div style="width: 200px;margin: 0 auto;"><input type="hidden" id="recaptchaResponse" name="recaptcha_response"></div>
            <div class="clear"></div>

			<input type="submit" value="<?=_gui?>" class="click_ajax" /> 
        </form>
    </div><!--.frm_lienhe--> 
        
        
       <?=$company['map'];?>

   </div><!--.content--> 
</div><!--.box_container--> 
