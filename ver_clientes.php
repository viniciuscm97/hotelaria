<?php
include('estatico/header.php');
?>

<?php

require('database_functions.php');

$pdo = connect_to_database("hotel");

$sql_usuarios = "SELECT * FROM usuario";

$resultado_usuarios = $pdo->query($sql_usuarios);


?>

<div class="reserva">
  <h4>Usuários Cadastrados</h4>

<table class="table table-hover">
<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Nome</th>
    <th scope="col">CPF</th>
    <th scope="col">E-mail</th>
    <th scope="col">Situação</th>           
  </tr>
</thead>
<tbody>



<?php
$merda= 'aaaaaa';

while ($row = $resultado_usuarios->fetch()) {
echo "\n<tr>".
"<td>".$row['id_usuario']."</td>".
"<td>".$row['Nome']."</td>".
"<td>".$row['cpf']."</td>".
"<td>".($row['email'])."</td>".
"<td>";
    if($row['situacao']==1){
        echo 'Ativo';
    }else{
        echo 'Inativo';
    }
echo "</td>".
"</tr>";

}
echo "</tbody></table>";
?>






<?php 

include('estatico/footer.php');

?>

    