<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1440200485995919',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
function loginFb(){
FB.login(function (response) {
        if (response.authResponse) {
            FB.api('/me?fields=email,name,id', function (response) {
                $.ajax({
					data:{id_facebook:response.id,email:response.email,ten:response.name,act:'login_fb'},
					type:'post',
					dataType:'json',
					error:function(e){
						//console.log(e);
					},
					url:'ajax/user.php',
					success:function(kq){						
						add_popup(kq.thongbao);
						if(kq.nhaplai=='nhaplai')
						{
							setTimeout(function(){location.href="http://<?=$config_url?>"},3000);
						}
						return false;
					}
				})
            });
        } else {
            alert("<?=_hethongloi?>");
        }
    }, {scope: 'email,user_likes'});
    return false;
	}
	
function logout()
{
    gapi.auth.signOut();
    location.reload();
}
function login_gg() 
{
  var myParams = {
    'clientid' : '95080528506-39v8ua32lmkb4nta5goqf9bgf003fqma.apps.googleusercontent.com',
    'cookiepolicy' : 'single_host_origin',
    'callback' : 'loginCallback',
    'approvalprompt':'force',
    'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
  };
  gapi.auth.signIn(myParams);
}
 
function loginCallback(result)
{
    if(result['status']['signed_in'])
    {
        var request = gapi.client.plus.people.get(
        {
            'userId': 'me'
        });
        request.execute(function (resp)
        {
            var email = '';
            if(resp['emails'])
            {
                for(i = 0; i < resp['emails'].length; i++)
                {
                    if(resp['emails'][i]['type'] == 'account')
                    {
                        email = resp['emails'][i]['value'];
                    }
                }
            }
			
            var str = "Name:" + resp['displayName'] + "<br>";
            str += "Image:" + resp['image']['url'] + "<br>";
            str += "<img src='" + resp['image']['url'] + "' /><br>";
 
            str += "URL:" + resp['url'] + "<br>";
            str += "Email:" + email + "<br>";
		
			$.ajax({
				data:{email:email,name:resp['displayName'],act:'login_gg'},
				type:'post',
				dataType:'json',
				error:function(e){
					console.log(e);
				},
				url:'ajax/user.php',
				success:function(kq){
					add_popup(kq.thongbao);
					if(kq.nhaplai=='nhaplai')
					{
						setTimeout(function(){location.href="http://<?=$config_url?>"},3000);
					}
					return false;
				}
			})
			return false;
        });
    }
}
function onLoadCallback()
{
    gapi.client.setApiKey('');
    gapi.client.load('plus', 'v1',function(){});
}
 (function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();

	</script>
<a class="fancybox get-stt-login" href="#msg-hidden"></a>
<div class="hide">
    <div id="msg-hidden">
    
    <div class="alert alert-success" role="alert"></div>
    </div>

</div>