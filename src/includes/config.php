<?php

    $dbHostname = 'db4free.net';
    $dbUsername = 'login_admin';
    $dbPassword = 'loginphp123';
    $dbDataBase = 'loginphp';

    $conn = new mysqli($dbHostname,$dbUsername,$dbPassword,$dbDataBase);

    if($conn -> connect_error){
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    } 
    // else {
    //     echo "Conexão estabelecida com Sucesso!";
    // }

?>