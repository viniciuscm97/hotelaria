<?php
include('estatico/header.php');
?>

<?php

require('database_functions.php');

$pdo = connect_to_database("hotel");


$sql_transacao = "SELECT t.*,r.* from reserva r inner join transacoes_pagseguro t on r.id_reserva=t.id_reserva;";
$resultado_transacao = $pdo->query($sql_transacao );



?>

<div class="reserva">
  <h4>Dados das transações</h4>

<table class="table table-hover">
<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Código da transação</th>
    <th scope="col">Data da transação</th>
    <th scope="col">Situação</th>
    <th scope="col">Valor total</th>           
  </tr>
</thead>
<tbody>


<?php

while ($row = $resultado_transacao->fetch()) {
echo "\n<tr>".
"<td>".$row['id_transacao_pagseguro']."</td>".
"<td>".$row['cod_transacao_pagseguro']."</td>".
"<td>".$row['data_trans']."</td>".
"<td>";
  if($row['id_situacao']==1){
      echo 'AGUARDANDO PAGAMENTO';
  }else if($row['id_situacao']==3){
      echo 'PAGAMENTO CONCLUIDO';
  }else if($row['id_situacao']==7){
    echo 'CANCELADA';
  }else{
    echo 'EM ANDAMENTO';
  }
echo "</td>".
"<td>".($row['total'])."</td>".
"</tr>";

}
echo "</tbody></table>";
?>






<?php 

include('estatico/footer.php');

?>

    