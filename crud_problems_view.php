<?php
    session_start();
    include "crud_problems_config.php";
    include("connection.php");
    include("functions.php");
    $userdata=check_login($conn);
    $created_by=$userdata['username'];
    $sql = "SELECT * FROM problems WHERE created_by='$created_by'";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="python-logo.png" type="image/x-icon">
    <style>
        h2{
            text-align: center;
        }
        #sign-out{
            margin-top: 50px;
            width: 30%;
            border: 0px;
            background-color:#dc3545;
            color: white;
            font-size: 24px;
            margin-left: 35%;
        }
        #sign-out:hover{
            background-color:#e00f24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Мои задачи</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Заглавие</th>
                    <th>Условие на задачата</th>
                    <th>Входни данни</th>
                    <th>Изходни данни</th>
                    <th>Подсказки</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){

                ?>
                <tr>
                    <td>
                        <?php
                            echo $row['title'];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row['problem_condition'];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row['input'];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row['output'];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row['hints'];
                        ?>
                    </td>
                    <td><a class="btn btn-info" href="crud_problems_update.php?id=<?php echo $row['id']; ?>?token=true">
                        Edit
                    </a>&nbsp;<a class="btn btn-danger" href="crud_problems_delete.php?id=<?php echo $row['id'];?>?token=true">
                        Delete
                    </a></td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="index.php">
        <button id="sign-out">
            Излез от профила
        </button>
    </a>
    </div>
</body>
</html>