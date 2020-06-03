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
  <title>Registrati</title>
	<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
	<script>var __adobewebfontsappname__="dreamweaver"</script>
	<script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
	<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
</head>
<body>
  <header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <a href="index.html"><img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"> </a>
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="index.html" title="Home">Home</a>
		<a href="login.php" title="Login">Accedi</a>
		<a href="" title=""></a>
	  </div>
	</header> 
  <form method="post" action="register.php">
  	<?php include('eCommerceAssets/php/errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" pattern="[A-Za-z0-9]{2,}" maxlength="20" title="Deve contenere almeno una lettera, minimo 2 massimo 20 caratteri">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" minlength="8" maxlength="20" title="Deve essere minimo 8 e massimo 20 caratteri">
  	</div>
  	<div class="input-group">
  	  <label>Conferma password</label>
  	  <input type="password" name="password_2" minlength="8" maxlength="20" title="Deve corrispondere con la password inserita prima!">
  	</div>
	  <div class="input-group">
  	  <label>Token</label>
  	  <input type="password" name="token" value="2O3W7HKjgTIH" title="Devi possedere il token per poterti registrare!">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Registrati</button>
  	</div>
  	<p>
  		Hai già un account? <a href="login.php">Accedi</a>
  	</p>
  </form>
	  	<div><a href="https://www.iubenda.com/privacy-policy/13672304" class="iubenda-black iubenda-embed" title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
	</div>
</body>
</html>