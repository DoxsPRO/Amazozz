<?php 

//index.php
session_start();
			

if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Devi fare l'accesso prima!";
  	header('location: login.php');
  }

$connect = new PDO("mysql:host=localhost;dbname=sito", "root", "");
//$connect = new PDO("mysql:host=localhost;dbname=my_ecommercegalilei", "ecommercegalilei", "");

$message = '';

if(isset($_POST["add_to_cart"]))	
{
	if(isset($_COOKIE["shopping_cart"]))
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);

		$cart_data = json_decode($cookie_data, true);
	}
	else
	{
		$cart_data = array();
	}

	$item_id_list = array_column($cart_data, 'item_id');

	if(in_array($_POST["hidden_id"], $item_id_list))
	{
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
			{
				$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
			}
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_POST["hidden_id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$cart_data[] = $item_array;
	}

	
	$item_data = json_encode($cart_data);
	setcookie('shopping_cart', $item_data, time() + (1800));
	header("location:indexLog.php?success=1");
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]['item_id'] == $_GET["id"])
			{
				unset($cart_data[$keys]);
				$item_data = json_encode($cart_data);
				setcookie("shopping_cart", $item_data, time() + (1800));
				header("location:indexLog.php?remove=1");
			}
		}
	}
	if($_GET["action"] == "clear")
	{
		setcookie("shopping_cart", "", time() - 1800);
		header("location:indexLog.php?clearall=1");
	}
}

if(isset($_GET["success"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Oggetto aggiunto al carrello
	</div>
	';
}

if(isset($_GET["remove"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Prodotto rimosso dal carrello
	</div>
	';
}

if(isset($_GET["clearall"]))	
{
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Il tuo carrello è vuoto
	</div>
	';
}

 if (isset($_GET['logout'])) 
 {
  	session_destroy();
  	unset($_SESSION['username']);
	setcookie("shopping_cart", "", time() - 1800);
  	header("location: index.html");
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Amazozz</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script>var __adobewebfontsappname__="dreamweaver"</script>
		<script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="eCommerceAssets/styles/shopping.css"/>
	</head>
	<body>
		<header> 
			<!-- This is the header content. It contains Logo and links -->
			<div id="logo"> 
				<img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"> 
			  	<!-- Company Logo text --> 
			 </div>
			<div id="headerLinks">
				<a href="myinfo.php" title="Account">Profilo</a>
				<a href="storicoOrdini.php" title="Oridini">Ordini</a>
				<a href="indexLog.php?logout='1'" style="color: red;" title="sessID">Esci</a>
				<a title=""></a>
			  </div>
		 </header>
		<br />
		<div class="container">
			<br />

			<br /><br />
			<?php
			$query = "SELECT * FROM prodotti WHERE Quantita > 0 ";
			$statement = $connect->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
			?>
			<div class="col-md-3">
				<form method="post">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="<?php echo $row["immagine"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info" style="font-size: 20px;"><?php echo $row["Nome"]; ?></h4>
						
						<h4 class="text-info" style="font-size: 15px; color: black;"><?php echo $row["Specifiche"]; ?></h4>

						<h4 class="text-danger"><?php echo $row["Prezzo"]; ?> €</h4>

						
						<input type="number" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="<?php echo $row["Nome"]; ?>" />
						<input type="hidden" name="hidden_price" value="<?php echo $row["Prezzo"]; ?>" />
						<input type="hidden" name="hidden_id" value="<?php echo $row["ProdottoID"]; ?>" />
						<input type="submit" name="add_to_cart" style="margin-top:5px;background-color: orange; border-color: orange;" class="btn btn-success" value="Aggiungi al carrello" />
					</div>
				</form>
			</div>
			<?php
			}
			?>
			
			
			<div style="clear:both"></div>
			<br />
			<h3>Carrello</h3>
			<div class="table-responsive">
			<?php echo $message; ?>
			<div align="right">
				<a href="indexLog.php?action=clear"><b>Svuota carrello</b></a>
			</div>
			<table class="table table-bordered">
				<tr>
					<th width="40%">Nome prodotto</th>
					<th width="10%">Quantità</th>
					<th width="20%">Prezzo</th>
					<th width="15%">Totale</th>
					<th width="5%">Rimuovi</th>
				</tr>
			<?php
			if(isset($_COOKIE["shopping_cart"]))
			{
				$total = 0;
				$cookie_data = stripslashes($_COOKIE['shopping_cart']);
				$cart_data = json_decode($cookie_data, true);
				foreach($cart_data as $keys => $values)
				{
			?>
				<tr>
					<td><?php echo $values["item_name"]; ?></td>
					<td><?php echo $values["item_quantity"]; ?></td>
					<td><?php echo $values["item_price"]; ?> €</td>
					<td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> €</td>
					<td><a href="indexLog.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Rimuovi</span></a></td>
				</tr>
			<?php	
					$total = $total + ($values["item_quantity"] * $values["item_price"]);
				}
			?>
				<tr>
					<td colspan="3" align="right">Totale</td>
					<td align="right"><?php echo number_format($total, 2); ?> €</td>
					<td></td>
				</tr>
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
			</table>
			</div>
			<div>
				<form method="post" action="checkoutPage.php">
					<input type="submit" name="checkout" style="margin-top:5px;background-color: orange; border-color: orange;" class="btn btn-success" value="Procedi all'acquisto" />
				</form>
			</div>
		</div>
		<br />
		<footer>
			<a href="https://www.iubenda.com/privacy-policy/13672304" class="iubenda-black iubenda-embed" title="Privacy Policy ">Privacy Policy</a>
			<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
		</footer>
	</body>
</html>