
<?php
define ('SERVER_NAME','ec2-100-26-110-52.compute-1.amazonaws.com');
define ('SERVER_PORT','5000');

	// PROGRAMMA PRINCIPALE
	// Controllo sulla porta seriale
	$fp =fopen("/dev/ttyACM0", "w+");
	if( !$fp) {
		echo "Error";
		die();
	}

	while(true){
		fflush($fp);
		$buffer = "";
		if(($buffer = fgets($fp, 10)) === false){
			echo "PROBLEMI ALLA PORTA SERIALE\n\n";
			exit;
		}
		
		//$buffer = "[12.3]";
		// Controllo di ciò che è arrivato	
		if(strpos($buffer,"[") === false) continue;
		if(strpos($buffer,"]") === false) continue;
		// Ripulisce li buffer
		$buffer_tmp = str_replace ("[" , "" ,$buffer);
		$value = str_replace ("]" , "" ,$buffer_tmp);
		// Imposta la data
		date_default_timezone_set('Europe/Rome');
		$data = date("Y/m/d");
		$time = date("H:i");
		echo "Dati inviati!: " . $data . " " . $time . " " . $value . "\n";
		send_data("[" . $data . ";" . $time . ";" . $value . "]"); 
	}
	fclose($fp);
	//----------------------------------------------------------------------
	// FUNZIONE DI INVIO DEI DATI
function send_data($str_to_send)
{
	/* Converte il nome host */
	$address = gethostbyname(SERVER_NAME);

	/* Crea un socket TCP/IP */
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket === false) {
		echo "Fallita la creazione del socket: " . socket_strerror(socket_last_error()) . "\n";
		return;
	}

	// Prova a connettersi
	$result = socket_connect($socket, $address, SERVER_PORT);
	if ($result === false) {
		echo "Fallita la connessione: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
		return;
	}
	
	// Invia i dati al server
	socket_write($socket, $str_to_send, strlen($str_to_send));
	
	// Chiude il socket	
	socket_close($socket);
}	
	
?>






