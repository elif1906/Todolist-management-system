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
?>

<?php include 'header.php';?>

<!DOCTYPE html>
<html>
<head>
    <title>Projects List</title>
    <style>
        body {
            background-image: url('background.png');
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 40px auto;
            max-width: 1200px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }

        .lg-6 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .lg-12 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 3px 3px;
            background-color: #0D82CA;
            color: white;
            border: none;
            border-radius: 1px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #166D55;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Projects List</h1>
        <div class="lg-6 whoami">
            <?php echo 'Logged in as <strong>' . $_SESSION['user'] . '</strong> <a href="logout.php">[logout]</a>'; ?>
        </div>
        <div class="lg-6 createBoard"style="display: flex; justify-content: flex-end;">
            <a href="newProject.php" class="btn">New Project</a>
        </div>
    <div class="lg-12">
        <table class="project-list">
            <thead>
                <tr>
                    <th>Customer name</th>
                    <th>Short project name</th>
                    <th>Tasks left</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT * FROM projects";

                if($result = $connection->query($sql)){
                    $projectsCount = $result->num_rows;
                    if($projectsCount>0){
                            
                        while ($row = mysqli_fetch_array($result)) {
                            $sn = $row['Short name'];
                            $sumSQL = "SELECT count(*) as tasksLeft FROM `tasks` WHERE project_short_name = '$sn' AND state != 4";
                            $sumResult = $connection->query($sumSQL);
                            $row2 = $sumResult->fetch_assoc();
                            echo "
                            <tr>
                                <td>".($row['Full name'])."</td>
                                <td>".($row['Short name'])."</td>
                                <td>".$row2['tasksLeft']."</td>
                                <td><a href='board.php?sn=".$row['Short name']."' class='btn'>Board</a></td>
                                <td><a href='delete.php?sn=".$row['Short name']."' class='btn' style='background-color: #D9534F;'>Delete</a></td>
                            </tr>";
                        }
                        $result->free_result();
                    }
                    else{
                        echo "No projects?";
                    }
                }
                
                ?>
            </tbody>
        </table>
        <?php
            if(isset($_SESSION['newProjectSuccess'])){
                echo $_SESSION['newProjectSuccess'];
                unset($_SESSION['newProjectSuccess']);
            }
        ?>
    </div>
</div>

<?php $connection->close(); ?>
<?php include 'footer.php';?>
