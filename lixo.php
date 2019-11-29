<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         
<select id="cidade2">
    <option value=""></option>
    <option value="scs">São Caetano do Sul</option>
    <option value="sa">Santo André</option>
    <option value="sbc">São Bernardo do Campo</option>
</select>

<input type="button" id="btnCarregar" value="Carregar combobox" />

<input type="button" id="btnInfo" value="Valor selecionado" />

<script>

var valor = document.getElementById('cidade2');
console.log(valor);
var resultado = valor.options[valor.selectedIndex].value;
$.post('converte.php', {resultado: resultado}, function(data){ 
$('#mostrar').html(data);
      });







      <! -- <input type="submit" class="btn btn-secondary btn-lg" value="Adicionar consumação"> --
</script>

<?php
$ValorPhp = $_POST["resultado"];
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
         
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                  crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                  crossorigin="anonymous"></script>       
          
          </body>
      </html>
      


      /////////////////


      $sql_insert = "UPDATE `transacoes_pagseguro` SET `id_situacao` = :id_situacao WHERE `transacoes_pagseguro`.`id_transacao_pagseguro` = :id_pagseguro;";
$resultado = $pdo->prepare($sql_insert);

$dados = array(':id_situacao' => $status,
':id_pagseguro' => $reference);

$resultado->execute($dados);