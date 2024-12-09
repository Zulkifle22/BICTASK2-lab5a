<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
            width: 300px;
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

        input, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
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

        .link-container {
            text-align: center;
        }

        .link-container a {
            color: #337ab7;
            text-decoration: none;
        }

        .link-container a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {     
            $servername = "localhost";
            $username = "root"; 
            $password = "";     
            $dbname = "lab_5b"; 

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $matric = $_POST['matric'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE matric = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $matric);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Check password
                if (password_verify($password, $row['password'])) {
                    // Redirect to lab5b-q5.php
                    header("Location: lab5b-q5.php");
                    exit();
                } else {
                    echo '<p class="error">Invalid username or password.</p>';
                }
            } else {
                echo '<p class="error">Invalid username or password, please login again</p>';
            }

            $conn->close();
        }
        ?>
        <form method="POST" action="">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <div class="link-container">
            <a href="lab5b-q3.php">Register here if you have not.</a>
        </div>
    </div>
</body>
</html>
