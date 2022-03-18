<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (!empty($password) && !empty($email)) {
    //read from db
    $query = "SELECT * FROM users WHERE email = '$email' limit 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
      if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['password'] === md5($password)) {
          $_SESSION['id']=$user_data['id'];
          header("Location: index.php?token=true");
          die;
        } else {
          echo '<script language="javascript">';
          echo 'alert("Грешна парола!")';
          echo '</script>';
        }
      } else {
        echo '<script language="javascript">';
        echo 'alert("Имейлът не съществува!")';
        echo '</script>';
      }
    }
  } else {
    echo "Please enter some valid information!";
  }
}
?>
<!DOCTYPE html>
<html lang="bg">

<head>
  <meta charset="UTF-8">
  <title>LOGIN</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="python-logo.png" type="image/x-icon">
  <style>
    #logo {
      text-decoration: none;
    }
    #forgot_password-p{
      text-align: left;
    }
    #forgot_password{
      font-size: 20px;
    }
  </style>
</head>

<body>

  <div id="login-form-wrap">
    <a href="index.php" id="logo">
      <h2>Let's learn Python!</h2>
    </a>
    <h2>Вход</h2>
    <form id="login-form" method="post" action="">
      <p>
        <input type="email" id="email" name="email" placeholder="Имейл адрес" required><i class="validation"><span></span><span></span></i>
      </p>
      <p>
        <input type="password" id="password" name="password" placeholder="Парола" required><i class="validation"><span></span><span></span></i>
        <!--
        <p id="forgot_password-p"> <a href="forgot_password.php" id="forgot_password">Забравена парола?</a>
  -->
      </p>
      <p>
        <input type="submit" id="login" value="Вход">
      </p>
    </form>
    <div id="create-account-wrap">
      <p>Нямаш акаунт? <a href="registration.php">Направи си!</a>
      <p>
    </div>
  </div>

</body>

</html>