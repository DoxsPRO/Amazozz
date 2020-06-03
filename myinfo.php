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
<meta charset="utf-8">
	<title>Il mio account</title>
	<link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
	<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
</head>

<body>
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
		<a href="account.php?logout='1'" style="color: red;" title="sessID">Esci</a>
		<a title=""></a>
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
    	<p>Dati salvati correttamente! <strong>
			<?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="account.php?logout='1'" style="color: red;">Esci</a> </p>
    <?php endif ?>
	<form>
		<div class="input-group">
  			<i class="fa fa-user-circle" aria-hidden="true"></i><?php echo " ".$_SESSION['name']." ".$_SESSION['cognome'];?>
		</div>
		<div class="input-group">
  			<i class="fa fa-birthday-cake" aria-hidden="true"></i><?php echo " ".$_SESSION['data']; ?>
		</div>	
		<div class="input-group">
  			<i class="fa fa-id-card-o" aria-hidden="true"></i><?php echo " ".$_SESSION['cod_fisc']; ?>
		</div>
		<div class="input-group">
  			<i class="fa fa-home" aria-hidden="true"></i></i><?php echo " ".$_SESSION['citta']." (".$_SESSION['cap'].")".", ".$_SESSION['provincia']; ?>
		</div>
		<div class="input-group">
  			<i class="fa fa-map-marker" aria-hidden="true"></i><?php echo " ".$_SESSION['indirizzo']; ?>
		</div>
		<div class="input-group">
  			<i class="fa fa-phone" aria-hidden="true"></i><?php echo " ".$_SESSION['telefono']; ?>
		</div>
		  	<div class="input-group">
  		<button type="submit" class="btn" name="edit">Modifica dati</button>
  		</div>
		</div>
	</form>
			<div><a href="https://www.iubenda.com/privacy-policy/13672304" class="iubenda-black iubenda-embed" title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
	</div>
</body>
</html>