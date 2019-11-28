<?php
$idpag = $_GET['id_pagseguro'];

$sql_insert = "INSERT INTO `transacoes_pagseguro` (`id_transacao_pagseguro`, `cod_transacao_pagseguro`, `id_reserva`, `id_situacao`) VALUES (NULL, '', '1', '1');;

$dados = array(':data_entrada' => $entrada,
':data_saida' => $saida,
':total' => $valorTotal,
':id_quartos' => $idquartos,
':id_usuario' => $idcliente,
':situacao' => $situacao,
':num_diarias' => $numerodiarias);

$resultado->execute($dados);


?>