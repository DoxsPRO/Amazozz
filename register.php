<?php include('eCommerceAssets/php/server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registrati</title>
  <link rel="stylesheet" type="text/css" href="eCommerceAssets/styles/style.css">
	<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
	<link rel="icon" href="eCommerceAssets\images\favicon.png" height="48" width="48"/>
</head>
<body>
  <header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <a href="index.html"><img src="eCommerceAssets/images/logoImage.png" alt="logo Amazoz" height="43" width="100"> </a>
      <!-- Company Logo text --> 
      </div>
    <div id="headerLinks">
		<a href="index.html" title="Home">Home</a>
		<a href="login.php" title="Login">Accedi</a>
		<a href="" title="Cart">Carrello</a></div>
	
  <form method="post" action="register.php">
  	<?php include('eCommerceAssets/php/errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
	  <div class="input-group">
  	  <label>Token 2O3W7HKjgTIH</label>
  	  <input type="password" name="token">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>