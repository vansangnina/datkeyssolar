
<div id="div_dangkynhantin">


    <div id="dknt">
        <form name="frm_dknt" id="frm_dknt" method="post" action="" >
           
            <input class="txt_input" type="email" name="email_nhantin" id="email_nhantin" placeholder="Nhập email của bạn" required />
            <input type="hidden" id="recaptchaResponse1" name="recaptcha_response1">
            <input type="submit" name="submit_nhantin" id="submit_nhantin" value="<?=_gui?>" />
        </form>
    </div>

	<div class="clear"></div>


</div>
<script>
	$(document).ready(function(){
		$('form#frm_dknt').submit(function(){
			$.ajax({
				 type: "POST",
			          url: "ajax/dangkynhantin.php",
			          data: $('form#frm_dknt').serialize(),
			          success: function(result) { 
			          	//console.log(result);
				        if(result==0){
				         	 alert('Đăng ký email thành công ! ');
				        } else if(result==1){
				          	alert('Email đã đăng ký rồi ! ');
				        } else if(result==2){
				          	alert(' ! Đăng ký không thành công . Vui lòng thử lại ');
				        }
				        //alert('222');
			          }

			});
		});
	});
</script>





