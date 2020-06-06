<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
 
// connect to the database
//$db = mysqli_connect('localhost', 'ecommercegalilei', '', 'my_ecommercegalilei');
$db = mysqli_connect('localhost', 'root', '', 'sito');
if ($db->connect_errno) {
	array_push($errors,"Impossibile connettersi al server: " . $conn->connect_error);
    }

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username è richiesto"); }
  if (empty($email)) { array_push($errors, "Email è richiesta"); }
  if (empty($password_1)) { array_push($errors, "Password è richiesta"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Le due password non corrispondono");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
	$sql_u = "SELECT * FROM credenziali WHERE Username='$username'";
  	$sql_e = "SELECT * FROM credenziali WHERE Email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);

  	if (mysqli_num_rows($res_u) > 0) {
  	  array_push($errors, "Username esiste già");	
  	}else if(mysqli_num_rows($res_e) > 0){
  	  array_push($errors, "Email esiste già"); 
	}
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
		//è buona norma non salvare le password in chiaro, ma crittografate
  		//$password = md5($password_1);//encrypt the password before saving in the database
	  	
	  	//PASSWORD_DEFAULT can store more than 60 characters (255 is the recommended width).
		$hashedPassword = password_hash($password_1, PASSWORD_DEFAULT); // hash password
	  
  		$query = "INSERT INTO credenziali (Username, Password, Email) 
  			  VALUES('$username', '$hashedPassword', '$email')";
  		mysqli_query($db, $query)or die(mysqli_error($db));
  		$_SESSION['username'] = $username;
  		$_SESSION['success'] = "Hai eseguito l'accesso correttamente!";
	 	$_SESSION['email'] = $email;
	  	header('location: account.php') or die;
  		exit;
  }

}
	// ... 
	
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username è richiesto");
  }
  if (empty($password)) {
  	array_push($errors, "Password è richiesta");
  }

  if (count($errors) == 0) {
	  
	  	$sql_get = "SELECT Password AS crypt FROM credenziali WHERE Username='$username'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$resultsCry = mysqli_fetch_array($res_get);
		$hashedPassword = $resultsCry['crypt'];
	  	
  		//$password = md5($password);
	 if (password_verify($password, $hashedPassword)) {
   
  		$query = "SELECT * FROM credenziali WHERE Username='$username' AND Password='$hashedPassword'";
  		$results = mysqli_query($db, $query);
		 
	  	//salvataggio informazioni utente
  		//if (mysqli_num_rows($results) == 1) {
		 
		//selezione CredenzialeID
		$sql_id = "SELECT CredenzialeID AS max FROM credenziali WHERE Username='$username' AND Password='$hashedPassword'";
		$res_id = mysqli_query($db, $sql_id) or die(mysqli_error($db)); 
		$results = mysqli_fetch_array($res_id);
		$_SESSION['id'] = $results['max'];
		$temp = $results['max'];
		
		//selezione nome
		$sql_get = "SELECT Nome AS nameT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['name'] = $results['nameT'];
		
		//selezione cognome
		$sql_get = "SELECT Cognome AS cognomeT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['cognome'] = $results['cognomeT'];
		
		//selezione data
		$sql_get = "SELECT Data AS dataT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['data'] = $results['dataT'];
		
		//selezione codice fiscale
		$sql_get = "SELECT CodiceFiscale AS codfT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['cod_fisc'] = $results['codfT'];

		//selezione provincia
		$sql_get = "SELECT Provincia AS provinciaT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['provincia'] = $results['provinciaT'];
		 
		//selezione citta
		$sql_get = "SELECT Citta AS cittaT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['citta'] = $results['cittaT'];
		
		//selezione indirizzo
		$sql_get = "SELECT Indirizzo AS indirizzoT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['indirizzo'] = $results['indirizzoT'];
		
		//selezione CAP
		$sql_get = "SELECT CAP AS capT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['cap'] = $results['capT'];
		
		//selezione telefono
		$sql_get = "SELECT Telefono AS telefonoT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['telefono'] = $results['telefonoT'];
		
		//selezione email
		$sql_get = "SELECT email AS emailT FROM credenziali WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['email'] = $results['emailT'];
		 
		//selezione ClienteID 
		$sql_get = "SELECT ClienteID AS customerT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get);	  
		$results = mysqli_fetch_array($res_get);
		$_SESSION['clienteID'] = $results['customerT']; 
		
  	  	$_SESSION['username'] = $username;
  	  	$_SESSION['success'] = "Hai eseguito l'accesso correttamente!";
		
  	  	header('location: indexLog.php');
		exit;
  		}
	  else {
  		array_push($errors, "Username/password sbagliate");
  	}
  }
}

if (isset($_POST['subit_data'])) {
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$cognome = mysqli_real_escape_string($db, $_POST['cognome']);
	$data = mysqli_real_escape_string($db, $_POST['data']);
	$cod_fisc = mysqli_real_escape_string($db, $_POST['cod_fisc']);
	$provincia = mysqli_real_escape_string($db, $_POST['provincia']);
	$citta = mysqli_real_escape_string($db, $_POST['citta']);
	$indirizzo = mysqli_real_escape_string($db, $_POST['indirizzo']);
	$cap = mysqli_real_escape_string($db, $_POST['cap']);
	$telefono = mysqli_real_escape_string($db, $_POST['telefono']);
	
	 if (empty($name)) {
  	array_push($errors, "Nome è un campo obbligatorio!");}
	 if (empty($cognome)) {
  	array_push($errors, "Cognome è un campo obbligatorio!");}
		 if (empty($data)) {
  	array_push($errors, "Data di nascita è un campo obbligatorio!");}
	 if (empty($cod_fisc)) {
  	array_push($errors, "Codice fiscale è un campo obbligatorio!");}
			 if (empty($provincia)) {
  	array_push($errors, "Provincia è un campo obbligatorio!");}
		 if (empty($citta)) {
  	array_push($errors, "Città è un campo obbligatorio!");}
	 if (empty($indirizzo)) {
  	array_push($errors, "Indirizzo è un campo obbligatorio!");}
		 if (empty($cap)) {
  	array_push($errors, "Cap è un campo obbligatorio!");}
	 if (empty($telefono)) {
  	array_push($errors, "Telefono è un campo obbligatorio!");}
	
	$newDate = date("Y-m-d", strtotime($data));
	
	  if (count($errors) == 0) {
		  
		$sql_id = "SELECT MAX(CredenzialeID) AS max FROM credenziali";
		$res_id = mysqli_query($db, $sql_id);	  
		$results = mysqli_fetch_array($res_id);
		$temp = $results['max'];

		$query = "INSERT INTO clienti (Nome, Cognome, Data, CodiceFiscale, Provincia, Citta, Indirizzo, CAP, Telefono, CredenzialeID) 
				  VALUES('$name', '$cognome', '$newDate', '$cod_fisc', '$provincia', '$citta', '$indirizzo', '$cap', '$telefono', '$temp')";	  
		mysqli_query($db, $query)or die(mysqli_error($db));
		  
		//selezione ClienteID 
		$sql_get = "SELECT ClienteID AS customerT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get);	  
		$results = mysqli_fetch_array($res_get);
		$_SESSION['clienteID'] = $results['customerT']; 

		$_SESSION['success'] = "Hai inserito tutti i dati correttamente!";
		$_SESSION['name'] = $name;
		$_SESSION['cognome'] = $cognome;
		$_SESSION['data'] = $data;	  
		$_SESSION['cod_fisc'] = $cod_fisc;
		$_SESSION['provincia'] = $provincia;
		$_SESSION['citta'] = $citta;
		$_SESSION['indirizzo'] = $indirizzo;
		$_SESSION['cap'] = $cap;
		$_SESSION['telefono'] = $telefono;
		$_SESSION['id'] = $results['max'];

		header('location: myinfo.php');
		  exit;
	  }
	
  }

if (isset($_POST['pagamento']))
{
	//infomazioni spedizione
	$fname = mysqli_real_escape_string($db, $_POST['fullname']);
	$cname = mysqli_real_escape_string($db, $_POST['subname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$city = mysqli_real_escape_string($db, $_POST['city']);
	$state = mysqli_real_escape_string($db, $_POST['state']);
	$zip = mysqli_real_escape_string($db, $_POST['zip']);
	
	//informazioni carta
	$cardname = mysqli_real_escape_string($db, $_POST['cardname']);
	$cardsurname = mysqli_real_escape_string($db, $_POST['cardsurn']);
	$cardnumber = mysqli_real_escape_string($db, $_POST['cardnumber']);
	$expmonth = mysqli_real_escape_string($db, $_POST['expmonth']);
	$cvv = mysqli_real_escape_string($db, $_POST['cvv']);
	
	 if (empty($fname)) { 
		 array_push($errors, "Nome è richiesto"); 
	 }
	if (empty($cname)) { 
		 array_push($errors, "Nome è richiesto"); 
	 }
	 if (empty($email)) { 
		 array_push($errors, "Email è richiesta"); 
	 }
	 if (empty($phone)) { 
		 array_push($errors, "Telefono è richiesto"); 
	 }
	 if (empty($address)) { 
		 array_push($errors, "Indirizzo è richiesto"); 
	 }
	 if (empty($city)) { 
		 array_push($errors, "Città è richiesto"); 
	 }
	 if (empty($state)) { 
		 array_push($errors, "Provincia è richiesto"); 
	 }
	 if (empty($zip)) { 
		 array_push($errors, "Cap è richiesto"); 
	 }
	
	 if (empty($cardname)) { 
		 array_push($errors, "Titolare carta è richiesto"); 
	 }
	if (empty($cardsurname)) { 
		 array_push($errors, "Titolare carta è richiesto"); 
	 }
	 if (empty($cardnumber)) { 
		 array_push($errors, "Numero carta è richiesto"); 
	 }
	 if (empty($expmonth)) { 
		 array_push($errors, "Scadenza è richiesto"); 
	 }
	 if (empty($cvv)) { 
		 array_push($errors, "CVV è richiesto"); 
	 }	
	  	
	  //PASSWORD_DEFAULT can store more than 60 characters (255 is the recommended width).
	  $hashed_cvv = password_hash($cvv, PASSWORD_DEFAULT); // hash password
	
	 if (count($errors) == 0) {
		
		
		$id = $_SESSION['id'];
		$customer = $_SESSION['clienteID']; //id del cliente
		
		$OGGI = date("Y/m/d");
		
		$total = 0;
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);
		
		foreach($cart_data as $keys => $values)
		{	
			//prendo le informazioni dal carrello
			$item_quantity = $values["item_quantity"]; 
			$item_name = $values["item_name"];
			$item_id = $values["item_id"];
			$tot = number_format($values["item_quantity"] * $values["item_price"], 2);
			
			//inserimento nella tabella ordini
			$query = "INSERT INTO ordini (ProdottoID, ClienteID, NomeCliente, CognomeCliente, EmailSpedizione,	TelefonoSpedizione, IndirizzoSpedizione, CittaSpedizione, ProvinciaSpedizione, CapSpedizione ,NomeProdotto, NumProdotto, DataOrdine, TotaleOrdine) 
			VALUES ('$item_id', '$customer', '$fname', '$cname', '$email', '$phone', '$address', '$city', '$state', '$zip', '$item_name', '$item_quantity', '$OGGI' ,'$tot')";
  			mysqli_query($db, $query) or die(mysqli_error($db));
			
			//prendo la quantità del prodotto
			$query = "SELECT Quantita AS quantT FROM prodotti WHERE ProdottoID = '$item_id'";
			$res_id = mysqli_query($db, $query);	  
			$results = mysqli_fetch_array($res_id);
			$quantita_prod = $results['quantT'];
			
			$quantita_prod = $quantita_prod - $item_quantity;
			
			//diminuisco la quantità del prodotto comprato
			$query = "UPDATE prodotti SET Quantita = '$quantita_prod' WHERE ProdottoID = '$item_id';";
			mysqli_query($db, $query) or die(mysqli_error($db));
			
			//seleziono l'ultimo ordine
			$sql_id = "SELECT MAX(OrdineID) AS ordineMax FROM ordini";
			$res_id = mysqli_query($db, $sql_id);	  
			$results = mysqli_fetch_array($res_id);
			$ordineMax = $results['ordineMax'];
			
			$newDate = date("Y-m-d", strtotime($expmonth));
			
			//salvo le informazioni della carta SELECT EXTRACT(YEAR_MONTH FROM "2017-06-15");
			$query = "INSERT INTO carte (NumCarta, NomeProprietario, CognomeProprietario, Scadenza, CVV2, ClienteID, OrdineID) VALUES ('$cardnumber', '$cardname', '$cardsurname','$newDate', '$hashed_cvv', '$customer', '$ordineMax')";		
 			mysqli_query($db, $query) or die(mysqli_error($db));
		}
		
		
		setcookie("shopping_cart", "", time() - 1800);
		
		header('location: indexLog.php');
		exit;
	}
}

?>

<?php
	if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
