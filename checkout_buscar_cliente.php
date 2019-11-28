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
