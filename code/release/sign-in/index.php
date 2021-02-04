<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to session page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../mods/session.php");
    exit;
}
 
// Include config file
require_once "../mods/user_db.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Введите логин.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Введите пароль";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = trim($_POST["username"]);                            
                            
                            // Redirect user to session page
                            header("location: ../mods/session.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Неверный пароль.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Неверный логин.";
                }
            } else{
                echo "Хоть бы БД не упала...\nА тебе нужно просто подождать...";
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
    <title>Войти</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sign-in-style.css">
    <link rel="stylesheet" href="../css/design-system.css">
</head>
<body>
        <div id="sign-in">
        <form method="post">
            <h1 class="primary-heading bottom-space-md">Войти</h1>
            <label class="bottom-space-sm">
                <p class="top-space-sm bottom-space-xs">Логин</p>
                <input id="email-input" type="text" placeholder="Логин" name="username" required>
            </label>
            <label>
                <p class="top-space-sm bottom-space-xs">Пароль</p>
                <input id="password-input" type="password" placeholder="Пароль" name="password" required>
            </label>
            <label class="check top-space-sm">
                <input type="checkbox" class="checkbox" name="keep">
                <span class="stylized_checkbox right-space-xs"></span>
                <span class="checkbox-text right-space-xxxl">Запомнить меня</span>
            </label>
            <button type="submit" class="top-space-md" id="login-button">Войти</button>
            <div class="sign-up top-space-sm">
                <p>Нет аккаунта? <a href="../sign-up">Зарегестрироватся</a></p>
            </div>
            </form>
        </div>
</body>
</html>
