<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
            z-index: 2; /* Set z-index of the form */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input {
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .success-popup {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #4caf50;
            color: #fff;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1; /* Set initial z-index below the form */
        }
    </style>
    <title>Login</title>
</head>
<body>

<?php
// Assuming your database connection details
$host = 'localhost';
$name = 'root';
$password = '';
$database = 'wishfuladventures_travel_website';

// Create a database connection
$conn = new mysqli($host, $name, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for login
$login_email = $login_password = '';

// Process the login form data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $login_email = $_POST["email"];
    $login_password = $_POST["password"];

    // Add additional validation as needed

    // Retrieve user data from the database
    $sql = "SELECT * FROM users WHERE email = '$login_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Verify the entered password with the hashed password from the database
        if (password_verify($login_password, $hashed_password)) {
            $success_message = "Login successful!";
            // You can redirect the user to a dashboard or another page after successful login
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}

// Close the database connection
$conn->close();
?>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Login</h2>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $login_email; ?>" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>
</div>

<!-- Success Popup for Login -->
<div id="loginSuccessPopup" class="success-popup">
    <?php if (!empty($success_message)): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
        <script>
            // JavaScript function to show the success popup for login
            function showLoginSuccessPopup() {
                var popup = document.getElementById('loginSuccessPopup');
                popup.style.display = 'block';
                popup.style.zIndex = '3'; // Set z-index above the form
            }

            // Call the showLoginSuccessPopup function when a successful login occurs
            <?php if (!empty($success_message)): ?>
                showLoginSuccessPopup();
            <?php endif; ?>
        </script>
    <?php endif; ?>
    <button onclick="closeLoginSuccessPopup()">Close</button>
</div>

<script>
    // JavaScript function to close the login success popup
    function closeLoginSuccessPopup() {
        var popup = document.getElementById('loginSuccessPopup');
        popup.style.display = 'none';
    }
</script>

</body>
</html>
