<?php 

require('database_functions.php');

$pdo = connect_to_database("hotel");



if (isset($_POST["import"])) {
    
    $fileName = $_FILES["arquivo"]["tmp_name"];
    
    if ($_FILES["arquivo"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($coluna = fgetcsv($file, 10000, ",")) !== FALSE) {


            $id_usuario = $coluna[0];
            $sql_tratamento = "SELECT * from usuario where id_usuario ='$id_usuario'";
            $resultado_tratamento = $pdo->query($sql_tratamento);
            $busca = $resultado_tratamento->fetchAll();

            if (count($busca)!='0' && $coluna[4] == '0'){
                $status = '0';
                $sql_insert = "UPDATE `usuario` SET `situacao` = :situacao WHERE id_usuario = :id_usuario;";
                $resultado = $pdo->prepare($sql_insert);

                $dados = array(':situacao' => $status,
                ':id_usuario' => $coluna[0]);

                $resultado->execute($dados);
                

            }

            if (count($busca)=='0'){
                $sql = "INSERT into usuario (id_usuario,nome,cpf,email,situacao)
                values ('" . $coluna[0] . "','" . $coluna[1] . "','" . $coluna[2] . "','" . $coluna[3] . "','" . $coluna[4] . "')";
                $resultado = $pdo->query($sql);
                $row = $resultado->fetch();
    

            }




            
            if (! empty($resultado)) {          
                echo "<script>alert('Importação realizada com sucesso!');
                top.location.href='index.php';
                </script>";  
            } else {
                echo "<script>alert('Erro na importação!');
                top.location.href='index.php';
                </script>";  
            }
        }
    }
}

?>


