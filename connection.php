<?php
    $dsn="mysql:host=localhost;db_name=api";
    $username="root";
    $password="";
    $options=[];
    try{
            $connection= new PDO($dsn,$username,$password, $options);
         //        echo"connected";
    }
    catch(PDOException){
        // echo"Not connected";
    }
?>