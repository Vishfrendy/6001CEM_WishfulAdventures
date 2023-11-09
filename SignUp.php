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
    <title>Sign Up</title>
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

// Initialize the success message variable
$success_message = '';

// Process the sign-up form data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $signup_email = $_POST["email"];
    $signup_name = $_POST["name"];
    $signup_password = $_POST["password"];
    $signup_confirm_password = $_POST["confirm_password"];

    // Add additional validation as needed

    // Check if passwords match
    if ($signup_password !== $signup_confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the password before storing it in the database
    $hashed_password = password_hash($signup_password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (email, name, password) VALUES ('$signup_email', '$signup_name', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Sign up successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Sign Up</h2>
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required>

        <button type="submit" name="signup">Sign Up</button>
    </form>
</div>

<!-- Success Popup -->
<div id="successPopup" class="success-popup">
    <?php if (!empty($success_message)): ?>
        <p class="success-message"><?php echo $success_message; ?></p>
        <script>
            // JavaScript function to show the success popup and bring it above the form
            function showSuccessPopup() {
                var popup = document.getElementById('successPopup');
                popup.style.display = 'block';
                popup.style.zIndex = '3'; // Set z-index above the form
            }

            // JavaScript function to close the success popup and redirect to the login page
            function closeSuccessPopup() {
                var popup = document.getElementById('successPopup');
                popup.style.display = 'none';
                
                // Redirect to the login page after closing the popup
                window.location.href = 'SignIn.php'; // Replace 'login.php' with your actual login page
            }

            // Call the showSuccessPopup function when a successful signup occurs
            showSuccessPopup();
        </script>
    <?php endif; ?>
    <button onclick="closeSuccessPopup()">Close</button>
</div>


<script>
    // JavaScript function to show the success popup and bring it above the form
    function showSuccessPopup() {
        var popup = document.getElementById('successPopup');
        popup.style.display = 'block';
        popup.style.zIndex = '3'; // Set z-index above the form
    }

    // JavaScript function to close the success popup
    function closeSuccessPopup() {
        var popup = document.getElementById('successPopup');
        popup.style.display = 'none';
    }

    // Call the showSuccessPopup function when a successful signup occurs
    <?php if (!empty($success_message)): ?>
        showSuccessPopup();
    <?php endif; ?>
</script>

</body>
</html>
