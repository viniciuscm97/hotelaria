<?php
include('estatico/header.php');
?>

<?php

require('database_functions.php');

$pdo = connect_to_database("hotel");


$sql_reserva = "SELECT q.valor as valor_quarto,q.numero as numero_quarto,q.tipo as tipo_quarto,r.* from quartos q join reserva r on r.id_quartos=q.id_quartos where id_usuario = '$idusuario';";

$resultado_reserva = $pdo->query($sql_reserva);

$resultado_reserva_total = $pdo->query($sql_reserva);
$linhas = $resultado_reserva_total->fetch();

?>

<div class="reserva">
  <h4>Dados da reserva</h4>

<table class="table table-hover">
<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Data entrada</th>
    <th scope="col">Data saída</th>
    <th scope="col">Número de diárias</th>
    <th scope="col">Número do quarto</th>
    <th scope="col">Tipo do quarto</th>            
  </tr>
</thead>
<tbody>


<?php

while ($row = $resultado_reserva->fetch()) {
echo "\n<tr>".
"<td>".$row['id_reserva']."</td>".
"<td>".$row['data_entrada']."</td>".
"<td>".$row['data_saida']."</td>".
"<td>".$row['num_diarias']."</td>".
"<td>".($row['numero_quarto'])."</td>".
"<td>".($row['tipo_quarto'])."</td>".
"</tr>";

}
echo "</tbody></table>";
?>






<?php 

include('estatico/footer.php');

?>

    