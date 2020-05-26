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
	<link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
		<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
		<script>var __adobewebfontsappname__="dreamweaver"</script>
		<script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
		<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
	</head>

	<body>
		<div class="content">
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

							$obj = json_decode($jsonobj);
							
							echo $obj['item_id'];
							echo $_COOKIE['shopping_cart'];
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
			?>
	</body>
</html>
