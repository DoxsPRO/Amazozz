<?php 
  include('eCommerceAssets/php/server.php');

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Devi effettuare prima l'accesso!";
  	header('location: login.php');
  }
	
	if (!isset($_COOKIE["shopping_cart"])) {
  		$_SESSION['msg'] = "Devi comprare prima qualcosa!";
  		header('location: indexLog.php');
  }
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pagamento</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/checkoutStyle.css">
		<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
		<script>var __adobewebfontsappname__="dreamweaver"</script>
		<script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
	</head>

	<body>
		<div class="row">
		  <div class="col-75">
			<div class="container">
			  <form method="post" action="checkoutPage.php">

				<div class="row">
				  <div class="col-50">
					<h3>Dati spedizione</h3>
					<label for="fname"><i class="fa fa-user"></i> Nome</label>
					<input type="text" id="fname" name="fullname" value="<?php echo $_SESSION['name'].' '.$_SESSION['cognome'];?>" pattern="[A-Za-z\s]{2,}" maxlength="100" title="Inserisci il tuo nome completo">
					  
					<label for="email"><i class="fa fa-envelope"></i> Email</label>
					<input type="text" id="email" name="email" value="<?php echo $_SESSION['email'];?>" >
					  
					<label for="fname"><i class="fa fa-phone"></i> Telefono</label>
					<input type="text" id="tel" name="phone" value="<?php echo $_SESSION['telefono'];?>" pattern="[0-9]{9}" maxlength="9" title="Non inserie caratteri speciali!">
					  
					<label for="adr"><i class="fa fa-address-card-o"></i> Indirizzo</label>
					<input type="text" id="adr" name="address" value="<?php print $_SESSION['indirizzo'];?>" pattern="[A-Za-z0-9\s]{5,}" maxlength="50" title="Non inserie caratteri speciali!">
					  
					<label for="city"><i class="fa fa-institution"></i> Città</label>
					<input type="text" id="city" name="city" value="<?php echo $_SESSION['citta'];?>" pattern="[A-Za-z\s]{3,}" maxlength="50" title="Non inserie caratteri speciali!">

					<div class="row">
					  <div class="col-50">
						<label for="state">Provincia</label>
						<input type="text" id="state" name="state" value="<?php echo $_SESSION['provincia'];?>" pattern="[A-Za-z\s]{3,}" maxlength="50" title="Inserisci il nome completo della provincia">
					  </div>
					  <div class="col-50">
						<label for="zip">CAP</label>
						<input type="text" id="zip" name="zip" value="<?php echo $_SESSION['cap']?>" pattern="[0-9]{5}" maxlength="5">
					  </div>
					</div>
				  </div>

				  <div class="col-50">
					<h3>Pagamento</h3>
					<label for="fname"> Carte accettate</label>
					<div class="icon-container">
					  <i class="fa fa-cc-visa" style="color:navy;"></i>
					  <i class="fa fa-cc-amex" style="color:blue;"></i>
					  <i class="fa fa-cc-mastercard" style="color:red;"></i>
					  <i class="fa fa-cc-discover" style="color:orange;"></i>
					</div>
					<label for="cname">Nome titolare</label>
					<input type="text" id="cname" name="cardname" pattern="[A-Za-z\s]{2,}" maxlength="100" title="Inserisci il tuo nome completo">
					  
					<label for="ccnum">Numero carta</label>
					<input type="text" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" maxlength="19">
					  
					<label for="expmonth">Mese di scadenza</label>
            		<input type="date" id="expmonth" name="expmonth" min="01-01-2020" title="Imposta il primo giorno del mese!">
					  
					<label for="cvv">CVV</label>
                	<input type="text" id="cvv" name="cvv" placeholder="352" pattern="[0-9]{3}" maxlength="3" title="Inserisci il tuo codice dietro alla carta di 3 cifre" >
				  </div>

				</div>
				<input type="submit" value="Conferma e paga" class="btn" name="pagamento">
			  </form>
			</div>
	  </div>

	  <div class="col-25">
		<div class="container">
		  <h4> Carrello
			<span class="price" style="color:black">
			  <i class="fa fa-shopping-cart"></i>
			</span>
		  </h4>
			<?php
			if(isset($_COOKIE["shopping_cart"]))
			{
				$total = 0;
				$cookie_data = stripslashes($_COOKIE['shopping_cart']);
				$cart_data = json_decode($cookie_data, true);
				foreach($cart_data as $keys => $values)
				{
			?>
					<p>
						<span class="quantity"><?php echo $values["item_quantity"]; ?></span> 
						<?php echo " " . $values["item_name"]; ?>
						<span class="price">
							<?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> €</span>
						<a href="indexLog.php?action=delete&id=<?php echo $values["item_id"]; ?>">
							<span class="text-danger">Rimuovi</span>
						</a>
					</p>
			<?php	
					$total = $total + ($values["item_quantity"] * $values["item_price"]);
				}
			?>
			<?php
			}
			else
			{
				echo '
				<tr>
					<td colspan="5" align="center">Il tuo carrello è vuoto</td>
				</tr>
				';
			}
			?>
		  <hr>
		  <p>Totale <span class="price" style="color:black"><b><?php echo number_format($total, 2); ?> €</b></span></p>
		</div>
	  </div>
	</div>
	</body>
</html>
