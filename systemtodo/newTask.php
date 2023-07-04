<?php
    session_start();
    if(!(isset($_SESSION['logged-in']))){
        header('Location: login.php');
        exit();
    }
    $shortName = $_GET['sn'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <style>
        body {
            background-image: url('background.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        

        h1 {
            font-size: 28px;
            color: #103961;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .add-button {
        background-color: white;
        border: none;
        color: #4CAF50;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
        }
    
        .add-button:hover {
            background-color: #166D55;
        }


    </style>
</head>
<body>







<?php include 'header.php';?>
<div class="container loginContainer">
	<br style="clear:both;"/>
	<br /><br /><br /><br /><br /><br /><br />
    <h1 style="color:#103961;">New Task <span>(<?php echo $_GET['sn']; ?>)</span></h1>
    <div class="login-box newTaskBox">
        <form method="post" action="newTaskValidation.php?sn=<?php echo $shortName; ?>">
            <div class="input-box">
                <label style="font-size: 26px;color:#103961;" for="taskTitle">Title:</label>
                <textarea name="taskTitle" class="taskTitle"> </textarea>
            </div>
            <div class="input-box">
                <label style="font-size: 26px;color:#103961;" for="short">Description:</label>
                <textarea name="taskDescription" class="taskDesc"></textarea>
            </div>
            <button type="submit" class="add-button">Add</button>
        </form>
        <?php
            if(isset($_SESSION['addProjectError'])){
                echo $_SESSION['addProjectError'];
                unset($_SESSION['addProjectError']);
            }
        ?>
    </div>
</div>

<?php include 'footer.php';?>