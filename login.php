<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;
            header('Location: display.php');
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
    $conn->close();
}
?>
<form method="POST" action="">
    Matric: <input type="text" name="matric" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
    <a href="registration.php">Register here if you haven't register yet</a>
</form>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F0F8FF; /* Light Blue background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #1E90FF; /* Primary Blue border */
            border-radius: 5px;
        }

        button {
            background-color: #1E90FF; /* Primary Blue for the button */
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #1C7ED6; /* Darker Blue when hovered */
        }

        label {
            font-weight: bold;
            color: #333; /* Dark Gray for the label */
        }

        h1 {
            text-align: center;
            color: #1E90FF; /* Primary Blue for the header */
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #FF6347; /* Tomato Red for the link */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
