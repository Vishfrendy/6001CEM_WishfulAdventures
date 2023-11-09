<!DOCTYPE html>
<html>
	<head>
		<title>Hotels</title>
		
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
				max-width: 1200px; /* Increase the max-width to accommodate the 3 columns */
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

			/* Add styles for the "View Price" button */
			.view-price-button {
				padding: 5px 10px;
				font-size: 14px;
				background-color: #333;
				color: #fff;
				border: none;
				cursor: pointer;
				margin-top: 10px;
				border-radius: 5%;
			}

			/* Hover styles for the "View Price" button */
			.view-price-button:hover {
				background-color: #f9ca24;
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
				background-color: rgba(0, 0, 0, 0.8);
			}

			.modal-content {
				background-color: #fff;
				margin: 5% auto;
				padding: 20px;
				border-radius: 8px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				max-width: 600px;
				width: 90%;
				position: relative;
			}

			.close {
				color: #333;
				position: absolute;
				top: 10px;
				right: 10px;
				font-size: 24px;
				font-weight: bold;
				cursor: pointer;
			}

			/* Amenities Styles */
			#propertyAmenities {
				margin-top: 20px;
			}

			.amenities-columns {
				display: flex;
				flex-wrap: wrap;
				justify-content: space-between;
			}

			.column {
				flex: 0 0 48%;
				list-style-type: none;
				padding: 0;
			}

			.extra-amenities {
				/* Display none by default */
				display: none;
			}

			#showMoreAmenities {
				cursor: pointer;
				color: blue;
				margin-top: 10px;
				display: none;
			}

			#showMoreAmenities:hover {
				text-decoration: underline;
			}

			#modalLocation {
				color: #454545;
				position: relative;
				bottom: 20px;
				margin-left: 3px;
			}

			/* Booking Section Styles */
			#bookingSection {
				margin-top: 20px;
			}

			#bookingSection h3 {
				font-size: 20px;
				margin-bottom: 15px;
			}

			#bookingSection label {
				display: block;
				margin-bottom: 8px;
				font-weight: bold;
			}

			#bookingSection input {
				width: 100%;
				padding: 10px;
				margin-bottom: 15px;
				box-sizing: border-box;
				border: 1px solid #ccc;
				border-radius: 6px;
			}

			/* Adjust styling for date inputs */
			#checkInDate,
			#checkOutDate {
				width: calc(50% - 5px);
				margin-right: 10px;
			}

			/* Add some spacing between number inputs */
			#numRooms,
			#numAdults,
			#numChildren {
				margin-right: 10px;
			}
			
			#modalRating {
				margin-right: 5px;
				color: #f9ca24;
				font-size: 18px;
				padding-bottom: 8px;
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
			
			<!---------- Hotels Section ---------->
			<?php
				// Step 1: Connect to the database
				$conn = mysqli_connect('localhost', 'root', '', 'wishfuladventures_travel_website');

				// Step 2: Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				// Step 3: Fetch data from the 'hotels' table
				$sql = "SELECT * FROM hotels";
				$result = mysqli_query($conn, $sql);

				echo '<div class="destination-container">';

				// Step 4: Display the data in the HTML
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<div class="destination">';
					echo '<div class="heart-icon">&#10084;</div>'; // Add the heart icon container
					echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
					echo '<h2>' . $row['name'] . '</h2>';
					echo '<p>' . $row['location'] . '</p>';
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
					echo '<p class="price">RM' . $row['discounted_price'] . ' - RM' . $row['original_price'] . '</p>';
					echo '</div>';
				}

				// Step 5: Close the database connection
				mysqli_close($conn);

				echo '</div>';
			?>
			<!---------- End of Hotels Section ---------->
			
		</div>
		
		<div class="modal" id="hotelModal">
			<div class="modal-content">
				<span class="close" onclick="closeModal()">&times;</span>
				<h1 id="modalHotelName"></h1>
				<p id="modalLocation"></p>
				<div id="modalRating"></div>
				<img id="modalImage" style="width: 500px; height: 342px; object-fit: cover; margin-bottom: 10px;" alt="Hotel Image">
				<p id="modalDescription"></p>
				<p class="price" id="modalPrice"></p>

				<!-- Booking Section -->
				<div id="bookingSection">
					<h3>Book Your Stay</h3>
					<label for="checkInDate">Check-in Date:</label>
					<input type="date" id="checkInDate" name="checkInDate">

					<label for="checkOutDate">Check-out Date:</label>
					<input type="date" id="checkOutDate" name="checkOutDate">

					<label for="numRooms">Number of Rooms:</label>
					<input type="number" id="numRooms" name="numRooms" min="1" value="1">

					<label for="numAdults">Number of Adults:</label>
					<input type="number" id="numAdults" name="numAdults" min="1" value="1">

					<label for="numChildren">Number of Children:</label>
					<input type="number" id="numChildren" name="numChildren" min="0" value="0">
				</div>

				<!-- Property Amenities Section -->
				<div id="propertyAmenities">
					<h3>Property Amenities</h3>
					<div class="amenities-columns">
						<ul id="amenitiesListColumn1" class="column"></ul>
						<ul id="amenitiesListColumn2" class="column"></ul>
						<ul id="amenitiesListColumn3" class="column extra-amenities" style="display: none;"></ul>
						<ul id="amenitiesListColumn4" class="column extra-amenities" style="display: none;"></ul>
					</div>
					<p id="showMoreAmenities" style="cursor: pointer; color: blue;">Show More</p>
				</div>
			</div>
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
			
			function openModal(hotel) {
				// Get modal elements
				var modal = document.getElementById("hotelModal");
				var modalHotelName = document.getElementById("modalHotelName");
				var modalLocation = document.getElementById("modalLocation");
				var modalRating = document.getElementById("modalRating");
				var modalImage = document.getElementById("modalImage");
				var modalDescription = document.getElementById("modalDescription");
				var modalPrice = document.getElementById("modalPrice");

				// Populate modal with hotel information
				modalHotelName.innerText = hotel.name;
				modalLocation.innerText = hotel.location;
				
				// Populate rating stars
				modalRating.innerHTML = 'Rating: ';
				for (let i = 1; i <= 5; i++) {
					modalRating.innerHTML += i <= hotel.rating ? '★' : '☆';
				}

				modalImage.src = hotel.image_path; // Set the image source
				modalDescription.innerText = hotel.description; // Set the description

				modalPrice.innerText = 'Price: RM' + hotel.discounted_price + ' - RM' + hotel.original_price;

				// Display the modal
				modal.style.display = "block";
			}

			function closeModal() {
				// Hide the modal
				var modal = document.getElementById("hotelModal");
				modal.style.display = "none";
			}

			// Attach a click event listener to each hotel element
			document.addEventListener("DOMContentLoaded", function () {
				const destinationElements = document.querySelectorAll(".destination");
				destinationElements.forEach((element) => {
					element.addEventListener("click", function () {
						// Extract hotel information from the clicked element
						const hotel = {
							name: element.querySelector('h2') ? element.querySelector('h2').innerText : '',
							location: element.querySelector('p') ? element.querySelector('p').innerText : '',
							rating: element.querySelector('.rating-value') ? parseFloat(element.querySelector('.rating-value').innerText) : 0,
							discounted_price: element.querySelector('.price') ? parseFloat(element.querySelector('.price').innerText.split(' - ')[0].replace('RM', '')) : 0,
							original_price: element.querySelector('.price') ? parseFloat(element.querySelector('.price').innerText.split(' - ')[1].replace('RM', '')) : 0,
							image_path: element.querySelector('img') ? element.querySelector('img').src : '',
							description: element.querySelector('.description') ? element.querySelector('.description').innerText : '',
						};


						// Open the modal with the extracted hotel information
						openModal(hotel);
					});
				});
			});
			
			// Sample data for amenities
			const allAmenities = [
				"Valet parking",
				"Free internet",
				"Pool",
				"Fitness Centre with Gym / Workout Room",
				"Bar / lounge",
				"Airport transportation",
				"Paid public parking on-site",
				"Wifi",
				"Fitness / spa changing rooms",
				"Sauna",
				"Restaurant",
				"Breakfast available",
				"Breakfast buffet",
				"Breakfast in the room",
				"Complimentary Instant Coffee",
				"Poolside bar",
				"Taxi service",
				"Business Centre with Internet Access",
				"Conference facilities",
				"Banquet room",
				"Meeting rooms",
				"Spa",
				"Foot massage",
				"Full body massage",
				"Head massage",
				"Massage",
				"Steam room",
				"Rooftop terrace",
				"24-hour security",
				"Baggage storage",
				"Concierge",
				"Currency exchange",
				"Newspaper",
				"Butler service",
				"Doorperson",
				"24-hour check-in",
				"24-hour front desk",
				"Dry cleaning",
				"Laundry service",
				"Ironing service",
			];

			// Function to populate amenities
			function populateAmenities() {
				const column1 = document.getElementById('amenitiesListColumn1');
				const column2 = document.getElementById('amenitiesListColumn2');
				const column3 = document.getElementById('amenitiesListColumn3');
				const column4 = document.getElementById('amenitiesListColumn4');
				const showMoreLink = document.getElementById('showMoreAmenities');

				// Clear existing amenities
				column1.innerHTML = '';
				column2.innerHTML = '';
				column3.innerHTML = '';
				column4.innerHTML = '';

				// Show the first 4 amenities
				const visibleAmenities = allAmenities.slice(0, 4);
				populateColumn(column1, visibleAmenities);

				// Show or hide "Show More" link based on the number of amenities
				showMoreLink.style.display = allAmenities.length > 4 ? 'block' : 'none';

				// Handle "Show More" link click
				showMoreLink.onclick = function () {
					// Show the hidden amenities
					const hiddenAmenities = allAmenities.slice(4);
					populateColumn(column3, hiddenAmenities);
					// Toggle the display of extra amenity columns
					column3.style.display = 'block';
					column4.style.display = 'block';
					// Hide the "Show More" link
					showMoreLink.style.display = 'none';
				};
			}

			// Function to populate a column with amenities
			function populateColumn(column, amenities) {
				amenities.forEach(amenity => {
					const listItem = document.createElement('li');
					listItem.textContent = amenity;
					column.appendChild(listItem);
				});
			}

			// Call the function to populate amenities
			populateAmenities();


		</script>
		<!---------- End of Script ---------->
	
	</body>
</html>
