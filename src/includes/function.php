<?php

    function sanitizeInput($input) {
        return trim($input);
    }
    
    function escapeHTML($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    
    function csrf_token() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];    
    }
    function verify_login(){
        if(!isset($_SESSION["id_user"])){
            $routes = require "src/includes/routes.php";
            header("Location: " . $routes["login"]);
            exit();
        }
    }

?>