<!doctype html>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Devi fare l'accesso prima!";
  	header('location: login.php');
  }

 if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<html>
<head>
<meta charset="utf-8">
<title>Amazozz</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="eCommerceAssets\styles\eCommerceStyle.css" rel="stylesheet" type="text/css">
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
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
		<a  href="account.php?logout='1'" style="color: red;" title="sessID"><?php echo session_id();?></a>
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
      <div class="productRow"><!-- Each product row contains info of 3 elements -->
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder </p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"> <!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
      </div>
      <div class="productRow"> 
        <!-- Each product row contains info of 3 elements -->
        <article class="productInfo"> <!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"> <!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
      </div>
      <div class="productRow">
        <article class="productInfo"> <!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
        <article class="productInfo"><!-- Each individual product description -->
          <div><img alt="sample" src="eCommerceAssets/images/200x200.png"></div>
          <p class="price">$50</p>
          <p class="productContent">Content holder</p>
          <input type="button" name="button" value="Buy" class="buyButton">
        </article>
      </div>
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
