<?php 

require('database_functions.php');

$pdo = connect_to_database("hotel");

$idusuario = $_POST['idcliente'];

$sql_reserva = "SELECT * from usuario u join reserva r on u.id_usuario = r.id_usuario where r.id_usuario = '$idusuario';";

$resultado_total = $pdo->query($sql_reserva);
$linhas = $resultado_total->fetch();

$total_reserva = $linhas['total'];
$idreserva = $linhas['id_reserva'];
$quantidade = $linhas['num_diarias'];
$nome = $linhas['Nome'];
$cpf = $linhas['cpf'];
$email = $linhas['email'];



echo "<script>alert('Você será redirecionado para o Pagseguro!')
            </script>";  
        
        require 'PagSeguroLibrary/PagSeguroLibrary.php';
		$paymentRequest = new PagSeguroPaymentRequest();  
		$paymentRequest->addItem($idreserva, 'Reserva de quarto em hotel dos guri', '1', '799'); 
		$paymentRequest->setSender(		  
			$nome,  
			'c53075719240619249476@sandbox.pagseguro.com.br',  
			'51',  
			'98616720',  
			$cpf
		);  


/*
		$paymentRequest->setSender(		  
			'Joao comprador',  
			'c33627255865565607371@sandbox.pagseguro.com.br',  
			'11',  
			'56273440',  
			'156.009.442-76'
		);  

*/
		$paymentRequest->setCurrency("BRL");
		try {  

		  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
		  $checkoutUrl = $paymentRequest->register($credentials);
		  echo '<script>window.location="'.$checkoutUrl.'"</script>';
		  
		} catch (PagSeguroServiceException $e) {  
		    die($e->getMessage());  
		} 
    // }
    //endif;
    
?>  