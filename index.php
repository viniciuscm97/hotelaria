<?php
include('estatico/header.php');
?>
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                    <h2 class="display-4">Escolha a opção desejada:</h2>
            </div>

            <div class="card-deck text-center">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Importação</h4>
                        </div>
                        <div class="card-body">
                              <p class="card-text">Menu para realizar a importação de cliente por arquivo .csv</p>
                              <a href="importacao.php" class="btn btn-primary">Acessar</a>
                       </div>
                    </div>

                     <div class="card">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Reserva</h4>
                            </div>
                            <div class="card-body">
                                  <p class="card-text">Menu para realizar a reserva do cliente.</p>
                                  <a href="reserva.php" class="btn btn-primary">Acessar</a>
                            </div>
                    </div>
                
                    <div class="card">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Check-out</h4>
                            </div>
                            <div class="card-body">
                                  <p class="card-text">Menu para realizar o check-out para finalizar a reserva do cliente.</p>
                                  <a href="checkout_buscar_cliente.php" class="btn btn-primary">Acessar</a>
                            </div>
                    </div>
            </div>

            <div class="text-center">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">Transações</h4>
                            </div>
                            <div class="card-body">
                                  <p class="card-text">Menu para consultar transações do PagSeguro</p>
                                  <a href="transacoes.php" class="btn btn-primary">Acessar</a>
                            </div>
                    </div>

            </div>
        
<?php 

include('estatico/footer.php');

?>

    