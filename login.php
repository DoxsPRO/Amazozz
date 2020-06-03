<?php 
	include('eCommerceAssets/php/server.php');

	if (isset($_SESSION['username'])) {
  		$_SESSION['msg'] = "Hai già effettuato l'accesso!";
  		header('location: indexLog.php');
  	}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KJ8W463');</script>
	<!-- End Google Tag Manager -->
  	<title>Accedi</title>
	<meta charset="utf-8">
  	<link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
	<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
	<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJ8W463"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> 
		<a href="index.html"><img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"</a>
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="index.html" title="Home">Home</a>
		<a href="register.php" title="Registrati">Registrati</a>
		<a title=""></a>
	 </div>
	</header>
  <form method="post" action="login.php">
	  
  	<?php include('eCommerceAssets/php/errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" pattern="[A-Za-z0-9]{2,}" maxlength="20">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" minlength="8" maxlength="20">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Accedi</button>
  	</div>
  	<p>
  		Non hai un account? <a href="register.php">Registrati</a>
  	</p>
  </form>
		<div><a href="https://www.iubenda.com/privacy-policy/13672304" class="iubenda-black iubenda-embed" title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
	</div>
</body>
</html>