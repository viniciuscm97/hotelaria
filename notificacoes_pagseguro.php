<?php

/*

header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
     if (count($_POST)>0) {

               $email = "viniciuscmoreira97@outlook.com";
               $token = " D53C59C430E74A3184CBBAAC837D26A2";
               $notificationCode = $_POST['notificationCode'];
               $url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/".$notificationCode."?email=".$email."&token=".$token;

               $curl = curl_init($url);
               curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
               $response = curl_exec($curl);
               $http = curl_getinfo($curl);

               if($response == 'Unauthorized'){
                        print_r($response);
                        exit;
               }
               curl_close($curl);
               $response= simplexml_load_string($response);

                
                $status = $response->status;
                $reference = $response->reference;

    }
//$status = $transaction->status; 


*/

header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
$code = $_POST['notificationCode'];
$type = $_POST['notificationType'];
if($type == 'transaction'){

  $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/".$code."?email=viniciuscmoreira97@outlook.com&token=D53C59C430E74A3184CBBAAC837D26A2";
  $content = file_get_contents($url);
  $xml = simplexml_load_string($content);
  var_dump($xml);
}

$id = $xml->items->item->id;
$status = $xml->status; 
$cod_transacao = $xml->code;
$data = $xml->date;


require('database_functions.php');

$pdo = connect_to_database("hotel");

$sql_insert = "UPDATE `transacoes_pagseguro` SET `id_situacao` = :id_situacao WHERE id_transacao_pagseguro = :id;";

$resultado = $pdo->prepare($sql_insert);

$dados = array(':id_situacao' => $status,
  ':id' => $id);

$sql_insert_2 = "UPDATE `transacoes_pagseguro` SET cod_transacao_pagseguro = :cod_transacao , data_trans = :data_t WHERE id_transacao_pagseguro = :id;";

$resultado2 = $pdo->prepare($sql_insert_2);

$dados2 = array(':cod_transacao' => $cod_transacao,
  ':data_t' => $data,
  ':id' => $id);



$sql_valor = "SELECT id_reserva FROM transacoes_pagseguro WHERE id_transacao_pagseguro='$id'"; 
$resultado_valor = $pdo->query($sql_valor);
$row_valor = $resultado_valor->fetch();

$id_reserva = $row_valor['id_reserva'];

$sql_insert_3 = "UPDATE `reserva` SET `situacao` = 'P' WHERE `reserva`.`id_reserva` = :id_reserva;";

$resultado3 = $pdo->prepare($sql_insert_3);

$dados3 = array(':id_reserva' => $id_reserva);



$resultado3->execute($dados3);

$resultado2->execute($dados2);

$resultado->execute($dados);

?>