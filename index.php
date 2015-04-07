<?php
	error_reporting(E_ALL);
	ini_set("display_error", 1);

	session_start();

	require("facebook-php-sdk-v4-4.0-dev/autoload.php");

	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookSession;
	use Facebook\GraphUser;

	const APPID = "961825047190931";
    const APPSECRET = "56ba2d0b4948bcee61fc3d9c00ce6525";

    FacebookSession::setDefaultApplication(APPID, APPSECRET);

	$helper = new FacebookRedirectLoginHelper("https://esgiappfb.herokuapp.com/");

	// If var session exists && $_SESSION['fb_token'] exists -> create user from fb session
	if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
		$session = new FacebookSession($_SESSION['fb_token']);
	} else { // else print connexion's link
		$session = $helper->getSessionFromRedirect();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page d'accueil</title>
	<!-- Bootstrap CSS using CDN -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '<?php echo APPID; ?>',
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
	<div class="container">
		<h1>App FB ESGI</h1>

		<div
			class="fb-like"
			data-share="true"
			data-width="450"
			data-show-faces="true">
		</div>
		<br>
	    <?php
		    if($session){
		        $_SESSION['fb_token'] = (string) $session->getAccessToken();

			    // N.B. : The 3 next statements can be executed on one line instead of 3
			    $request_user = new FacebookRequest($session, "GET", "/me");
			    $request_user_execute = $request_user->execute();
			    $user = $request_user_execute->getGraphObject(GraphUser::className());
			    // for a user's photos : /me/photos/uploaded and then getGraphObject(...)->AsArray()

			    echo "Bonjour " . $user->getName();

		    } else {
			    $loginUrl = $helper->getLoginUrl();
			    echo "<a href=" . $loginUrl . ">Connect with Facebook</a>";
		    }
	    ?>
	</div>
	<!-- Bootstrap JS using CDN -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>