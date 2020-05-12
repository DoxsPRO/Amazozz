<?php include('eCommerceAssets/php/server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Accedi</title>
  <link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
	<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
	<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
</head>
<body>
<header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <a href="index.html"><img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"></a>
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="index.html" title="Home">Home</a>
		<a href="register.php" title="Registrati">Registrati</a>
		<a href="" title="Cart">Carrello</a>
		<a href="" title="sessID"><?php echo session_id();?></a>
	 </div>
  <form method="post" action="login.php">
  	<?php include('eCommerceAssets/php/errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>