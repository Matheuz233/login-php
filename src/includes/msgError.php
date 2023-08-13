<?php
    
    class ErrorMessage {
        private static $message = '';

        public static function setMessage($message) {
            self::$message = $message;
        }

        public static function printMessage() {
            if(!empty(self::$message)) {
                echo '<div class="msg">' . self::$message . '</div>';
            }
        }
    }

?>