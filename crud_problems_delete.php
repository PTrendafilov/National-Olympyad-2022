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

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $sql = "DELETE FROM problems WHERE id='$id'";
        $result=$con->query($sql);
        if($result == True){
            header("Location: crud_problems_view.php?token=true");
        }else{
            echo "Error:".$sql."<br>".$con->error;
        }
    }