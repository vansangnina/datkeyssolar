
<style>
	div.chat_facebook
	{
		position:fixed;
		right:0;
		bottom:0;
		width:250px;
		z-index:777777;
	}
	div.tieude_chat
	{
		background: #3B5998;
		color: #fff;
		width: 50%;
		padding: 3px 7px;
		font-size: 15px;
		cursor:pointer;
	}
	@media screen and (max-width: 800px) {
		div.chat_facebook
		{
			position:fixed;
			right:-110px;
			bottom:-300px;
			width:250px;
			z-index:777777;
		}
	}
</style>


<div class="chat_facebook"><div class="tieude_chat">Facebook chat</div>

    <div class="fb-page" data-href="<?=$company['fanpage']?>" data-tabs="messages" data-height="300px" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$company['fanpage']?>" class="fb-xfbml-parse-ignore"><a href="<?=$company['fanpage']?>"><?=$company['fanpage']?></a></blockquote></div>
    
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
		$('.chat_facebook').animate({bottom:-300},500).animate({right:-110},300);
        $('.tieude_chat').click(function(){
			if($('.chat_facebook').css('right')=='0px')
			{
				$('.chat_facebook').animate({bottom:-300},500).animate({right:-110},300);
			}
			else
			{
				$('.chat_facebook').animate({right:0},300).animate({bottom:0},500);
			}
			$.ajax({
				url:'ajax/tao_session.php',
				success:function(kq){
					console.log(kq);
				}
			});
		});
    });
</script>

