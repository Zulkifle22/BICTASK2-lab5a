<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        select {
            background-color: #fff;
        }

        button {
            background-color: #5cb85c;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .back-link {
            text-align: center;
            margin-top: 10px;
        }

        .back-link a {
            color: #337ab7;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
 <script>
        function cancelUpdate() {
            window.location.href = "lab5b-q5.php";
        }
    </script>	
<body>
    <div class="form-container">
        <h2>Update User</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lab_5b";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['matric'])) {
            $matric = $_GET['matric'];
            $sql = "SELECT * FROM users WHERE matric = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $matric);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
            } else {
                echo "<p style='color: red; text-align: center;'>User not found.</p>";
                exit();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matric = $_POST['matric'];
            $name = $_POST['name'];
            $role = $_POST['role'];

            $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $role, $matric);

           if ($stmt->execute()) {
                // Redirect to lab5b-q5.php after successful update
                header("Location: lab5b-q5.php");
                exit();
            } else {
                echo "<p style='color: red; text-align: center;'>Error updating user: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color: red; text-align: center;'>Invalid request.</p>";
            exit();
        }

        $conn->close();
        ?>
        <form method="POST" action="">
            <input type="hidden" name="matric" value="<?php echo isset($user['matric']) ? $user['matric'] : ''; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student" <?php echo (isset($user['role']) && $user['role'] === 'student') ? 'selected' : ''; ?>>Student</option>
                <option value="lecturer" <?php echo (isset($user['role']) && $user['role'] === 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
                <option value="admin" <?php echo (isset($user['role']) && $user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>

            <button type="submit">Update</button>
			 <button type="button" class="cancel-button" onclick="cancelUpdate()">Cancel</button>
        </form>
        
        
    </div>
</body>
</html>
