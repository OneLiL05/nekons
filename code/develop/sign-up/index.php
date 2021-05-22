?php
// Include config file
require_once "../modules/user_db.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Введи логин. Не поверишь, но он нужен.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE name = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Логин занят. Не плачь...";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "А можно БД не ляжет?.. Позязя...";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Введи пароль. Пока я добрый...";
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Ты знал что в пароле должно быть не меньше восьми символов? Нет? Ну, теперь знаешь.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Введи повторно пароль. Не хочешь? Вот и я не хочу давать тебе зарегистрироваться.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Пароли не совпадают. Не лезь менять пароль в почте, просто нужно чтобы поле Пароль и Повтор пароля имели одинаковые значения. (КРУЖОЧКИ НЕ ЗНАЧЕНИЯ!!!)";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (name, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "А можно БД не ляжет?.. Позязя...";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://nekons.html-5.me/css/sign-up-style.css">
    <link rel="stylesheet" href="http://nekons.html-5.me/css/design-system.css">
</head>
<body>
<div id="sign-up">
    <h1 class="primary-heading bottom-space-md">Регистрация</h1>
    <form action="" method="post">
        <div class="form-group bottom-space-xs" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
            <label>
                <p class="top-space-sm bottom-space-xs">Логин</p>
                <input type="text" name="username" id="email-input" placeholder="Логин" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </label>
        </div>
        <div class="form-group bottom-space-xs" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
            <label>
                <p class="top-space-sm bottom-space-xs">Пароль</p>
                <input type="password" name="password" id="password-input" placeholder="Пароль" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </label>
        </div>
        <div class="form-group" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
            <label>
                <p class="top-space-sm bottom-space-xs">Повтор пароля</p>
                <input type="password" name="confirm_password" id="password-input" placeholder="Повторите пароль" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </label>
        </div>
        <div class="buttons-group top-space-md">
            <button type="submit" class="primary-large-button bottom-space-sm">Зарегистрироваться</button>
            <button type="reset" class="secondary-large-button ">Очистить</button>
        </div>
        <div class="sign-up top-space-sm">
            <p>Уже есть аккаунт? <a href="https://nekons.ml/sign-in">Войти</a></p>
        </div>
</div>
</body>
</html>

