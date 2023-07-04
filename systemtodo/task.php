<?php
    session_start();
    if(!(isset($_SESSION['logged-in']))){
        header('Location: login.php');
        exit();
    }
    if(!(isset($_GET['sn']))){
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0){
        echo "Error: ".$connection->connect_errno . "<br>";
        echo "Description: " . $connection->connect_error;
        exit();
    }
    $shortName = $_GET['sn'];
    $taskNum = $_GET['tn'];
?>

<?php include 'header.php';?>

<?php
    $sql = "SELECT * FROM `tasks` WHERE `project_short_name` = '$shortName' AND `project_task_num` = $taskNum";
     if($result = $connection->query($sql)){
        $rowsCount = $result->num_rows;
        if($rowsCount>0){
            $row = $result->fetch_assoc();
            $result->free_result();
        }
        else{
            echo '<span class="error-msg">sql error</span>';
            exit();
        } 
    }
?>

<!DOCTYPE html>
<html>
<head>
    
    <style>
        body {
            background-image: url('background.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .single-task {
        background-color: #FFFFFF;
        border: 2px solid #103961;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
        }
    
        .task-title {
            font-size: 24px;
            color: #103961;
            margin-bottom: 10px;
        }
    
        .task-desc {
            font-size: 16px;
            color: #555555;
        }
            


        </style>
</head>
<body>




<div class="container task-view">
    <h1 style="font-size: 56px; color:#103961;"><?php echo $shortName . '-' . $taskNum ?></h1>
    <div class="lg-12">
        <a style="font-size: 18px; color:#148B6A;font-weight:bold" class="back" href="board.php?sn=<?php echo $shortName ?>">&lt;--- Back to board</a>
    </div>
    <div class="lg-12 single-task">
        <h2 class="task-title"><?php echo $row['task_name']; ?></h2>
        <p class="task-desc"><?php echo $row['task_desc']; ?></p>
    </div>

        
</div>

<?php $connection->close(); ?>
<?php include 'footer.php';?>


</body>
</html>

