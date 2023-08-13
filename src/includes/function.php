<?php

    function sanitizeInput($input) {
        return trim($input);
    }
    
    function escapeHTML($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    
?>