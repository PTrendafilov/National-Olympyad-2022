<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test System</title>
    <link rel="icon" href="python-logo.png" type="image/x-icon">
    <style>
        @import url('http://fonts.cdnfonts.com/css/roboto');

        .condition {
            font-family: "Roboto";
        }
        .logo {
            font-family: "Roboto";
        }
        .condition h2{
            font-weight: normal;
        }
        .btn{
            font-family: "Roboto";
        }
        * {
            margin: 0;
        }

        .header {
            text-align: left;
            font-size: 20px;
            font-weight: bold;
            padding: 4px;
            font-family: sans-serif;
        }

        .editor {
            color: white;
            height: 400px;
        }

        .button-container {
            padding: 4px;
        }

        .btn {
            display: block;
            width: 50%;
            color: black;
            padding: 8px;
            border: 0;
            margin: auto;
            background-color: #329dd5;
            font-size: 24px;
            border: 1px solid black;
            margin-top: 15px;
            margin-bottom: 15px;
            color:white;
        }

        .btn:hover {
            background-color: #3ca9e2;
            cursor: pointer;
        }

        .output {
            border-top: 2px solid black;
            min-height: 100px;
            width: 99%;
            resize: none;
        }

        .condition {
            text-align: center;
        }

        .editor {
            width: 50%;

        }

        .editor-container {
            width: 100%;
            margin-left: 25%;
        }

        body {
            background-color: rgb(235, 235, 235);
        }

        .condition {
            font-size: 20px;
        }

        .output {
            margin: auto;
            width: 50%;
            background-color: #272822;
            color: white;
            font-size: 24px;
            text-align: center;
        }

        .header {
            font-weight: normal;
            font-size: 32px;
            text-align: center;
            margin-top: 15px;
        }

        .logo {
            color: #329dd5;
            text-decoration: none;
        }
    </style>
    <script>
        let editor;
        window.onload = function() {
            editor = ace.edit("editor");
            editor.setTheme("ace/theme/monokai");
            editor.session.setMode("ace/mode/python");
        }

        function executeCode() {
            $.ajax({
                url: "compiler.php",

                method: "POST",

                data: {
                    code: editor.getSession().getValue(),
                    id: <?php echo $_GET['id'] ?>
                },

                success: function(response) {
                    $(".output").text(response)
                }
            })
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "crud_problems_config.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM problems WHERE id='$id'";
        $result = $con->query($sql);
        if ($result == True) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $problem_condition = $row['problem_condition'];
        } else {
            echo "Error:" . $sql . "<br>" . $con->error;
        }
    }
    ?>

    <div class="header">
        <a href="index.php" class="logo">
            Let's learn Python!
        </a>
    </div>
    <br><br>
    <div class="condition">
        <h2>
            <?php
            echo $title;
            ?>
        </h2>
        <br><br>
        <div>
            <?php
            echo $problem_condition;
            ?>
        </div>
    </div><br><br><br>
    <div class="editor-container">
        <div class="editor" id="editor">

        </div>
    </div>

    <pre class="output"></pre>
    <button class="btn" onclick="executeCode()"> Провери </button>
    <script src="lib/ace.js"></script>
    <script src="lib/theme-monokai.js"></script>
</body>

</html>