<?php
    session_start();
    if (!(isset($_SESSION['logged-in']))) {
        header('Location: login.php');
        exit();
    }
?>
<?php include 'header.php';?>

<!DOCTYPE html>
<html>
<head>
    <title>New Project</title>
    <style>
       
        body {
            background-image: url('background.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 700px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .login-box h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 16px;
            font-weight: bold;
        }

        .input-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #166D55;
        }

        .input-box select{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php include 'header.php';?>

    <div class="container loginContainer">
        <h1 style="font-size: 66px; color:#103961;">New Project</h1>
        <div class="login-box">
            <form method="post" action="newProjectValidation.php">
                <div class="input-box">
                    <label for="full">Customer Name:</label>
                    
                    <select name="full">
                    <?php
                    $customerNames = array(
                        "Kısmet",
                        "Birkenstock",
                        "Badbear",
                        "Keep",
                        "Reis Macro",
                        
                        
                    );

                    foreach ($customerNames as $name) {
                        echo "<option value='" . $name . "'>" . $name . "</option>";
                    }
                    ?>

                    </select>
                </div>
                <div class="input-box">
                    <label for="short">Short Project Name:</label>
                    <input type="text" name="short">
                </div>
                <button type="submit">Add New Project</button>
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
</body>
</html>
