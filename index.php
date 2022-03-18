<?php
session_start();
$_SESSION;
include("connection.php");
include("functions.php");
if (isset($_GET['token'])) {
  $account = "Акаунт";
  $userdata = check_login($conn);
  if ($userdata == "") {
    echo "Error";
    die;
  }
} else {
  $account = "Влез";
}
?>
<!DOCTYPE html>
<html lang="bg">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Let's learn Python!</title>
  <link rel="icon" href="python-logo.png" type="image/x-icon">
  <style>
    @import url('http://fonts.cdnfonts.com/css/roboto');
*{
  font-family: "Roboto";
}
    h2 {
      font-weight: normal;
      padding-left: 0;
      margin: 0;
      padding-top: 100px;
      display: block;
      font-size: 28px;
      text-align: center;
    }


    hr {
      margin-left: 100px;
      margin-right: 100px;
      color: black;
      height: 2px;
      background-color: black;
    }

    .lessons_themes {
      padding-left: 0px;
      width: 100%;
      text-align: center;
    }

    .lessons_themes li a {
      color: black;
      font-size: 20px;
      text-decoration: none;
    }

    h3 {
      color: black;
      font-size: 26px;
      font-weight: normal;
    }

    #first-steps {
      text-align: center;
      text-decoration: none;
    }

    #first-steps-box {
      display: inline-block;
      width: 270px;
      text-align: justify;
    }

    #beginners-box,
    #students-box,
    #advanced-box {
      display: inline-block;
      width: 260px;
      text-align: justify;
      padding-left: 105px;
    }

    #beginners,
    #students,
    #advanced {
      text-align: center;
      text-decoration: none;
    }

    #advanced-box {
      width: 220px;
    }

    .first-row,
    .second-row {
      display: inline-block;
    }

    .header li a:hover,
    .header .menu-btn:hover {
      background-color: #3ca9e2;
    }

    .header ul {
      background-color: #329dd5;
    }

    .header {
      background-color: #329dd5;
    }

    @media (max-width: 815px) {

      #students-box,
      #advanced-box {
        padding-left: 0px !important;
      }

      #beginners-box {
        padding-left: 0px;
      }
    }

    @media (max-width: 1500px) {

      #students-box,
      #advanced-box {
        padding-left: 40px;
      }

      #beginners-box {
        padding-left: 0px;
      }

      .first-row,
      .second-row {
        display: block;
      }

      #advanced-box {
        width: 260px;
      }
    }

    .created_problems {
      text-decoration: none;
      color: black;
    }

    .table {
      margin-left: auto;
      margin-right: auto;
    }

    .created-problems-a {
      text-decoration: none;
      color: black;
    }

    th {
      font-size: 24px;
      font-weight: normal;
      /*
      padding-right: 100px;
      */
    }

    .created-problems-a {
      font-size: 32px;
      color: #329dd5;
    }

    .created-problems-a:hover {
      color: blue;
    }

    h2 {
      font-size: 48px;
      margin-left: -4%;
    }
  </style>
</head>

<body>
  <header class="header">
    <a href="" class="logo">Let's learn Python!</a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
      <li><a href="<?php
                    if (isset($_GET['token']) & isset($userdata['username'])) {
                      if ($userdata['username'] != "") {
                        echo "crud_problems_create.php?token=true";
                      }
                    } else {
                      echo "registration.php";
                    }
                    ?>">Създаване на задача</a></li>
      <li><a href="<?php
                    if ($account == "Акаунт") {
                      echo "crud_problems_view.php?token=true";
                    } else {
                      echo "lgc.php";
                    }
                    ?>">
          <?php
          if ($account == "Акаунт") {
            echo $userdata['username'];
          } else {
            echo "Вход";
          } ?>
        </a></li>
      <!--
    <img src="https://img.icons8.com/external-tal-revivo-regular-tal-revivo/24/000000/external-online-web-sign-in-or-login-portal-login-regular-tal-revivo.png"/></ul>
 -->
  </header>
  <main>
    <!--
    <div class="categorries">
      <h2>Категории</h2>
      <hr>
      <div class="lessons_themes">
        <div class="first-row">
          <div id="first-steps-box">
            <a href="" id="first-steps">
              <h3>Първи Програми</h3>
            </a>
            <ul>
              <li><a href="">Извеждане в конзолата</a></li>
              <li><a href="">Въвеждане в конзолата</a></li>
              <li><a href="">Прости операции</a></li>
              <li><a href="">Данни от тип int</a></li>
              <li><a href="">Данни от тип float</a></li>
              <li><a href="">Данни от тип string</a></li>
            </ul>
          </div>
          <div id="students-box">
            <a href="" id="students">
              <h3>За Ученици</h3>
            </a>
            <ul>
              <li><a href="">Лесни Анимации</a></li>
              <li><a href="">Създаване на Въпросник</a></li>
              <li><a href="">По-Сложни Анимации</a></li>
              <li><a href="">Чертаене на Фигури</a></li>
              <li><a href="">Създаване на Герой</a></li>
              <li><a href="">Движение на Героя</a></li>
            </ul>
          </div>
        </div>
        <div class="second-row">
          <div id="beginners-box">
            <a href="" id="beginners">
              <h3>Начинаещи</h3>
            </a>
            <ul>
              <li><a href="">If Проверки</a></li>
              <li><a href="">If-else Проверки</a></li>
              <li><a href="">Обединения в Условията</a></li>
              <li><a href="">For Цикли</a></li>
              <li><a href="">While Цикли</a></li>
              <li><a href="">Вградени Цикли</a></li>
            </ul>
          </div>
          <div id="advanced-box">
            <a href="" id="advanced">
              <h3>Напреднали</h3>
            </a>
            <ul>
              <li><a href="">Листове Python</a></li>
              <li><a href="">Речници Python</a></li>
              <li><a href="">Функции Python</a></li>
              <li><a href="">Обработка на Текст</a></li>
              <li><a href="">Regex Python</a></li>
              <li><a href="">Други Python</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    -->
    <div class="problems">
      <h2>Задачи</h2>
      <hr>
      <div class="problems-box">
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <!--
              <th>Рейтинг</th>
              -->
            </tr>
          </thead>
          <tbody>
            <?php
            include "crud_problems_config.php";
            $sql = "SELECT * FROM problems ORDER BY rating DESC";

            $result = $con->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {

            ?>

                <tr>
                  <td>
                    <a class="created-problems-a" href="ide.php?<?php
                                                                echo "id=" . $row['id'] . "";
                                                                ?>">
                      <?php
                      echo $row['title'];
                      ?>

                    </a>
                  </td>
                  <!--
                  <td>
                    <a class="created-problems-a" href="problem_visualise.php?id=<?php echo $row['id']; ?>">
                      <?php
                      echo $row['rating'];
                      ?>
                    </a>
                  </td>
                -->
                </tr>
                </a>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>

  </main>
  <!--
  <footer>
      Last updated code_checker.py
      <br>
      Fixed bugs
    </footer>
  -->
</body>

</html>