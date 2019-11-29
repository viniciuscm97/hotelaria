<?php 
include('estatico/header.php');

?>
<?php

require('database_functions.php');

$pdo = connect_to_database("hotel");

$idusuario = $_POST['cliente'];
$sql_reserva = "SELECT q.valor as valor_quarto,q.numero as numero_quarto,q.tipo as tipo_quarto,r.* from quartos q join reserva r on r.id_quartos=q.id_quartos where id_usuario = '$idusuario';";

$resultado_reserva = $pdo->query($sql_reserva);

$resultado_reserva_total = $pdo->query($sql_reserva);
$linhas = $resultado_reserva_total->fetch();



$sql_usuarios = "SELECT * FROM usuario where id_usuario = '$idusuario'; ";

$resultado_usuarios = $pdo->query($sql_usuarios);
$linhas_usuarios = $resultado_usuarios->fetch();

?>

<form method="POST" action="transacao_pagseguro.php"> 
<div class="reserva">
<h4>Dados do cliente</h4>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10 ">
      <input type="text" name="idcliente" readonly class="form-control-plaintext"  value="<?php echo $linhas_usuarios['id_usuario'] ?>">
    </div>
  </div>

  <hr>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
    <input type="text" readonly class="form-control-plaintext"  value="<?php echo $linhas_usuarios['Nome'] ?>">
    </div>
  </div>
  <hr>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">CPF</label>
    <div class="col-sm-10">
    <input type="text" readonly class="form-control-plaintext"  value="<?php echo $linhas_usuarios['cpf'] ?>">
    </div>
  </div>
  <hr>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">E-mail</label>
    <div class="col-sm-10">
    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $linhas_usuarios['email'] ?>">
    </div>
  </div>

</div>
<hr class="mb-4">

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

</div>
<hr class="mb-4">

<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
    
  <h4 class="d-flex justify-content-between align-items-center mb-3">
          <h4>Finalizar Pagamento:</h4>
        </h4>
        
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Reserva</h6>
                <small class="text-muted">Diárias: <a  name=""><?php echo $linhas['num_diarias'] ?></a></small>
                
                <br>
                <small class="text-muted">Valor do quarto: <a  name="" ><?php echo $linhas['valor_quarto'] ?></a></small>
              </div>
              <span class="text-muted">R$<a  name="total" ><?php echo $linhas['total'] ?></a></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$8</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (R$)</span>
              <strong name="valor_total">R$<?php echo $linhas['total'] ?>  </strong>
            </li>
          </ul>
          <button class="btn btn-success btn-lg" type="submit">Pagamento via PagSeguro</button>       

          </form>
          </div>
        </div>


<?php 

include('estatico/footer.php');

?>
