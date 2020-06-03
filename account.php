<!DOCTYPE html>
<?php 
 include('eCommerceAssets/php/server.php');
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
	setcookie("shopping_cart", "", time() - 1800);
  	header("location: login.php");
  }
?>


<html>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KJ8W463');</script>
	<!-- End Google Tag Manager -->
	<meta charset="utf-8">
	<title>Il mio account</title>
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
				<img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"> 
			  	<!-- Company Logo text --> 
			 </div>
	</header>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Benvenuto nel tuo primo accesso! Inserisci i tuoi dati <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="account.php?logout='1'" style="color: red;">Esci</a> </p>
    <?php endif ?>
</div>
	 <form method="post" action="account.php">
  	<?php include('eCommerceAssets/php/errors.php'); ?>
		 
  	<div class="input-group">
  		<label>Nome completo</label>
  		<input type="text" name="name" pattern="[A-Za-z\s]{2,}" maxlength="50">
  	</div>
		 
	<div class="input-group">
  		<label>Cognome</label>
  		<input type="text" name="cognome" pattern="[A-Za-z]{1,}" maxlength="50">
  	</div>
		 
	<div class="input-group">
  		<label>Data di nascita</label>
  		<input type="date" name="data" >
  	</div>
	<div class="input-group">
  		<label>Codice Fiscale</label>
  		<input type="text" name="cod_fisc" pattern="[A-Za-z0-9]{16}" maxlength="16">
  	</div>
		 
	<div class="input-group">
  		<label>Provincia</label>
  		<input type="text" name="provincia" pattern="[A-Za-z\s]{3,}" maxlength="50" title="Inserisci il nome completo della provincia">
  	</div>		 

	<div class="input-group">
  		<label>Città</label>
  		<input type="text" name="citta" pattern="[A-Za-z\s]{1,}" maxlength="50">
  	</div>
		 
	<div class="input-group">
  		<label>Indirizzo</label>
  		<input type="text" name="indirizzo" value="Via " pattern="[A-Za-z0-9\s]{1,}" maxlength="50" title="Non inserie caratteri speciali!">
  	</div>
		 
	<div class="input-group">
  		<label>CAP</label>
  		<input type="text" name="cap" pattern="[0-9]{5}" maxlength="5">
  	</div>
		 
	<div class="input-group">
  		<label>Telefono</label>
  		<input type="text" name="telefono" pattern="[0-9]{9}" maxlength="9" title="Non inserie caratteri speciali!">
  	</div>
		 
  	<div class="input-group">
  		<button type="submit" class="btn" name="subit_data">Inserisci</button>		
  	</div>
		 <div class="input-group">
		 <input type="reset">
		 </div>
  </form>
	<div>
		<a href="https://www.iubenda.com/privacy-policy/13672304" class="iubenda-black iubenda-embed" title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
	</div>
</body>
</html>