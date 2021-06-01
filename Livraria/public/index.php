<?php
    session_start();
    
    include './../app/configuracao.php';
    include './../app/autoload.php';
    /*
    $db = new Database;

    $id = 12;
    $nome = 'John';
    $email = 'john.com';
    $senha = 'senha';

    //$db->query("UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
    //$db->query("DELETE FROM usuario WHERE id = :id");

    $db->bind(":id", $id);
    $db->bind(":nome", $nome);
    $db->bind(":email", $email);
    $db->bind(":senha", $senha);

    $db->executa();

    echo '<hr>Total Resultados: '.$db->totalResultados();

    */
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo APP_NOME ?></title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo URL?>/public/css/estilos.css" rel="stylesheet">
    </head>

    <body>
        <?php

            include '../app/Views/topo.php';
            $rotas = new Rota();
            include '../app/Views/rodape.php'; 

            // https://www.youtube.com/watch?v=vRKVk6jthiQ&list=PL0N5TAOhX5E-NZ0RRHa2tet6NCf9-7B5G&index=46 // David
            // https://www.youtube.com/watch?v=nYZPv0bRdwc&list=PLSYIyzca1f9wGynWlC-SH2lVBkE8S81A0&index=4 // Eu
        
        ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>  
        <script src="<?php echo URL?>/public/js/jquery.funcoes.js"></script>  

    </body>
</html>