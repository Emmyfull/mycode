<!DOCTYPE html>
<html>
<head>
    <title>Login Form </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb');
            background-size: cover;
            background-position: center;
        }

        .box {
            width: 350px;
            margin: 80px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        input {
            width: 90%;
            padding: 8px;
            margin: 8px 0;
        }

        button {
            padding: 8px 15px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: darkgreen;
        }

        .result {
            margin-top: 15px;
            background-color: #e6ffe6;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Login Form </h2>

   
    <form method="POST">
        <label>Username</label><br>
        <input type="text" name="username" required><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br>

        <button type="submit" name="login">Login</button>
    </form>

    
    <?php
    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        echo "<div class='result'>";
        echo "<h3>Login Successful!</h3>";
        echo "Username: " . htmlspecialchars($username) . "<br>";
        echo "Password: " . htmlspecialchars($password);
        echo "</div>";
    }
    ?>

</div>

</body>
</html>
