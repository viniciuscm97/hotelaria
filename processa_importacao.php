<?php 

require('database_functions.php');

$pdo = connect_to_database("hotel");

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["arquivo"]["tmp_name"];
    
    if ($_FILES["arquivo"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($coluna = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sql = "INSERT into usuario (nome,cpf,email)
                   values ('" . $coluna[0] . "','" . $coluna[1] . "','" . $coluna[2] . "')";
            $resultado = $pdo->query($sql);
            $row = $resultado->fetch();
            
            
            if (! empty($resultado)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
                echo "<script>alert('Cliente importado com sucesso!');
                top.location.href='index.php';
                </script>";  
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
                echo "<script>alert('Erro na importação!');
                top.location.href='index.php';
                </script>";  
            }
        }
    }
}

?>


