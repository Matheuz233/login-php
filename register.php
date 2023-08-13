<?php

    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;

    $routes = require "src/includes/routes.php";
    require_once "src/includes/msgError.php";
    require_once "src/includes/function.php";
    
    function registerUser($firstName, $lastName, $email, $password) {
        
        require_once "src/includes/config.php";

        $sql = "SELECT id_user FROM user WHERE email_user = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0) {
            ErrorMessage::setMessage("Email has already been registered!");
        }
        else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO user (first_name_user, last_name_user, email_user, password_user) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssss', $firstName, $lastName, $email, $hashedPassword);

            if(mysqli_stmt_execute($stmt)) {
                $routes = require "src/includes/routes.php";
                header('Location: ' . $routes["home"]);
                exit();
            }
            else {
                ErrorMessage::setMessage("Erro ao registrar usuário. Por favor, tente novamente.");
            }

        }

        mysqli_stmt_close($stmt);
    }
    
?>

<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
            if(isset($_POST['submit']) && ($_POST['password'] == $_POST['confirmPassword'])) {
                $firstName = sanitizeInput($_POST['name']);
                $lastName = sanitizeInput($_POST['lastName']);
                $email = sanitizeInput($_POST['email']);
                $password = sanitizeInput($_POST['password']);
    
                registerUser($firstName, $lastName, $email, $password);
            }
            else {
                ErrorMessage::setMessage("Password is different from confirm password!");
            }
        }
        else {
            ErrorMessage::setMessage("CSRF token validation failed.");
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EaseList</title>
        <link rel="icon" href="./src/img/logo.png">
        <link rel="stylesheet" href="./src/css/style.css">
    </head>

    <body>
        <section class="container">
            <div class="sidebar">
                <div class="logo">
                    <a href="<?php echo escapeHTML($routes["home"]); ?>"><img src="./src/img/logo.png" alt="EaseList"></a>
                </div>
                <div class="text">
                    <p>Empower your life embrace organization with Listeasy</p>
                </div>
                <div class="ilustracao">
                    <img src="./src/img/Audiobook-bro.svg" alt="Audiobook">
                </div>
            </div>

            <div class="content">
                <div class="topSide">
                    <p>Are you a member? <a href="<?php echo escapeHTML($routes["login"]); ?>">Sign in</a></p>
                </div>
                <div class="bottomSide">
                    <div class="login">
                        <div class="title">
                            <h1>Register Now to ListEase</h1>
                        </div>

                        <?php ErrorMessage::printMessage(); ?>

                        <form action="" method="post">
                            <div class="inputs">
                                <div class="inputs-2">
                                    <div class="input">
                                        <div class="label">
                                            <label for="name">Name</label>
                                        </div>
                                        <input type="text" name="name" id="name" required maxlength="200">
                                    </div>
                                </div>
                                <div class="inputs-2">
                                    <div class="input">
                                        <div class="label">
                                            <label for="lastName">Last Name</label>
                                        </div>
                                        <input type="text" name="lastName" id="lastName" required maxlength="200">
                                    </div>
                                </div>
                            </div>
                            <div class="input">
                                <div class="label">
                                    <label for="email">Email Address</label>
                                </div>
                                <input type="email" name="email" id="email" required maxlength="200">
                            </div>
                            <div class="input">
                                <div class="label">
                                    <label for="password">Password</label>
                                </div>
                                <input type="password" name="password" id="password" required maxlength="50" minlength="8">
                            </div>
                            <div class="input">
                                <div class="label">
                                    <label for="confirmPassword">Confirm the Password</label>
                                </div>
                                <input type="password" name="confirmPassword" id="confirmPassword" required maxlength="50" minlength="8">
                            </div>
                            <input type="hidden" name="csrf_token" value="<?php echo escapeHTML($csrfToken); ?>">
                            <button type="submit" name="submit" class="submit">Register Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
