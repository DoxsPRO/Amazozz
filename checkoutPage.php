<?php 
  include('eCommerceAssets/php/server.php');

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }

	//Array ( [info] => a:3:{i:0;s:4:"Doxs";i:1;N;i:2;N;} 
	//[shopping_cart] => [{"item_id":"11214","item_name":"EIVOTOR Microfono","item_price":"24.79","item_quantity":"1"},{"item_id":"11114","item_name":"msi GeForce RTX 2070 Ventus GP","item_price":"489","item_quantity":"1"}]
	//[PHPSESSID] => h88hch276ctqgts0ntbfi9nurt )

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Checkout</title>
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
			  <form action="/action_page.php">

				<div class="row">
				  <div class="col-50">
					<h3>Indirizzo di spedizione</h3>
					<label for="fname"><i class="fa fa-user"></i> Nome</label>
					<input type="text" id="fname" name="firstname">
					<label for="fname"><i class="fa fa-user"></i> Cognome</label>
					<input type="text" id="lname" name="lastname" >
					<label for="email"><i class="fa fa-envelope"></i> Email</label>
					<input type="text" id="email" name="email" placeholder="example@example.com">
					 <label for="fname"><i class="fa fa-phone"></i> Telefono</label>
					<input type="text" id="tel" name="phone" >
					<label for="adr"><i class="fa fa-address-card-o"></i> Indirizzo</label>
					<input type="text" id="adr" name="address" >
					<label for="city"><i class="fa fa-institution"></i> Città</label>
					<input type="text" id="city" name="city">

					<div class="row">
					  <div class="col-50">
						<label for="state">Provincia</label>
						<input type="text" id="state" name="state">
					  </div>
					  <div class="col-50">
						<label for="zip">CAP</label>
						<input type="text" id="zip" name="zip">
					  </div>
					</div>
				  </div>

				  <div class="col-50">
					<h3>Payment</h3>
					<label for="fname"> Carte accettate</label>
					<div class="icon-container">
					  <i class="fa fa-cc-visa" style="color:navy;"></i>
					  <i class="fa fa-cc-amex" style="color:blue;"></i>
					  <i class="fa fa-cc-mastercard" style="color:red;"></i>
					  <i class="fa fa-cc-discover" style="color:orange;"></i>
					</div>
					<label for="cname">Nome</label>
					<input type="text" id="cname" name="cardname">
					<label for="ccnum">Numero carta</label>
					<input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">

					<div class="row">
					  <div class="col-50">
					    <label for="expmonth">Mese di scadenza</label>
            			<input type="text" id="expmonth" name="expmonth" placeholder="Settembre">
					  </div>
					  <div class="col-50">
						<label for="expyear">Anno di scadenza</label>
						<input type="text" id="expyear" name="expyear" placeholder="2018">
					  </div>
					</div>
				  </div>

				</div>
				<input type="submit" value="Conferma e paga" class="btn">
			  </form>
			</div>
	  </div>

	  <div class="col-25">
		<div class="container">
		  <h4>Cart
			<span class="price" style="color:black">
			  <i class="fa fa-shopping-cart"></i>
			  <b>4</b>
			</span>
		  </h4>
		  <p><a href="#">Product 1</a> <span class="price">$15</span></p>
		  <p><a href="#">Product 2</a> <span class="price">$5</span></p>
		  <p><a href="#">Product 3</a> <span class="price">$8</span></p>
		  <p><a href="#">Product 4</a> <span class="price">$2</span></p>
		  <hr>
		  <p>Total <span class="price" style="color:black"><b>$30</b></span></p>
		</div>
	  </div>
	</div>
		<!-- <div class="content">
				<div class="input-group">
					<?php 
					
						if(!isset($_COOKIE['shopping_cart'])) 
						{
						  	print 'Il carrello è vuoto!';
							sleep(5);
							header('location: indexLog.php');
						} 
						else 
						{
							
						  	$jsonobj = $_COOKIE['shopping_cart'];

							$obj = json_decode($jsonobj,true);
							
							echo $obj["item_id"];
							//echo $_COOKIE['shopping_cart'];
							/*echo $obj->item_id;
							echo $obj->item_name;
							echo $obj->item_price;
							}*/
						} 
					?>
				</div>
			</div>
			<?php
				print_r($_COOKIE);
			?>-->
	</body>
</html>
