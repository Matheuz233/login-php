<?php

   $routes = require "src/includes/routes.php";
   require_once "src/includes/msgError.php";
   require_once "src/includes/function.php";

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
               <div class="msg">
                  Your Email Address was not find!
               </div>
               <form action="forgot.php" method="post">
                  <div class="input">
                     <div class="label">
                        <label for="email">Confirm your Email Address</label>
                     </div>
                     <input type="email" name="email" id="email" required maxlength="200">
                  </div>
                  <button type="submit" name="submit" class="submit">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </section>
</body>

</html>