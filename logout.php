<?php

    $routes = require "src/includes/routes.php";

    session_start();
    session_unset();
    session_destroy();
    header("Location: " . $routes["login"]);
    exit();
    
?>