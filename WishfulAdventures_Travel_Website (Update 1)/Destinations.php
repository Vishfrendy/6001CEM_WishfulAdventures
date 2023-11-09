<!DOCTYPE html>
<html>
	<head>
		<title>Destinations</title>
		<!--Link for Icons-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		
		<!---------- Style ---------->
		<style>
			body {
				font-family: Arial, sans-serif;
				background-color: #ffffff;
				margin: 0;
				padding: 0;
			}

			.search-section {
				margin-bottom: 20px;
				text-align: center;
				padding-bottom: 20px;
			}

			.search-section input[type="text"] {
				width: 500px;
				padding: 16px;
				font-size: 16px;
				border-radius: 15px;
				padding-left: 50px;
			}

			.search-section button:hover {
				background-color: #ca8dfd;
				color: white;
			}

			.search-container {
				position: relative;
				display: inline-block;
			}

			.search-button {
				position: absolute;
				top: 7px;
				right: 7px;
				height: 75%;
				background-color: #ca8dfd;
				border-color: #ca8dfd;
				border-radius: 15px;
				color: white;
				padding: 0 10px;
			}

			.links-container {
				display: flex;
				justify-content: center;
				margin-bottom: 20px;
			}

			.links-container a {
				background-color: #fff;
				color: #333;
				padding: 10px 20px;
				border-radius: 5px;
				text-decoration: none;
				margin: 0 10px;
			}

			.links-container a:hover {
				background-color: #ca8dfd;
				color: #000;
				padding: 8px 20px;
			}

			.container {
				max-width: 1600px;
				margin: 0 auto;
				padding: 20px;
			}

			.destination-container {
				max-width: 1200px;
				margin: 0 auto;
				display: grid;
				grid-template-columns: repeat(3, 1fr); /* Set 3 equal columns */
				gap: 20px;
				padding: 10px;
			}

			.destination {
				border: 1px solid #ccc;
				border-radius: 5px;
				background-color: #fff;
				padding: 20px;
				overflow: hidden;
				position: relative;
				margin-bottom: 20px;
			}

			.destination img {
				width: 100%;
				height: 200px;
				object-fit: cover;
				margin-bottom: 10px;
				border-radius: 5px;
			}

			.destination h2 {
				margin: 0;
				font-size: 24px;
				margin-bottom: 10px;
			}

			.destination p {
				margin: 10px 0;
			}

			.destination .rating {
				color: #f9ca24;
				font-size: 18px;
			}

			.destination .rating .star {
				color: #f9ca24;
				font-size: 18px;
			}
			.destination .price {
				font-weight: bold;
				color: #2ecc71;
				font-size: 18px;
			}

			.destination .rating-value {
				margin-right: 5px;
				color: #f9ca24;
				font-size: 18px;
				font-weight: bold;
			}

			/* Add styles for the heart icon container */
			.destination .heart-icon {
				position: absolute;
				top: 27px;
				right: 27px;
				font-size: 20px;
				cursor: pointer;
				color: #ccc;
				border-radius: 50%;
				background-color: #fff;
				width: 30px;
				height: 30px;
				display: flex;
				align-items: center;
				justify-content: center;
				border: 2px solid #fff;
				opacity: 0.69;
			}

			/* Add styles for the active state of the heart icon container */
			.destination .heart-icon.active {
				color: red;
				border-color: red;
			}

			.container h1 {
				text-align: center;
				font-size: 40px;
			}

			.search-icon {
				font-size: 20px;
				color: #333;
				position: relative;
				left: 40px;
				top: 2px;
			}

			.like-container {
				position: relative; 
				left: 200px;
			}

			.like-container h3 {
				position: relative;
				top: 5px;
			}

			.like-container p {
				color: #454545;
			}
		</style>
		<!---------- End of Style ---------->
	</head>

	<body>
		<!--Link Header.php For Header-->
		<?php include 'Header.php'; ?>

		<div class="container">
			<h1>Where To?</h1>
			
			<!---------- Links Section ---------->
			<div class="links-container">
				<a href="Hotels.php"><img src="Hotel.png" alt="Hotel" style="position: relative; height: 20px; width: 20px; margin-right: 8px; top: 3px;">Hotels</a>
				<a href="#"><img src="Ticket.png" alt="Ticket" style="position: relative; height: 20px; width: 20px; margin-right: 8px; top: 3px;">Things to Do</a>
				<a href="#"><img src="Home.png" alt="Home" style="position: relative; height: 20px; width: 20px; margin-right: 8px; top: 3px;">Holiday Rentals</a>
				<a href="Restaurants.php"><img src="Restaurant.png" alt="Restaurant" style="position: relative; height: 20px; width: 20px; margin-right: 8px; top: 3px;">Restaurants</a>
				<a href="#"><img src="Stories.png" alt="Stories" style="position: relative; height: 20px; width: 20px; margin-right: 8px; top: 3px;">Travel Stories</a>
				<a href="#"><img src="More.png" alt="More" style="position: relative; height: 20px; width: 20px; margin-right: 8px; top: 3px;">More</a>
			</div>
			<!---------- End of Links Section ---------->
			
			<!---------- Search Section ---------->
			<div class="search-section">
				<div class="search-container">
					<i class="fas fa-search search-icon"></i>
					<input type="text" class="search-input" placeholder="Place to go, things to do, hotels...">
					<button type="submit" class="search-button">Search</button>
				</div>
			</div>
			<!---------- End of Search Section ---------->
			
			<!---------- Destinations Section ---------->
			<?php
				// Step 1: Connect to the database
				$conn = mysqli_connect('localhost', 'root', '', 'wishfuladventures_travel_website');

				// Step 2: Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				// Step 3: Fetch data from the 'destinations' table
				$sql = "SELECT * FROM destinations";
				$result = mysqli_query($conn, $sql);

				echo '<div class="destination-container">';
					// Step 4: Display the data in the HTML
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<div class="destination">';
						echo '<div class="heart-icon">&#10084;</div>'; // Add the heart icon container
						echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
						echo '<h2>' . $row['name'] . '</h2>';
						echo '<p>' . $row['description'] . '</p>';
						echo '<div class="rating">';

						// Calculate the number of filled stars
						$filledStars = floor($row['rating']);

						// Display the filled stars and rating value
						echo '<span class="rating-value">' . $row['rating'] . '</span>';
						for ($i = 1; $i <= $filledStars; $i++) {
							echo '<span class="star">★</span>';
						}

						// Display the remaining unfilled stars
						$remainingStars = 5 - $filledStars;
						for ($i = 1; $i <= $remainingStars; $i++) {
							echo '<span class="star">☆</span>';
						}

						echo '</div>';
						echo '<p class="price">Price range: RM' . $row['min_price'] . ' - RM' . $row['max_price'] . '</p>';
						echo '</div>';
					}

					// Step 5: Close the database connection
					mysqli_close($conn);
				echo '</div>';
			?>
			<!---------- End of Destinations Section ---------->
			
		</div>
		
		<!---------- Script ---------->
	    <script>
			// JavaScript function to toggle the color of the heart icon
			function toggleHeartColor(icon) {
				icon.classList.toggle("active");
			}

			// Event listener to toggle the heart icon color on click
			document.addEventListener("DOMContentLoaded", function () {
				const heartIcons = document.querySelectorAll(".heart-icon");
				heartIcons.forEach((icon) => {
					icon.addEventListener("click", function () {
						toggleHeartColor(icon);
					});
				});
			});
	    </script>
		<!---------- End of Script ---------->
	</body>
</html>
