<?php
include('estatico/header.php');
?>

<?php

require('database_functions.php');

$pdo = connect_to_database("hotel");

$sql_reserva = "SELECT q.valor as valor_quarto,q.numero as numero_quarto,q.tipo as tipo_quarto,r.*,u.Nome as nome_usuario
from quartos q 
inner join reserva r on r.id_quartos=q.id_quartos
INNER join usuario u on r.id_usuario=u.id_usuario";

$resultado_reserva = $pdo->query($sql_reserva);


?>

<div class="reserva">
  <h4>Dados da reserva</h4>

<table class="table table-hover">
<thead>
  <tr>
    <th scope="col">Nome cliente</th>
    <th scope="col">Data entrada</th>
    <th scope="col">Data saída</th>
    <th scope="col">Número de diárias</th>
    <th scope="col">Número do quarto</th>
    <th scope="col">Tipo do quarto</th>
    <th scope="col">Total</th>

  </tr>
</thead>
<tbody>


<?php

while ($row = $resultado_reserva->fetch()) {
echo "\n<tr>".
"<td>".$row['nome_usuario']."</td>".
"<td>".$row['data_entrada']."</td>".
"<td>".$row['data_saida']."</td>".
"<td>".$row['num_diarias']."</td>".
"<td>".($row['numero_quarto'])."</td>".
"<td>".($row['tipo_quarto'])."</td>".
"<td>".($row['total'])."</td>".
"</tr>";

}
echo "</tbody></table>";
?>

</div>





<?php 

include('estatico/footer.php');

?>

    