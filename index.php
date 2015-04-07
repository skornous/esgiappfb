<?php
    const APPID = "961825047190931";
    const APPSECRET = "56ba2d0b4948bcee61fc3d9c00ce6525";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page d'accueil</title>
</head>
<body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : <?php echo APPID; ?>,
                xfbml      : true,
                version    : 'v2.3'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
	<h1>App FB ESGI</h1>

    <div
        class="fb-like"
        data-share="true"
        data-width="450"
        data-show-faces="true">
    </div>
</body>
</html>