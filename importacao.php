<?php 
include('estatico/header.php');

?>

<div class="centro">
    
    <form action="processa_importacao.php" method="POST" enctype="multipart/form-data">    
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" accept=".csv">
        <label class="custom-file-label" for="customFile">Escolha o arquivo</label>
        </div>

        <input class="btn btn-success btn-lg" type="submit" value="importar" name="import">
    </form>


</div>


<?php 

include('estatico/footer.php');

?>
