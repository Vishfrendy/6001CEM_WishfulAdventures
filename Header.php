<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WishfulAdventures</title>

    <!-- Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .header {
            background-color: white;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60px;
            padding: 0 20px;
            font-family: Arial, sans-serif;
            padding-bottom: 32px;
        }

        .title {
            font-size: 24px;
            position: relative;
            top: 20px;
            margin-right: 750px;
        }

        .title a {
            text-decoration: none;
            color: black;
        }

        .title img {
            height: 100px;
            width: 150px;
        }

        .menu {
            display: flex;
            align-items: center;
        }

        .menu-link {
            color: black;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 4px;
        }

        .menu-link:hover {
            background-color: #ca8dfd;
        }

        .menu-link img {
            height: 20px;
            width: 20px;
        }

        /* Additional styles for the modal trigger buttons */
        .modalBtn {
            cursor: pointer;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto 15% auto;
            border: 1px solid #ddd;
            width: 45%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
            padding: 20px;
            text-align: center;
        }

        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        /* Add Zoom Animation */
        .animate {
            animation: animatezoom 0.6s;
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }
		
		/* Sign Up Modal Styles */
		#signUpModal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.4);
			padding-top: 60px;
		}

		#signUpModal .modal-content {
			background-color: #fff;
			margin: 5% auto 15% auto;
			border: 1px solid #ddd;
			width: 45%;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			position: relative;
			padding: 20px;
			text-align: center;
		}

		#signUpModal .close {
			position: absolute;
			right: 25px;
			top: 0;
			color: #000;
			font-size: 35px;
			font-weight: bold;
		}

		#signUpModal .close:hover,
		#signUpModal .close:focus {
			color: red;
			cursor: pointer;
		}

		#signUpModal .container {
			padding: 16px;
		}

		#signUpModal h1 {
			color: #333;
		}

		#signUpModal p {
			color: #666;
		}

		#signUpModal label {
			display: block;
			margin: 10px 0 5px;
			color: #333;
		}

		#signUpModal input[type="text"],
		#signUpModal input[type="password"] {
			width: 100%;
			padding: 10px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		#signUpModal input[type="checkbox"] {
			margin-bottom: 15px;
		}

		#signUpModal .clearfix::after {
			content: "";
			clear: both;
			display: table;
		}

		#signUpModal a {
			color: dodgerblue;
		}

		#signUpModal .cancelbtn,
		#signUpModal .signupbtn {
			float: center;
			width: 48%;
			padding: 14px 2px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
		}

		#signUpModal .cancelbtn:hover,
		#signUpModal .signupbtn:hover {
			opacity: 0.8;
		}


		/* Login Modal Styles */
		#loginModal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.4);
			padding-top: 60px;
		}

		#loginModal .modal-content {
			background-color: #fff;
			margin: 5% auto 15% auto;
			border: 1px solid #ddd;
			width: 45%;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			position: relative;
			padding: 20px;
			text-align: center;
		}

		#loginModal .close {
			position: absolute;
			right: 25px;
			top: 0;
			color: #000;
			font-size: 35px;
			font-weight: bold;
		}

		#loginModal .close:hover,
		#loginModal .close:focus {
			color: red;
			cursor: pointer;
		}

		#loginModal .container {
			padding: 16px;
		}

		#loginModal h1 {
			color: #333;
		}

		#loginModal p {
			color: #666;
		}

		#loginModal label {
			display: block;
			margin: 10px 0 5px;
			color: #333;
		}

		#loginModal input[type="text"],
		#loginModal input[type="password"] {
			width: 100%;
			padding: 10px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		#loginModal input[type="checkbox"] {
			margin-bottom: 15px;
		}

		#loginModal .clearfix::after {
			content: "";
			clear: both;
			display: table;
		}

		#loginModal a {
			color: dodgerblue;
		}

		#loginModal .cancelbtn,
		#loginModal button[type="submit"] {
			float: center;
			width: 48%; /* Adjusted width */
			padding: 14px 2%; /* Adjusted padding */
			border: none;
			cursor: pointer;
			box-sizing: border-box; /* Ensure box sizing includes padding */
		}

		#loginModal .cancelbtn:hover,
		#loginModal button[type="submit"]:hover {
			opacity: 0.8;
		}
    </style>
</head>

<body>
	<?php
		function connectToDatabase()
		{
			$host = 'localhost';
			$name = 'root';
			$password = '';
			$database = 'wishfuladventures_travel_website';

			$conn = new mysqli($host, $name, $password, $database);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			return $conn;
		}

		function loginUser($email, $password)
		{
			$conn = connectToDatabase();

			$email = $conn->real_escape_string($email);

			$sql = "SELECT * FROM users WHERE email = '$email'";
			$result = $conn->query($sql);

			if ($result) {
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$hashed_password = $row["password"];

					if (password_verify($password, $hashed_password)) {
						return "Login successful!";
					} else {
						return "Incorrect password.";
					}
				} else {
					return "User not found.";
				}
			} else {
				return "Query failed: " . $conn->error;
			}

			$conn->close();
		}

		function registerUser($email, $name, $password, $confirmPassword)
		{
			$conn = connectToDatabase();

			$email = $conn->real_escape_string($email);
			$name = $conn->real_escape_string($name);

			// Check if passwords match
			if ($password !== $confirmPassword) {
				return "Passwords do not match.";
			}

			// Hash the password before storing it in the database
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			// Insert user data into the database
			$sql = "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$hashed_password')";

			if ($conn->query($sql) === TRUE) {
				return "Sign up successful!";
			} else {
				return "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
		}

		// Process login form
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
			$login_email = $_POST["email"];
			$login_password = $_POST["password"];

			$login_result = loginUser($login_email, $login_password);
			echo $login_result;
		}

		// Process sign-up form
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
			$signup_email = $_POST["email"];
			$signup_name = $_POST["name"];
			$signup_password = $_POST["password"];
			$signup_confirm_password = $_POST["confirm_password"];

			$signup_result = registerUser($signup_email, $signup_name, $signup_password, $signup_confirm_password);
			echo $signup_result;
		}
	?>
	
    <div class="header">
        <div class="title">
            <a href="Travel_Website.php"><img src="Logo4.png" alt="Logo"></a>
        </div>

        <div class="menu">
            <!-- Trigger buttons for login and sign-up modals -->
			<a id="signUpBtn" class="menu-link modalBtn"></a>
            <a id="signInBtn" class="menu-link modalBtn">Sign In</a>
            <a href="#" class="menu-link">Saved Trips</a>
            <a href="#" class="menu-link">
                <img src="Cart.png" alt="Cart">
            </a>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <form class="modal-content animate" action="Travel_Website.php" method="post">
            <span onclick="closeModal('loginModal')" class="close" title="Close Modal">&times;</span>
            <div class="imgcontainer">
                <img src="Avatar.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="email"><b>Email</b></label>
				<input type="text" placeholder="Enter Email" name="email" required>


                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
            </div>
			
			<p>Don't have an account yet? <a href="#" style="color: dodgerblue">Sign up here</a>.</p>
			
			<div class="clearfix">
				<button type="button" onclick="closeModal('loginModal')" class="cancelbtn">Cancel</button>
				<button type="submit">Login</button>
			</div>
        </form>
    </div>

    <!-- Sign Up Modal -->
    <div id="signUpModal" class="modal">
		<form class="modal-content animate" action="Travel_Website.php" method="post">
			<span onclick="closeModal('signUpModal')" class="close" title="Close Modal">&times;</span>

			<div class="container">
				<h1>Sign Up</h1>
				<p>Please fill in this form to create an account.</p>

				<label for="name"><b>Name</b></label>
				<input type="text" placeholder="Enter Your Full Name" name="name" required>

				<label for="email"><b>Email</b></label>
				<input type="text" placeholder="Enter Email" name="email" required>


				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>

				<label for="confirm_password"><b>Repeat Password</b></label>
				<input type="password" placeholder="Repeat Password" name="confirm_password" required>


				<p>Already have an account? <a href="#" style="color: dodgerblue">Log in here</a>.</p>

				<div class="clearfix">
					<button type="button" onclick="closeModal('signUpModal')" class="cancelbtn">Cancel</button>
					<button type="submit" class="signupbtn">Sign Up</button>
				</div>
			</div>
		</form>
	</div>

    <script>
		function openModal(modalId) {
			document.getElementById(modalId).style.display = 'block';
		}

		function closeModal(modalId) {
			document.getElementById(modalId).style.display = 'none';
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function (event) {
			if (event.target.classList.contains('modal')) {
				event.target.style.display = 'none';
			}
		};

		// Attach click events to trigger buttons
		document.getElementById('signInBtn').addEventListener('click', function () {
			openModal('loginModal');
		});

		document.getElementById('signUpBtn').addEventListener('click', function () {
			openModal('signUpModal');
		});

		// Add click event to the "Sign up here" link inside the login modal
		document.querySelector('#loginModal p a').addEventListener('click', function (event) {
			event.preventDefault(); // Prevent the default behavior of the anchor tag
			closeModal('loginModal'); // Close the login modal
			openModal('signUpModal'); // Open the sign-up modal
		});

		// Add click event to the "Log in here" link inside the sign-up modal
		document.querySelector('#signUpModal p a').addEventListener('click', function (event) {
			event.preventDefault(); // Prevent the default behavior of the anchor tag
			closeModal('signUpModal'); // Close the sign-up modal
			openModal('loginModal'); // Open the login modal
		});
	</script>

</body>

</html>
