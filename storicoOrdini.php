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

// connect to the database
$connect = new PDO("mysql:host=localhost;dbname=sito", "root", "");
//$connect = new PDO("mysql:host=localhost;dbname=my_ecommercegalilei", "ecommercegalilei", "");

$db = mysqli_connect('localhost', 'root', '', 'sito');
//$db = mysqli_connect('localhost', 'ecommercegalilei', '', 'my_ecommercegalilei');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Storico Ordini</title>
	<link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
	<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
</head>

<body>
	<header> 
    	<div id="logo"> 
			<a href="indexLog.php"><img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"></a> 
      	</div>
    	<div id="headerLinks">
			<a href="indexLog.php" title="Home">Home</a>
			<a href="myinfo.php" title="Account">Profilo</a>
			<a href="checkoutPage.php" title="Cart">Carrello</a>
			<a href="account.php?logout='1'" style="color: red;" title="sessID">Esci</a>
			<a title=""></a>
		</div>
	</header>
	
	<table style="width:100%">
	  <tr>
		<th>Numero ordine</th>
		<th>Numero prodotto</th>
		<th>Indirizzo spedizione</th>
		<th>Prodotto</th>
		<th>Quantità</th>
  		<th>Data</th>
		<th>Totale</th>
		<th>Carta</th>
	  </tr>
		<?php 
			$cliente = $_SESSION['clienteID'];
		
			$query = "SELECT * FROM ordini WHERE ClienteID='$cliente'";
			$statement = $connect->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
		?>
	  <tr>
		<td><?php echo $row['OrdineID']; ?></td>
		<td><?php echo $row['ProdottoID']; ?></td>
		<td><?php echo $row['IndirizzoSpedizione']." ".$row['CittaSpedizione']." (".$row['CapSpedizione'].")".", ".$row['ProvinciaSpedizione']; ?></td>
		<td><?php echo $row['NomeProdotto']; ?></td>
		<td><?php echo $row['NumProdotto']; ?></td>
		<td><?php echo $row['DataOrdine']; ?></td>
		<td><?php echo $row['TotaleOrdine']; ?></td>
		  <?php
				$temp1 = $row['OrdineID'];
				
				$sql_id = "SELECT NumCarta FROM carte WHERE ClienteID = '$cliente' AND OrdineID = '$temp1'";
				$res_id = mysqli_query($db, $sql_id);	  
				$carta_id = mysqli_fetch_array($res_id);
		  ?>
		<td><?php echo $carta_id['NumCarta']; ?></td>
	  </tr>
		 <?php
			}
		?>

	</table>
	
</body>
</html>