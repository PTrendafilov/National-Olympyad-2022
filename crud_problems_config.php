<?php
    $severname="localhost";
    $username="root";
    $password="";
    $dbname="crud_problems";

    $con = new mysqli($severname, $username, $password, $dbname); 
    if($con->connect_error){
        die("Connection Failed!".$con->connect_error);
    }