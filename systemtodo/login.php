<?php
    session_start();
    if(isset($_SESSION['logged-in'])){
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
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
            width: 400px;
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
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        .input-box select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #0D82CA;
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

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="your.jpg" alt="Logo" width="150">
            </div>
            <h1>Welcome to ASSIST</h1>
            <form method="post" action="loginValidation.php">
                <div class="input-box">
                    <label for="login">Username:</label>
                    <select name="login">
                    <?php
                    $LoginNames = array(
                        "Admin",
                        "Hakan",
                        "Kerem",
                        "Mert",
                        
                        
                        
                    );

                    foreach ($LoginNames as $name) {
                        echo "<option value='" . $name . "'>" . $name . "</option>";
                    }
                    ?>

                    </select>
                </div>
                <div class="input-box">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Log In</button>
            </form>
            <?php
                if(isset($_SESSION['loginError'])){
                    echo '<div class="error-message">' . $_SESSION['loginError'] . '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
