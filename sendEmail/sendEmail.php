<?php

    function sendEmail($to, $name, $subject, $content) {
        require "includes/config.php";  
        require 'vendor/autoload.php';

        $sendgrid = new \SendGrid(CHAVE_API); // Substitua pela sua chave de API

        $from = new \SendGrid\Mail\From('listeasybot@gmail.com', 'ListEase');
        $to = new \SendGrid\Mail\To($to, $name);
        $content = new \SendGrid\Mail\HtmlContent($content);

        $mail = new \SendGrid\Mail\Mail($from, $to, $subject, $content);

        try {
            $sendgrid->send($mail);
        } 
        catch (Exception $e) {
            echo 'Erro ao enviar o e-mail: ' . $e->getMessage();
        }
    }

    function registerEmail($to, $name) {
        $subject = "Confirmação de Registro no EaseList";
        $content = '
            <div>
                <div>
                    <img src="https://i.ibb.co/ngthjV4/logo.png" height="120px">
                </div>

                <div>
                    <h3 style="font-size: 1.5rem;">Olá ' . $name . ',</h3>
                    <p style="font-size: 1.2rem;">Parabéns por se registrar no ListEase! Estamos felizes em tê-lo(a) a bordo.</p>
                    <p style="font-size: 1.2rem;">Sua conta foi criada com sucesso. Aguarde futuras atualizações e novidades emocionantes à medida que continuamos a desenvolver nossa plataforma.</p>
                    <p style="font-size: 1.3rem;">Atenciosamente, <b>Equipe ListEase</b></p>
                </div>
            </div>
        ';


        sendEmail($to, $name, $subject, $content);
    }

?>