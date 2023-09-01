<?php
    
    class AlertMessage {
        private static $message = '';
        private static $type = '';

        public static function setMessage($message, $type) {
            self::$message = $message;
            self::$type = $type; 
        }

        public static function printMessage() {
    
            if(!empty(self::$message) and !empty(self::$type)) {

                $alerts = [
                    'error' => '--red',
                    'success' => '--green1">'
                ];

                echo '<div class="msg" style="--clr: '. $alerts[self::$type] .'">' . self::$message . '</div>';
            }
        }
    }

?>