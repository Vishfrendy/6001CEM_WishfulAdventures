<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Account Page</title>
		
		<!---------- Style ---------->
		<style>
			body {
				font-family: Arial, sans-serif;
				line-height: 1.6;
				margin: 0;
				padding: 0;
			}
			
			header {
				background-color: #333;
				color: #fff;
				text-align: center;
				padding: 1rem 0;
			}
			
			main {
				padding: 2rem;
			}
			
			h2 {
				border-bottom: 1px solid #333;
				padding-bottom: 0.5rem;
			}
			
			.user-info {
				margin-bottom: 2rem;
			}
			
			ul {
				list-style: none;
				padding: 0;
			}
		</style>
		<!---------- End of Style ---------->
	</head>
	
	<body>
		<header>
			<!---------- Welcome Message ---------->
			<?php
				// Replace the following database connection details with your own
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "wishfuladventures_travel_website";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);

				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// Fetch user information from the database
				$sql = "SELECT name FROM users WHERE user_id = 1";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$welcomeMessage = "Welcome, " . $row["name"] . "!";
					echo "<h1>$welcomeMessage</h1>";
				} else {
					echo "<h1>Welcome, User!</h1>";
				}

				// Close connection
				$conn->close();
			?>
			<!---------- End of Welcome Message ---------->
		</header>
		
		<main>
			<!---------- User Information ---------->
			<div class="user-info">
				<h2>User Information</h2>

				<?php
					// Replace the following database connection details with your own
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "wishfuladventures_travel_website";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					// Fetch user information from the database
					$sql = "SELECT name, email FROM users WHERE user_id = 1";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
							echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
						}
					} else {
						echo "No user found";
					}

					// Close connection
					$conn->close();
				?>
			</div>
			<!---------- End of User Information ---------->
		</main>
		
	</body>
</html>
