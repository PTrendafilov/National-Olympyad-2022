<?php
session_start();
include "crud_problems_config.php";
include("connection.php");
include("functions.php");
$userdata = check_login($conn);
$created_by = $userdata['username'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $problem_condition = $_POST['problem_condition'];
        $input = $_POST['input'];
        $output = $_POST['output'];
        $hints = $_POST['hints'];
        $title = $_POST['title'];
    }

    $sql = "INSERT INTO problems (problem_condition, title, input, output, hints, created_by) values ('$problem_condition','$title', '$input', '$output', '$hints', '$created_by')";

    $result = $con->query($sql);

    if ($result == true) {
        header("Location: index.php?token=true");
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }

    $con->close();
}


?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="python-logo.png" type="image/x-icon">
    <style>
        #login-form-wrap{
            width:50%;
        }
        textarea {
            display: block;
            box-sizing: border-box;
            width: 100%;
            outline: none;
            height: 100px;
            line-height: 30px;
            border-radius: 4px;
            resize: none;
        }

        textarea {
            width: 80%;
            padding: 0 0 0 10px;
            margin: 0;
            color: black;
            border: 1px solid #c2c0ca;
            font-style: normal;
            font-size: 20px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            position: relative;
            display: inline-block;
            background: none;
        }

        textarea:focus {
            border-color: #3ca9e2;
        }
        fieldset{
            border-width: 0px;
        }
        textarea{
            margin-bottom: 25px;
        }
        legend{
            margin-bottom: 10px;
        }
        #first_legend{
            width: 100%;
        }
        input[type="submit"]{
            width: 80%;
        }
    </style>
    <title>Document</title>
</head>

<body>

    <div id="login-form-wrap">
    <a href="index.php?token=true" id="logo">
      <h2>Let's learn Python!</h2>
    </a>
        <h2>Създай задача</h2>
        <form action="" method="POST">
            <fieldset>
                <legend id="first_legend">Заглавие:</legend>
                <textarea type="text" name="title"></textarea>
                <legend>Условие на задачата:</legend>
                <textarea type="text" name="problem_condition"></textarea>
                <legend>Входни данни:</legend>
                <textarea type="text" name="input"></textarea>
                <legend>Изходни данни:</legend>
                <textarea type="text" name="output"></textarea>
                <legend>Подсказки:</legend>
                <textarea type="text" name="hints"></textarea>
                <br><br>
                <input type="submit" name="submit" value="Създай задачата!">
            </fieldset>
        </form>
</body>

</html>