<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento senza titolo</title>
</head>

<body>
	<?php
//$str = "ciao";
//echo md5($str);
	
	$password = 'stefano1'; // password valida
	$hashedPassword = password_hash( $password, PASSWORD_DEFAULT ); // hash memorizzato nel database
	echo "Password hash: " . $hashedPassword ;
	$userPassword = 'stefano1'; // password inserita dall'utente nel login
	echo "Password normale: " . $userPassword . "\n";
	
	if ( password_verify( $userPassword, $hashedPassword ) ) {
		echo "Accesso effettuato con successo";
	} else {
		echo "La password inserita non è corretta";
	}
?>
</body>
</html>