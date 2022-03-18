<?php
session_start();
include "crud_problems_config.php";
include("connection.php");
include("functions.php");
$userdata=check_login($conn);
if($userdata['username']!=""){
    $created_by=$userdata['username'];
}else{
    header("Location: login.php");
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $problem_condition = $_POST['problem_condition'];
    $input = $_POST['input'];
    $output = $_POST['output'];
    $hints = $_POST['hints'];
    $id=$_GET['id'];
    $sql = "UPDATE problems SET title='$title', problem_condition = '$problem_condition', input='$input', output='$output', hints='$hints'  WHERE id='$id' and created_by='$created_by'";
    $result = $con->query($sql);
    if ($result == True) {
        header("Location: crud_problems_view.php?token=true");
    } else {
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM problems WHERE id='$id'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $problem_condition = $row['problem_condition'];
            $input = $row['input'];
            $output = $row['output'];
            $hints = $row['hints'];
        }
?>
<!DOCTYPE html>
<html lang="bg">
<head>
<link rel="icon" href="python-logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
</head>
<body>
    <div id="login-form-wrap">
    <a href="index.php?token=true" id="logo">
      <h2>Let's learn Python!</h2>
    </a>
        <h2>Редактиране на задачата</h2>
        <form action="" method="post">
            <fieldset>
            Заглавие: <br>
            <textarea type="text" name="title" value=""><?php echo $title; ?></textarea><br>
            Условие на задачата: <br>
            <textarea type="text" name="problem_condition"><?php echo $problem_condition; ?></textarea>
            <br>
            Входни данни: <br>
            <textarea type="text" name="input" value=""><?php echo $input; ?></textarea><br>
            Изходни данни: <br>
            <textarea type="text" name="output" value=""><?php echo $output; ?></textarea><br>
            Подсказки: <br>
            <textarea type="text" name="hints" value=""><?php echo $hints; ?></textarea><br>
            <input type="submit" value="Update" name="update">
            </fieldset>
        </form>
    </div>
</body>
</html>


<?php
    }else{
        echo $sql;
        echo "<br>".$result->num_rows;
    }
}
?>