<?php

session_start();

$routes = require "src/includes/routes.php";
require_once "src/includes/msgAlert.php";
require_once "src/includes/function.php";

$csrfToken = csrf_token();

function loginUser($email, $password){
    require_once "src/includes/config.php";

    $sql = "SELECT id_user, password_user, first_name_user FROM user WHERE email_user = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id_user, $hashedPassword, $name);
        mysqli_stmt_fetch($stmt);

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["id_user"] = $id_user;
            $_SESSION["name"] = $name;
            $routes = require "src/includes/routes.php";
            header("Location: " . $routes["painel"]);
            exit();
        } 
        else {
            AlertMessage::setMessage("Email Address or Password are Incorrect!", "error");
        }
    } 
    else {
        AlertMessage::setMessage("Email Address or Password are Incorrect!", "error");
    }

    mysqli_stmt_close($stmt);

}

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["csrf_token"]) && hash_equals($_SESSION['csrf_token'], $_POST["csrf_token"])) {
        if (isset($_POST["submit"])) {
            $email = sanitizeInput($_POST["email"]);
            $password = sanitizeInput($_POST["password"]);

            loginUser($email, $password);
        }
    } else {
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
                <img src="./src/img/Audiobook-bro.svg" alt="Audiobook">
            </div>
        </div>

        <div class="content">
            <div class="topSide">
                <p>Not a member? <a href="<?php echo escapeHTML($routes["register"]); ?>">Register now</a></p>
            </div>
            <div class="bottomSide">
                <div class="login">
                    <div class="title">
                        <h1>Sign in to ListEase</h1>
                    </div>

                    <?php AlertMessage::printMessage(); ?>

                    <form action="" method="post">
                        <div class="input">
                            <div class="label">
                                <label for="email">Email Address</label>
                            </div>
                            <input type="email" name="email" id="email" required maxlength="200">
                        </div>
                        <div class="input">
                            <div class="label">
                                <label for="password">Password</label>
                                <a href="<?php echo escapeHTML($routes["forgot"]); ?>">Forgot Password?</a>
                            </div>
                            <input type="password" name="password" id="password" required maxlength="50" minlength="8">
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo escapeHTML($csrfToken) ?>">
                        <button type="submit" name="submit" class="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>