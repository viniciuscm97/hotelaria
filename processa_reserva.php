<?php 

require('database_functions.php');

$pdo = connect_to_database("hotel");

$idcliente = $_POST['cliente'];
$idquartos = $_POST['quarto'];
$saida = $_POST['dataSaida'];
$entrada = $_POST['dataEntrada'];
$situacao = "ativo";

$sql = "SELECT DATEDIFF('$saida', '$entrada') as numdiarias";
$resultado = $pdo->query($sql);
$row = $resultado->fetch();
$numerodiarias = $row['numdiarias'];

$sql_valor = "SELECT valor FROM quartos WHERE id_quartos='$idquartos'";
$resultado_valor = $pdo->query($sql_valor);
$row_valor = $resultado_valor->fetch();
$valor_quarto = $row_valor['valor'];


$valorTotal = $valor_quarto * $numerodiarias;

// tabela quarto: cadastrar dinamicamente 10 quartos, definir cada um com seu número e tipo e valor e capacidade.

$sql_insert = "INSERT INTO reserva (data_entrada, data_saida, total, id_quartos,id_usuario, situacao, num_diarias) values (:data_entrada, :data_saida, :total, :id_quartos,:id_usuario, :situacao, :num_diarias)";
$resultado = $pdo->prepare($sql_insert);

$dados = array(':data_entrada' => $entrada,
':data_saida' => $saida,
':total' => $valorTotal,
':id_quartos' => $idquartos,
':id_usuario' => $idcliente,
':situacao' => $situacao,
':num_diarias' => $numerodiarias);

$resultado->execute($dados);

$disponivel = '0';

$sql_update = "UPDATE `quartos` SET `disponivel` = :disponivel WHERE id_quartos = :id_quarto;";
$resultado_update = $pdo->prepare($sql_update);

$dados_update = array(':disponivel' => $disponivel,
':id_quarto' => $idquartos);

$resultado_update->execute($dados_update);

echo "<script>alert('Reserva cadastrada com sucesso!');
            top.location.href='index.php';
            </script>";  
            



?>