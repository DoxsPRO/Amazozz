<?php 

//index.php

$connect = new PDO("mysql:host=localhost;dbname=sito", "root", "");

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
	setcookie('shopping_cart', $item_data, time() + (86400 * 30));
	header("location:index.php?success=1");
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
				setcookie("shopping_cart", $item_data, time() + (86400 * 30));
				header("location:index.php?remove=1");
			}
		}
	}
	if($_GET["action"] == "clear")
	{
		setcookie("shopping_cart", "", time() - 3600);
		header("location:index.php?clearall=1");
	}
}

if(isset($_GET["success"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Item Added into Cart
	</div>
	';
}

if(isset($_GET["remove"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Item removed from Cart
	</div>
	';
}

if(isset($_GET["clearall"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Your Shopping Cart has been clear...
	</div>
	';
}


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Amazozz</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link href="eCommerceAssets/styles/eCommerceStyle.css" rel="stylesheet" type="text/css">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="icon" href="simple-shopping-cart-using-cookies/eCommerceAssets/images/favicon.png" height="48" width="48"/>
	</head>
	<body>
		<header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"> 
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="simple-shopping-cart-using-cookies/myinfo.php" title="Account">Profilo</a>
		<a href="simple-shopping-cart-using-cookies/carrello.html" title="Cart">Carrello</a>
		<a href="account.php?logout='1'" style="color: red;" title="sessID"><?php echo session_id();?></a>
	  </div>
  </header>
		<div id="content">
    <section class="sidebar"> 
      <!-- This adds a sidebar with 1 searchbox,2 menusets, each with 4 links -->
      <input type="text"  id="search" value="search">
      <div id="menubar">
        <nav class="menu">
          <h2><!-- Title for menuset 1 -->MENU ITEM 1 </h2>
          <hr>
          <ul>
            <!-- List of links under menuset 1 -->
            <li><a href="#" title="Link">Link 1</a></li>
            <li><a href="#" title="Link">Link 2</a></li>
            <li><a href="#" title="Link">Link 3</a></li>
            <li class="notimp"><!-- notimp class is applied to remove this link from the tablet and phone views --><a href="#"  title="Link">Link 4</a></li>
          </ul>
        </nav>
        <nav class="menu">
          <h2>MENU ITEM 2 </h2>
          <!-- Title for menuset 2 -->
          <hr>
          <ul>
            <!--List of links under menuset 2 -->
            <li><a href="#" title="Link">Link 1</a></li>
            <li><a href="#" title="Link">Link 2</a></li>
            <li><a href="#" title="Ciao">Link 3</a></li>
            <li class="notimp"><!-- notimp class is applied to remove this link from the tablet and phone views --><a href="#" title="Link">Link 4</a></li>
          </ul>
        </nav>
      </div>
    </section>
		<section class="mainContainer">
			<?php
			$query = "SELECT * FROM prodotti ";
			$statement = $connect->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
			?>
			<div class="productRow">
				<form method="post">
					<article class="productInfo">
						<div><img src="images/<?php echo $row["immmagine"]; ?>" class="img-responsive" /></div>
						<p class="price"><?php echo $row["Prezzo"]; ?> €</p>
						<p class="productContent"><?php echo $row["Nome"]; ?></p>
						<input type="text" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="<?php echo $row["Nome"]; ?>" />
						<input type="hidden" name="hidden_price" value="<?php echo $row["Prezzo"]; ?>" />
						<input type="hidden" name="hidden_id" value="<?php echo $row["ProdottoID"]; ?>" />
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Compra" />
					</article>
				</form>
			</div>


			</div>
			<?php
			}
			?>
			
			</div>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
			<?php echo $message; ?>
			<div align="right">
				<a href="simple-shopping-cart-using-cookies/index.php?action=clear"><b>Clear Cart</b></a>
			</div>
			<table class="table table-bordered">
				<tr>
					<th width="40%">Item Name</th>
					<th width="10%">Quantity</th>
					<th width="20%">Price</th>
					<th width="15%">Total</th>
					<th width="5%">Action</th>
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
					<td>$ <?php echo $values["item_price"]; ?></td>
					<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
					<td><a href="simple-shopping-cart-using-cookies/index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
				</tr>
			<?php	
					$total = $total + ($values["item_quantity"] * $values["item_price"]);
				}
			?>
				<tr>
					<td colspan="3" align="right">Total</td>
					<td align="right">$ <?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>
			<?php
			}
			else
			{
				echo '
				<tr>
					<td colspan="5" align="center">No Item in Cart</td>
				</tr>
				';
			}
			?>
			</table>
			</div>
		</div>
		<br />
	</body>
</html>