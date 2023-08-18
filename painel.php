<?php

session_start();

$routes = require "src/includes/routes.php";
require_once "src/includes/function.php";

verify_login();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListEase</title>
    <link rel="icon" href="./src/img/logo.png">
    <link rel="stylesheet" href="./src/css/style.css">
</head>

<body>

    <h1>Bem Vindo <?php echo escapeHTML($_SESSION["name"]); ?>!</h1>

    <a href="<?php echo escapeHTML($routes["logout"]); ?>">Log Out</a>

</body>

</html>