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

$situacao = 1;


$sql_insert = "INSERT INTO transacoes_pagseguro (id_reserva, id_situacao ) values (:id_reserva, :situacao)";
$resultado = $pdo->prepare($sql_insert);

$dados = array(':id_reserva' => $idreserva,
':situacao' => $situacao);
$resultado->execute($dados);

$sql_transacao= "SELECT max(id_transacao_pagseguro) as id from transacoes_pagseguro";

$resultado_transacao = $pdo->query($sql_transacao);
$linhas_transacao = $resultado_transacao->fetch();	

$idpag = $linhas_transacao['id'];

echo "<script>alert('Você será redirecionado para o Pagseguro!')
            </script>";  
        
        require 'PagSeguroLibrary/PagSeguroLibrary.php';
		$paymentRequest = new PagSeguroPaymentRequest();  
		$paymentRequest->addItem($idpag, 'Reserva de quarto em hotel', '1', $total_reserva); 
		$paymentRequest->setSender(		  
			$nome,  
			'c53075719240619249476@sandbox.pagseguro.com.br',  
			'51',  
			'98616720',  
			$cpf
		);  

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