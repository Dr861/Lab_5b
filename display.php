<?php
// session_start();
// if (!isset($_SESSION['logged_in'])) {
//     header('Location: login.php');
//     exit;
// }

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT matric, name, accessLevel FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Matric</th><th>Name</th><th>Access Level</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['matric']}</td><td>{$row['name']}</td><td>{$row['accessLevel']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}
$conn->close();
?>
<head>
    <title>User Data Display</title>
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
            flex-direction: column;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px 0;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #1E90FF;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #1E90FF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f1faff;
        }

        tr:hover {
            background-color: #E0FFFF;
        }

        button {
            background-color: #FF6347;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #D9534F;
        }

        h1 {
            text-align: center;
            color: #1E90FF;
        }
    </style>
</head>
