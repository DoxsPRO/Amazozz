<!doctype html>
<?php include('eCommerceAssets/php/server.php') ?>
<?php 
  //session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Devi fare l'accesso prima!";
  	header('location: login.php');
  }

 if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

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
<html>
	<head>
	<meta charset="utf-8">
	<title>Amazozz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="eCommerceAssets\styles\eCommerceStyle.css" rel="stylesheet" type="text/css">
	<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>var __adobewebfontsappname__="dreamweaver"</script>
	<script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
	</head>

<body>
<!--<div id="mainWrapper"> -->
  <header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <img src="eCommerceAssets\images\logoImage.png" alt="logo Amazoz" height="43" width="100"> 
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="myinfo.php" title="Account">Profilo</a>
		<a href="carrello.html" title="Cart">Carrello</a>
		<a href="account.php?logout='1'" style="color: red;" title="sessID"><?php echo session_id();?></a>
		<a><?php echo($_SESSION['count'])  ?></a>
	  </div>
  </header>
	<!--
  <section id="offer"> 
    <!-- The offer section displays a banner text for promotions
    <h2>OFFER 50%</h2>
    <p>REALLY AWESOME DISCOUNTS THIS JULY</p>
  </section> -->
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
    <section class="mainContent">
	<form method="post" action="indexLog.php">
      <div class="productRow"><!-- Each product row contains info of 3 elements -->
		<article class="productInfo"><!-- Each individual product description -->
         <div><img alt="mouse" src="eCommerceAssets/product/mouse.jpg"></div>
          <p class="price">100€</p>
          <p class="productContent">Mouse Razer Viper Mini</p>
          <input type="submit" name="add_cart" value="Buy" class="buyButton">		
        </article>
      </div>
      <div class="productRow"> 
        <!-- Each product row contains info of 3 elements -->
        <article class="productInfo"> <!-- Each individual product description -->
          <div><img alt="s10" src="eCommerceAssets/product/samsungS10.jpg"></div>
          <p class="price">670€</p>
          <p class="productContent">Samsung S10</p>
          <input type="submit" name="add_cart" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"> <!-- Each individual product description -->
          <div><img alt="ram" src="eCommerceAssets/product/ram.jpg"></div>
          <p class="price">45€</p>
          <p class="productContent">Corsair Vengeance LPX</p>
          <input type="submit" name="add_cart" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="ssd" src="eCommerceAssets/product/samsungSSD.jpg"></div>
          <p class="price">88€</p>
          <p class="productContent">Samsung MZ-76E500 EVO</p>
          <input type="submit" name="add_cart" value="Buy" class="buyButton">
        </article>
      </div>
      <div class="productRow">
        <article class="productInfo"> <!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="submit" name="add_cart" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="submit" name="add_cart" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="submit" name="add_cart" value="Buy" class="buyButton">
        </article>
      </div>
	</form>
    </section>
  </div>
  <footer> 
    <!-- This is the footer with default 3 divs -->
    <div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam varius sem neque. Integer ornare.</p>
    </div>
    <div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam varius sem neque. Integer ornare.</p>
    </div>
    <div class="footerlinks">
      <p><a href="#" title="Link">Link 1 </a></p>
      <p><a href="#" title="Link">Link 2</a></p>
      <p><a href="#" title="Link">Link 3</a></p>
    </div>
	  	<div><a href="https://www.iubenda.com/privacy-policy/13672304" class="iubenda-black iubenda-embed" title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
	</div>
  </footer>
<!-- </div> -->
</body>
</html>
