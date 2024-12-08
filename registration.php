<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $sql = "INSERT INTO users (matric, name, accessLevel, password) VALUES ('$matric', '$name', '$accessLevel', '$password')";
    if ($conn->query($sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
<form method="POST" action="">
    Matric: <input type="text" name="matric" required><br>
    Name: <input type="text" name="name" required><br>
    Access Level: <input type="text" name="accessLevel" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F0F8FF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
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
            border: 2px solid #1E90FF;
            border-radius: 5px;
        }

        button {
            background-color: #1E90FF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #1C7ED6;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #1E90FF;
        }
    </style>
</head>
