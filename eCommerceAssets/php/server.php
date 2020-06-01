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
  $token = mysqli_real_escape_string($db, $_POST['token']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username è richiesto"); }
  if (empty($email)) { array_push($errors, "Email è richiesta"); }
  if (empty($password_1)) { array_push($errors, "Password è richiesta"); }
  if ($token != "2O3W7HKjgTIH") { array_push($errors, "Token è richiesto/sbagliato"); }
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
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO credenziali (Username, Password, Email) 
  			  VALUES('$username', '$password', '$email')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Hai eseguito l'accesso correttamente!";
  	header('location: account.php');
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
  	$password = md5($password);
  	$query = "SELECT * FROM credenziali WHERE Username='$username' AND Password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
		//selezione CredenzialeID
		$sql_id = "SELECT CredenzialeID AS max FROM credenziali WHERE Username='$username' AND Password='$password'";
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
		$newDate = date("Y-m-d", strtotime($results['dataT']));
		$_SESSION['data'] = $newData;
		
		//selezione codice fiscale
		$sql_get = "SELECT CodiceFiscale AS codfT FROM clienti WHERE CredenzialeID = '$temp'";
		$res_get = mysqli_query($db, $sql_get) or die(mysqli_error($db));
		$results = mysqli_fetch_array($res_get);
		$_SESSION['cod_fisc'] = $results['codfT'];

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
		
  	  	$_SESSION['username'] = $username;
  	  	$_SESSION['success'] = "Hai eseguito l'accesso correttamente!";
		
		setcookie('info', $username, time() + (86400 * 30));
		
  	  	header('location: indexLog.php');
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
	$citta = mysqli_real_escape_string($db, $_POST['citta']);
	$indirizzo = mysqli_real_escape_string($db, $_POST['indirizzo']);
	$cap = mysqli_real_escape_string($db, $_POST['cap']);
	$telefono = mysqli_real_escape_string($db, $_POST['telefono']);
	
	 if (empty($name)) {
  	array_push($errors, "Nome è richiesto");}
	 if (empty($cognome)) {
  	array_push($errors, "Cognome è richiesto");}
		 if (empty($data)) {
  	array_push($errors, "Data di nascita richiesta");}
	 if (empty($cod_fisc)) {
  	array_push($errors, "Codice fiscale è richiesto");}
		 if (empty($citta)) {
  	array_push($errors, "Città è richiesto");}
	 if (empty($indirizzo)) {
  	array_push($errors, "Indirizzo è richiesto");}
		 if (empty($cap)) {
  	array_push($errors, "Cap è richiesto");}
	 if (empty($telefono)) {
  	array_push($errors, "Telefono è richiesto");}
	
	$newDate = date("Y-m-d", strtotime($data));
	
	  if (count($errors) == 0) {

	$sql_id = "SELECT MAX(CredenzialeID) AS max FROM credenziali";
	$res_id = mysqli_query($db, $sql_id);
		  
	$results = mysqli_fetch_array($res_id);
	
	$temp = $results['max'];

	$query = "INSERT INTO clienti (Nome, Cognome, Data, CodiceFiscale, Citta, Indirizzo, CAP, Telefono, CredenzialeID) 
  			  VALUES('$name', '$cognome', '$newDate', '$cod_fisc', '$citta', '$indirizzo', '$cap', '$telefono', '$temp')";
		  
  	mysqli_query($db, $query)or die(mysqli_error($db));
  	$_SESSION['success'] = "Hai inserito tutti i dati correttamente!";
	$_SESSION['name'] = $name;
	$_SESSION['cognome'] = $cognome;
	$_SESSION['data'] = $newDate;
	$_SESSION['cod_fisc'] = $cod_fisc;
	$_SESSION['citta'] = $citta;
	$_SESSION['indirizzo'] = $indirizzo;
	$_SESSION['cap'] = $cap;
	$_SESSION['telefono'] = $telefono;
	$_SESSION['id'] = $results['max'];
		  
  	header('location: myinfo.php');
  }
	
  }

if (isset($_POST['pagamento']))
{
	//infomazioni spedizione
	$fullname = mysqli_real_escape_string($db, $_POST['fullname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$city = mysqli_real_escape_string($db, $_POST['city']);
	$state = mysqli_real_escape_string($db, $_POST['state']);
	$zip = mysqli_real_escape_string($db, $_POST['zip']);
	
	//informazioni carta
	$cardname = mysqli_real_escape_string($db, $_POST['cardname']);
	$cardnumber = mysqli_real_escape_string($db, $_POST['cardnumber']);
	$expmonth = mysqli_real_escape_string($db, $_POST['expmonth']);
	$cvv = mysqli_real_escape_string($db, $_POST['cvv']);
	
	 if (empty($fullname)) { 
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
	 if (empty($cardnumber)) { 
		 array_push($errors, "Numero carta è richiesto"); 
	 }
	 if (empty($expmonth)) { 
		 array_push($errors, "Scadenza è richiesto"); 
	 }
	 if (empty($cvv)) { 
		 array_push($errors, "CVV è richiesto"); 
	 }	
	
	if (count($errors) == 0) {
		//$sql_id = "SELECT CredenzialeID AS max FROM credenziali WHERE Username='$username' AND Password='$password'";
		//$res_id = mysqli_query($db, $sql_id) or die(mysqli_error($db)); 
		//$results = mysqli_fetch_array($res_id);
		
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
