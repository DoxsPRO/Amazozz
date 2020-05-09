<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Il mio account</title>
	<link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
</head>
<body>

<header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <a href="index.html"><img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"> </a>
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="index.html" title="Home">Home</a>
		<a href="" title="Cart">Carrello</a></div>
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
  		<label>Nome</label>
  		<input type="text" name="name">
  	</div>
		 
	<div class="input-group">
  		<label>Cognome</label>
  		<input type="text" name="cognome">
  	</div>
		 
	<div class="input-group">
  		<label>Data di nascita</label>
  		<input type="date" name="data" >
  	</div>
	<div class="input-group">
  		<label>Codice Fiscale</label>
  		<input type="text" name="cod_fisc" >
  	</div>
		 
	<div class="input-group">
  		<label>Citta'</label>
  		<input type="text" name="citta" >
  	</div>
		 
	<div class="input-group">
  		<label>Indirizzo</label>
  		<input type="text" name="indirizzo" >
  	</div>
		 
	<div class="input-group">
  		<label>CAP</label>
  		<input type="number" name="cap" >
  	</div>
		 
	<div class="input-group">
  		<label>Telefono</label>
  		<input type="number" name="telefono" >
  	</div>
		 
  	<div class="input-group">
  		<button type="submit" class="btn" name="subit_data">Inserisci</button>		
  	</div>
		 <div class="input-group">
		 <input type="reset">
		 </div>
  </form>
		
</body>
</html>