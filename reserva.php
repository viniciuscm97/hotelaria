<?php 
include('estatico/header.php');

?>
<?php

require('database_functions.php');

$pdo = connect_to_database("hotel");

$sql_usuarios = "SELECT * FROM usuario";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$resultado_usuarios = $query_usuarios->fetchAll();

$sql_quartos = "SELECT * FROM quartos";
$query_quartos = $pdo->prepare($sql_quartos);
$query_quartos->execute();
$resultado_quartos = $query_quartos->fetchAll();

$query_quartos_esc = $pdo->prepare($sql_quartos);
$query_quartos_esc->execute();

$resultado_quartos_esc = $query_quartos_esc->fetchAll();


?>
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Quartos disponiveis</span>
      </h4>
      <ul class="list-group mb-3">

       <?php foreach ($resultado_quartos as $resultado_quartos){
            if($resultado_quartos['disponivel'] == 1):
            ?>

            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"> <?php echo $resultado_quartos['tipo'] ?> </h6>
                <small class="text-muted">Número: <?php echo $resultado_quartos['numero'] ?></small>
                <small class="text-muted">Capacidade: <?php echo $resultado_quartos['capacidade'] ?></small>
              </div>
              <span class="text-muted">R$<?php echo $resultado_quartos['valor'] ?></span>
            </li>
            
       <?php endif;  } ?>

      </ul>
    </div>

<div class="col-md-7">
      <h4 class="mb-3">Cadastro de reserva</h4>
      <form method="POST" action="processa_reserva.php">

        <div class="mb-3">
          <label for="cliente">Cliente:</label>
            <select class="custom-select d-block w-100" id="cliente" name="cliente" required>
                <option value="">Escolha...</option>

                <?php foreach ($resultado_usuarios as $resultado_usuarios){
                    ?>
                    <option value="<?php echo $resultado_usuarios['id_usuario'] ?>"> <?php echo $resultado_usuarios['Nome'] ?></option>
                <?php  } ?>
            </select>
        </div>

        <div class="mb-3">
          <label for="quarto">Quarto:</label>
            <select class="custom-select d-block w-100" id="quarto" name="quarto" required>
              <option value="">Escolha...</option>

              <?php foreach ($resultado_quartos_esc as $resultado_quartos_esc){
                    if($resultado_quartos_esc['disponivel'] == 1):
                     ?>              

                    <option value="<?php echo $resultado_quartos_esc['id_quartos'] ?>"> <?php echo $resultado_quartos_esc['tipo'] ?> </option>
                <?php endif; } ?>
            </select>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="entrada">Data de entrada:</label>
            <input name="dataEntrada" class="form-control" type="datetime-local" value="AAAA-MM-DDT00:00:00" id="dataEntrada" required>
          </div>
          <div class="col-md-5 mb-3">
            <label for="saida">Data de saída:</label>
            <input name="dataSaida" class="form-control" type="datetime-local" value="AAAA-MM-DDT00:00:00" id="dataSaida" required>
            
          </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar reserva</button>
      </form>
    </div>
  </div>


<?php 

include('estatico/footer.php');

?>
