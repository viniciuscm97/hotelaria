<?php

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

/*

header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
$code = $_POST['notificationCode'];
$type = $_POST['notificationType'];
if($type == 'transaction'){
$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/".$code."?email=viniciuscmoreira97@outlook.com&token=D53C59C430E74A3184CBBAAC837D26A2";
$content = file_get_contents($url);
$xml = simplexml_load_string($content);

  var_dump($xml);
}

$reference = $xml->reference;
$status = $xml->status; 

*/

require('database_functions.php');

$pdo = connect_to_database("hotel");

$sql_insert = "UPDATE `transacoes_pagseguro` SET `id_situacao` = :id_situacao WHERE `transacoes_pagseguro`.`id_transacao_pagseguro` = :id_pagseguro;";
$resultado = $pdo->prepare($sql_insert);

$dados = array(':id_situacao' => $status,
':id_pagseguro' => $reference);

$resultado->execute($dados);

?>