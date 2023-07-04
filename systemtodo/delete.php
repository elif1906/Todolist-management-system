<?php
    session_start();
    if(!(isset($_SESSION['logged-in']))){
        header('Location: login.php');
        exit();
    }
    
    require_once "connect.php";

    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0){
        echo "Error: ".$connection->connect_errno . "<br>";
        echo "Description: " . $connection->connect_error;
        exit();
    }

    if(isset($_GET['sn'])){
        $shortName = $_GET['sn'];
        
       
        $deleteSQL = "DELETE FROM projects WHERE `Short name` = '$shortName'";
        if($connection->query($deleteSQL)){
           
            header('Location: index.php');
            exit();
        }
        else{
            
            echo "Error: " . $connection->error;
        }
    }
    
    $connection->close();
?>
