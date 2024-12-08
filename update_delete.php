<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];

    $sql = "UPDATE users SET name = ?, accessLevel = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $accessLevel, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Handle Delete
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all users for display
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update/Delete Users</title>
</head>
<body>
    <h1>Update/Delete Users</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Matric</th>
            <th>Name</th>
            <th>Access Level</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST" action="">
                <td><?= $row['id']; ?></td>
                <td><?= $row['matric']; ?></td>
                <td><input type="text" name="name" value="<?= $row['name']; ?>"></td>
                <td><input type="text" name="accessLevel" value="<?= $row['accessLevel']; ?>"></td>
                <td>
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
<head>
    <title>Update/Delete Users</title>
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

        h1 {
            text-align: center;
            color: #1E90FF;
        }

        input[type="text"] {
            padding: 10px;
            width: 100%;
            margin: 5px 0;
            border: 2px solid #1E90FF;
            border-radius: 5px;
        }

        button {
            padding: 12px;
            background-color: #FF6347;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #D9534F;
        }

        button[type="submit"] {
            background-color: #1E90FF;
        }

        button[type="submit"]:hover {
            background-color: #1C7ED6;
        }
    </style>
</head>
