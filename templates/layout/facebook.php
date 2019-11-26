
<link rel="stylesheet" id="messenger-css" href="facebook/messenger.css" type="text/css" media="all">
<div class="drag-wrapper">
   <div data-drag="data-drag" class="thing" style="transform: translate(1190px, 20px);">
      <a class="drag_messenger_button toby_tooltip" title="Chat Facebook" data-toggle="tooltip">
         <div class="circle facebook-messenger-avatar">
            <img class="facebook-messenger-avatar" src="facebook/mess.png">
         </div>
      </a>
      <div class="content" style="display: none; max-height: 563px;">
         <div class="inside" id="fbmessenger_content">
            <div class="arrow"></div>
            <ul class="ChatLog" id="chat_text">
               <li class="ChatLog__entry">
                  <img class="ChatLog__avatar" src="<?=_upload_hinhanh_l.$company['favicon']?>" />
                  <p class="ChatLog__message">
                     Chào bạn!
                     <time class="ChatLog__timestamp">1 minutes ago</time>
                  </p>
               </li>
               <li class="ChatLog__entry">
                  <img class="ChatLog__avatar" src="<?=_upload_hinhanh_l.$company['favicon']?>" />
                  <p class="ChatLog__message">
                    Chúng tôi có thể giúp gì cho bạn.
                     <time class="ChatLog__timestamp">2 minutes ago</time>
                  </p>
               </li>
               <li class="Chat_button" id="Chat_button">  
                 
               </li>
            </ul>
           <div style="margin-top: 100px;">
              
           </div>
            <div class="fb-page" data-href="<?=$company['fanpage']?>" data-tabs="messages" data-width="310" data-height="270" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="<?=$company['fanpage']?>">Facebook</a></blockquote></div>
         </div>
      </div>
   </div>
   <div class="magnet-zone">
      <div class="magnet"></div>
   </div>
</div>
<div id="messenger_bg"> </div>
<div class="zalo_mes">
   <a href="https://zalo.me/<?=preg_replace('/[^0-9]/','',$company['dienthoai']);?>"><img src="facebook/zalo1.png" alt="" title="Zalo"></a>
</div>
<style>
   .zalo_mes{position: fixed;top: 40%;z-index: 99;right: 5px;}
</style>

<script type="text/javascript" src="facebook/popup.js"></script>
<script type="text/javascript" src="facebook/jquery.event.move.js"></script>
<script type="text/javascript" src="facebook/rebound.min.js"></script>
<script type="text/javascript" src="facebook/index.js"></script>
