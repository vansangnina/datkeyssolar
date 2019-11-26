<script type="text/javascript">
	$(document).ready(function(e) {
		$('.click_ajax').click(function(){
			if(isEmpty($('#email_lienhe').val(), "<?=_nhapemail?>"))
			{
				$('#email_lienhe').focus();
				return false;
			}
			if(isEmail($('#email_lienhe').val(), "<?=_emailkhonghople?>"))
			{
				$('#email_lienhe').focus();
				return false;
			}
			if(isEmpty($('#dienthoai_lienhe').val(), "<?=_nhapsodienthoai?>"))
			{
				$('#dienthoai_lienhe').focus();
				return false;
			}
			if(isPhone($('#dienthoai_lienhe').val(), "<?=_sodienthoaikhongdung?>"))
			{
				$('#dienthoai_lienhe').focus();
				return false;
			}
			if(isEmpty($('#capcha').val(), "<?=_nhapmabaove?>"))
			{
				$('#capcha').focus();
				return false;
			}
			$.ajax({
				type:'post',
				url:$(".frm").attr('action'),
				data:$(".frm").serialize(),
				dataType:'json',
				beforeSend: function() {
					$('.thongbao').html('<p><img src="images/loader_p.gif"></p>');  
				},
				error: function(){
					add_popup('<?=_hethongloi?>');
					$(".frm")[0].reset();
				},
				success:function(kq){
					add_popup(kq.thongbao);
					$('#capcha').val('');
					if(kq.nhaplai=='nhaplai')
					{
						$(".frm")[0].reset();
					}
					if(kq.chuyentrang=='chuyentrang')
					{
						setTimeout(function(){location.href="index.html"},3000);
					}
				}
			});
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
<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
<div class="box_container">
   <div class="content">
   		<div class="dangnhap">      
                <div class="tieude_dangnhap"><?=_khachhangchuacotaikhoan?> - <?=_khachhangdadangky?></div>
                <?=$tintuc_detail['noidung']?>
                <div class="item_lienhe">
                    <a href="dang-ky.html" class="btn_dangnhap"><?=_dangky?></a>
                     <a href="dang-nhap.html" class="btn_dangnhap"><?=_dangnhap?></a>
                </div>
                <div class="clear"></div>
        </div><!--.dangnhap-->   
        
   		<div class="dangky">
        	<div class="dangky_frm">
        	<div class="tieude_dangky"><?=_thongtinthanhvien?></div>
            <div class="frm_lienhe">       	
                <form method="post" name="frm" class="frm" action="ajax/user.php" enctype="multipart/form-data">
                	<input name="act" type="hidden" id="act" value="quenmatkhau" />
                    <div class="loicapcha thongbao"></div>

                    <div class="item_lienhe"><p>Email:<span>*</span></p><input name="email_lienhe" type="text" id="email_lienhe" /></div>
                     <div class="item_lienhe"><p><?=_dienthoai?>:<span>*</span></p>
                    <input name="dienthoai_lienhe" type="text" id="dienthoai_lienhe" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" /></div>
                    
                   
                    <div class="item_lienhe"><p class="baove"><?=_mabaove?>:<span>*</span></p>
                    <img src="sources/captcha.php" id="hinh_captcha" style="float:left;">
                            <a href="#reset_capcha" id="reset_capcha" title="<?=_doimakhac?>"><img src="images/refresh.png" alt="reset_capcha" /></a><input style="width:100px;" name="capcha" type="text" id="capcha" /></div>
    
                 
                    <div class="item_lienhe">
                        <input type="button" value="<?=_laymatkhau?>" class="click_ajax" />
                        <input type="button" value="<?=_nhaplai?>" onclick="document.frm.reset();" />
                    </div>
                </form>
            </div><!--.frm_lienhe--> 
            </div><!--.dangky_frm--> 
        </div>  <!--.dangky-->           
   </div><!--.content--> 
</div><!--.box_container--> 