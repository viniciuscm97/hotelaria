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

?>

<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Resumo de consumo:</span>
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
      <h3 class="mb-3">CHECKOUT</h3>
      <form method="POST" action="finaliza_checkout.php">

      <div class="mb-3">
       
              <select class="custom-select d-block w-100" id="cliente" name="cliente" required>
                  <option value="">Escolha o cliente aqui...</option>

                  <?php foreach ($resultado_usuarios as $resultado_usuarios){
                      ?>
                      <option value="<?php echo $resultado_usuarios['id_usuario'] ?>"> <?php echo $resultado_usuarios['Nome'] ?></option>
                  <?php  } ?>
              </select>
      </div>
      <hr class="mb-4">
      <input class="btn btn-success btn-lg" type="submit" value="Enviar">
      
      </form>

    </div>
  </div>

<?php 

include('estatico/footer.php');

?>
