<!doctype html>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }

 if (isset($_GET['logout'])) {
  	session_destroy();
	unset($_COOKIE['info']);
  	unset($_SESSION['username']);
	setcookie("shopping_cart", "", time() - 1800);
  	header("location: index.html");
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		<a href="indexLog.php"><img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100">
		</a>
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="indexLog.php" title="Home">Home</a>
		<a href="checkoutPage.php" title="Cart">Carrello</a>
		<a href="storicoOrdini.php" title="Oridini">Ordini</a>
		<a href="account.php?logout='1'" style="color: red;" title="sessID">Esci</a>
		<a title=""></a>
		</div>
	</header> 
<div class="content" style="font-size: 20px;">
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
		<div class="input-group">
			<label>
  				<i class="fa fa-user-circle" aria-hidden="true"></i><?php echo " ".$_SESSION['name']." ".$_SESSION['cognome'];?>
			</label>
		</div>
		<div class="input-group">
			<label>
  				<i class="fa fa-birthday-cake" aria-hidden="true"></i><?php echo " ".$_SESSION['data']; ?>
			</label>
		</div>	
		<div class="input-group">
			<label>
  				<i class="fa fa-id-card-o" aria-hidden="true"></i><?php echo " ".$_SESSION['cod_fisc']; ?>
			</label>
		</div>
		<div class="input-group">
			<label>
  				<i class="fa fa-home" aria-hidden="true"></i></i><?php echo " ".$_SESSION['citta']." (".$_SESSION['cap'].")".", ".$_SESSION['provincia']; ?>
			</label>
		</div>
		<div class="input-group">
			<label>
  				<i class="fa fa-map-marker" aria-hidden="true"></i><?php echo " ".$_SESSION['indirizzo']; ?>
			</label>
		</div>
		<div class="input-group">
			<label>
  				<i class="fa fa-phone" aria-hidden="true"></i><?php echo " ".$_SESSION['telefono']; ?>
			</label>
		</div>
		<form style="border: 0px;">
			<div class="input-group">
  				<button type="submit" class="btn" name="edit">Modifica dati</button>
  			</div>
		</form>
	</div>
		<div>
			<a href="https://www.iubenda.com/privacy-policy/13672304" class="iubenda-black iubenda-embed" title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
		</div>
</body>
</html>