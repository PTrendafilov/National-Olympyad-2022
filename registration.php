<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $query_em = "SELECT * FROM users WHERE email = '$email' limit 1";
    $res_em = mysqli_query($conn, $query_em);
    $query_us = "SELECT * FROM users WHERE username = '$username' limit 1";
    $res_us = mysqli_query($conn, $query_us);
    $containsLetter  = preg_match('/[a-zA-Z]/',    $password);
    $containsDigit   = preg_match('/\d/',          $password);
    $containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);
    if ($containsDigit==0 || $containsLetter==0 || $containsSpecial==0) {
        echo '<script language="javascript">';
        echo 'alert("Паролата е твърде слаба! Моля въведете парола с поне една цифра, буква и специален символ!")';
        echo '</script>';
    } else if (strlen($password) < 6) {
        echo '<script language="javascript">';
        echo 'alert("Паролата е твърде кратка! Моля въведете парола с повече от 6 символа!")';
        echo '</script>';
    } else if ($password != $repassword) {
        echo '<script language="javascript">';
        echo 'alert("Паролите не съвпадат!")';
        echo '</script>';
    } else if ($res_em && mysqli_num_rows($res_em) > 0) {
        echo '<script language="javascript">';
        echo 'alert("Имейлът е вече използван. Моля въвъдете валиден имейл!")';
        echo '</script>';
    } else if ($res_us && mysqli_num_rows($res_us) > 0) {
        echo '<script language="javascript">';
        echo 'alert("Потръбителското име вече е използвано. Моля въведете друго потребителско име!")';
        echo '</script>';
    }
    //save to db
    else {
        $query = "INSERT INTO users (email, password, username) values ('$email', '" . md5($password) . "', '$username')";
        mysqli_query($conn, $query);
        header("Location: login.php");
        die;
    }
}
?>
<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <title>REGISTRATION</title>
    <link rel="icon" href="python-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        #logo {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div id="login-form-wrap">
        <a href="index.php" id="logo">
            <h2>Let's learn Python!</h2>
        </a>
        <h2>Регистрация</h2>
        <form id="login-form" method="post">
            <p>
                <input type="email" id="email" name="email" placeholder="Имейл адрес" required><i class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="text" id="username" name="username" placeholder="Потребителско име" required><i class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Въведи парола" required><i class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="password" id="repassword" name="repassword" placeholder="Повтори паролата" required><i class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="submit" id="login" value="Регистрирация">
            </p>
        </form>
        <div id="create-account-wrap">
            <p>Имаш акаунт? <a href="lgc.php">Влез!</a>
            <p>
        </div>
    </div>

</body>

</html>