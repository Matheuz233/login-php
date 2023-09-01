<?php

   session_start();

   $routes = require "src/includes/routes.php";
   require_once "src/includes/msgAlert.php";
   require_once "src/includes/function.php";

   $csrfToken = csrf_token();

?>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            if(isset($_POST['submit']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = sanitizeInput($_POST['email']);
   
                forgotUser($firstName, $lastName, $email, $password);
            }
            else {
                  AlertMessage::setMessage("Put a valid email.", "error");
            }
        }
        else {
            AlertMessage::setMessage("CSRF token validation failed.", "error");
        }
    }

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
   <section class="container">
      <div class="sidebar">
         <div class="logo">
            <a href="<?php echo escapeHTML($routes["home"]); ?>"><img src="./src/img/logo.png" alt="ListEase"></a>
         </div>
         <div class="text">
            <p>Conquer tasks effortlessly</p>
            <p>Let ListEase be your guide</p>
         </div>
         <div class="ilustracao">
            <img src="./src/img/Forgot password-bro.svg" alt="Audiobook">
         </div>
      </div>

      <div class="content">
         <div class="topSide">
            <p>Are you a member? <a href="<?php echo escapeHTML($routes["login"]); ?>">Sign in</a></p>
         </div>
         <div class="bottomSide">
            <div class="login">
               <div class="title">
                  <h1>Forgot Password</h1>
               </div>
               
               <?php AlertMessage::printMessage(); ?>

               <form action="forgot.php" method="post">
                  <div class="input">
                     <div class="label">
                        <label for="email">Confirm your Email Address</label>
                     </div>
                     <input type="email" name="email" id="email" required maxlength="200">
                  </div>
                  <input type="hidden" name="csrf_token" value="<?php echo escapeHTML($csrfToken); ?>">
                  <button type="submit" name="submit" class="submit">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </section>
</body>

</html>