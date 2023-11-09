<?php
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

	// Handle form submissions
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$action = isset($_POST["action"]) ? $_POST["action"] : '';

		if ($action === "create") {
			$name = isset($_POST["name"]) ? $_POST["name"] : '';
			$description = isset($_POST["description"]) ? $_POST["description"] : '';
			$location = isset($_POST["location"]) ? $_POST["location"] : '';
			$rating = isset($_POST["rating"]) ? $_POST["rating"] : '';
			$original_price = isset($_POST["original_price"]) ? $_POST["original_price"] : '';
			$discounted_price = isset($_POST["discounted_price"]) ? $_POST["discounted_price"] : '';
			$image_path = isset($_POST["image_path"]) ? $_POST["image_path"] : '';
			createHotels($name, $description, $location, $rating, $original_price, $discounted_price, $image_path);
			
			// Redirect after successful form submission
			header("Location: Admin_Hotels.php");
			exit(); // Make sure to exit after redirecting
			
		} elseif ($action === "update") {
			$name = isset($_POST["name"]) ? $_POST["name"] : '';
			$description = isset($_POST["description"]) ? $_POST["description"] : '';
			$location = isset($_POST["location"]) ? $_POST["location"] : '';
			$rating = isset($_POST["rating"]) ? $_POST["rating"] : '';
			$original_price = isset($_POST["original_price"]) ? $_POST["original_price"] : '';
			$discounted_price = isset($_POST["discounted_price"]) ? $_POST["discounted_price"] : '';
			$image_path = isset($_POST["image_path"]) ? $_POST["image_path"] : '';
			updateHotels($name, $description, $location, $rating, $original_price, $discounted_price, $image_path);
		} elseif ($action === "delete") {
			$name = isset($_POST["name"]) ? $_POST["name"] : '';
			deleteHotels($name);
		}
	}

	// Create a new hotels
	function createHotels($name, $description, $location, $rating, $original_price, $discounted_price, $image_path) {
		global $conn;
		$sql = "INSERT INTO hotels (name, description, location, rating, original_price, discounted_price, image_path) VALUES ('$name', '$description', '$location', '$rating', '$original_price', '$discounted_price', '$image_path')";
		$conn->query($sql);
	}

	// Read hotels details by name
	function readHotels($name) {
		global $conn;
		$sql = "SELECT * FROM hotels WHERE name = '$name'";
		$result = $conn->query($sql);
		return $result->fetch_assoc();
	}

	// Update hotels hotels by name
	function updateHotels($name, $description, $location, $rating, $original_price, $discounted_price, $image_path) {
		global $conn;
		$sql = "UPDATE hotels SET description = '$description', location = '$location', rating = '$rating', original_price = '$original_price', discounted_price = '$discounted_price', image_path = '$image_path' WHERE name = '$name'";
		$conn->query($sql);
	}

	// Delete hotels by name
	function deleteHotels($name) {
		global $conn;
		$sql = "DELETE FROM hotels WHERE name = '$name'";
		$conn->query($sql);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin - Hotel</title>
		
		<!--Link for Icons-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		
		<!---------- Style ---------->
		<style>
			body {
				font-family: Arial, sans-serif;
				line-height: 1.6;
				display: flex;
				justify-content: center;
				align-items: center;
				min-height: 100vh;
				margin: 0;
			}

			form {
				border: 1px solid #ccc;
				padding: 0 20px 20px 20px;
				max-width: 100%;
			}

			label {
				display: block;
				margin-bottom: 5px;
			}

			input[type="text"], input[type="number"] {
				width: 98.5%;
				padding: 8px;
				margin-bottom: 10px;
				border: 1px solid #ccc;
				border-radius: 4px;
			}

			input[type="submit"] {
				background-color: #ca8dfd;
				color: white;
				padding: 10px 20px;
				border: none;
				border-radius: 4px;
				cursor: pointer;
				margin-top: 10px;
			}

			input[type="submit"]:hover {
				background-color: #330066;
			}

			/* Add some spacing between forms */
			form + form {
				margin-top: 30px;
			}
			
			/* Additional styles for the hotels list table */
			table {
				width: 100%;
				border-collapse: collapse;
				border: 1px solid #ddd;
			}

			th, td {
				padding: 8px;
				text-align: left;
				border-bottom: 1px solid #ddd;
				border-right: 1px solid #ddd;
			}
			
			/* Remove right border from the last column (Image Path) */
			th:last-child, td:last-child {
				border-right: none;
			}
			
			/* Style for Name column */
			th:nth-child(1) { /* Rating */
				width: 10%;
				text-align: center;
			}
			
			/* Style for Description and Image Path columns */
			th:nth-child(2), /* Description */
			th:nth-child(6), /* Image Path */
			th:nth-child(7) { /* Action */
				text-align: center;
			}
			
			/* Style for Rating, Original Price and Discounted Price columns */
			th:nth-child(3), /* Rating */
			th:nth-child(4), /* Original Price */
			th:nth-child(5) { /* Discounted Price */
				width: 8%;
				text-align: center;
			}

			/* Center the rating, original_price, discounted_price, and image_path values */
			td:nth-child(1), /* Name */
			td:nth-child(3), /* Rating */
			td:nth-child(4), /* Original Price */
			td:nth-child(5), /* Discounted Price */
			td:nth-child(6), /* Image Path */
			td:nth-child(7) { /* Action */
				text-align: center;
			}

			th {
				background-color: #f2f2f2;
			}

			tr:hover {
				background-color: #f5f5f5;
			}
			
			/* Add flexbox to center align icons in the same row */
			td:nth-child(7) {
				justify-content: center;
				align-items: center;
			}
			
			/* Style for the icon buttons */
			.icon-button {
				border: none;
				background-color: transparent;
				cursor: pointer;
				font-size: 18px;
				margin: 0 5px;
				padding: 0;
				color: #555;
			}
			
			/* Edit button style (green) */
			.icon-button.edit-button {
				color: green;
			}

			/* Delete button style (red) */
			.icon-button.delete-button {
				color: red;
			}
			
			/* Modal overlay */
			.modal {
				display: none;
				align-items: center; /* Center vertically */
				justify-content: center; /* Center horizontally */
				position: fixed;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
			}

			/* Modal content box */
			.modal-content {
				background-color: #fefefe;
				margin: auto;
				padding: 20px;
				border: 1px solid #888;
				width: 60%;
				text-align: left;
				border-radius: 5px;
				position: relative;
				top: 20%;
			}

			/* Close button for the modal */
			.close {
				color: #aaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: black;
				text-decoration: none;
				cursor: pointer;
			}

			/* Buttons inside the modal */
			.modal-content button {
				margin-top: 10px;
				padding: 10px 20px;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}

			.modal-content button:first-child {
				background-color: #f44336; /* Red color for delete button */
				color: white;
			}

			.modal-content button:last-child {
				background-color: #ccc; /* Gray color for cancel button */
			}
			
			.whole_form {
				width: 100%;
				position: relative;
			}
			
			.form-container {
				border: 5px solid #ccc;
				padding: 20px;
				max-width: 66%;
				box-sizing: border-box;
			}
			
			.container {
				max-width: 100%;
			}
			
			/* Pagination style */
			.pagination {
				display: flex;
				justify-content: center;
				margin-top: 20px;
			}

			.pagination a {
				padding: 10px 15px;
				margin: 0 5px;
				text-decoration: none;
				color: #ca8dfd;
				background-color: #fff;
				border: 1px solid #ca8dfd;
				border-radius: 4px;
				transition: background-color 0.3s;
			}

			.pagination a:hover {
				background-color: #ca8dfd;
				color: #fff;
				border-color: #ca8dfd;
			}

			.pagination .active {
				background-color: #ca8dfd;
				color: #fff;
				border: 1px solid #ca8dfd;
			}
		</style>
		<!---------- End of Style ---------->
	</head>

	<body>
		<div class="container">
			<!--Link Header.php For Header-->
			<?php include 'Header_Admin.php'; ?>
	
			<!---------- Display Hotel ---------->
			<div style="display: flex; flex-direction: column; align-items: center; padding-top: 10px;">
				<div style="display: flex; justify-content: space-between;">
					<form class="form-container" style="position: relative; left: 275px; margin-top: 27px;">
						<h2>Hotels List</h2>
						<table>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Location</th>
								<th>Rating</th>
								<th>Original Price</th>
								<th>Discounted Price</th>
								<th>Image Path</th>
								<th>Action</th>
							</tr>
							
							<?php
								// Retrieve all hotels from the database
								$sql = "SELECT * FROM hotels";
								$result = $conn->query($sql);
								
								// Pagination logic
								$recordsPerPage = 10;
								$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
								$offset = ($currentPage - 1) * $recordsPerPage;

								// Retrieve limited hotels from the database
								$sql = "SELECT * FROM hotels LIMIT $offset, $recordsPerPage";
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) {
									// Within the while loop that displays hotel details in the table
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
											echo "<td>" . $row["name"] . "</td>";
											echo "<td>" . $row["description"] . "</td>";
											echo "<td>" . $row["location"] . "</td>";
											echo "<td>" . $row["rating"] . "</td>";
											echo "<td>RM " . $row["original_price"] . "</td>";
											echo "<td>RM " . $row["discounted_price"] . "</td>";
											echo "<td>";
												if (!empty($row["image_path"])) {
													echo "<img src='" . $row["image_path"] . "' alt='" . $row["name"] . "' style='max-width: 150px;'>";
												} else {
													echo "No image available";
												}
											echo "</td>";

											// Add edit and delete buttons with icons as buttons
											echo "<td>";
												echo "<div style='display: flex;'>";
													echo "<button type='button' onclick=\"openEditModal('" . $row["name"] . "', '" . $row["description"] . "',  '" . $row["location"] . "', '" . $row["rating"] . "', '" . $row["original_price"] . "', '" . $row["discounted_price"] . "', '" . $row["image_path"] . "')\" title='Edit' class='icon-button edit-button'><i class='fas fa-edit'></i></button>";
													echo "<button type='button' onclick=\"openModal('" . $row["name"] . "')\" title='Delete' class='icon-button delete-button'><i class='fas fa-trash'></i></button>";
												echo "</div>";
											echo "</td>";
										echo "</tr>";
									}
								} else {
									echo "<tr><td colspan='7'>No hotels found.</td></tr>";
								}
							?>
							
							<?php
								// delete_hotel.php
								if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["name"])) {
									$name = $_GET["name"];
									// Perform the delete operation using the $name variable
									// For example, you can call the deleteHotels() function from the main PHP file.
									deleteHotels($name);
									// Redirect back to the main page (Admin_Hotels.php) after deletion.
									header("Location: Admin_Hotels.php");
									exit();
								}
							?>
						</table>
						
						<!---------- Pagination ---------->
						<div class="pagination">
							<?php
								// Count total number of records
								$totalCountSql = "SELECT COUNT(*) as total FROM hotels";
								$totalCountResult = $conn->query($totalCountSql);
								$totalCountRow = $totalCountResult->fetch_assoc();
								$totalRecords = $totalCountRow['total'];

								// Calculate the total number of pages
								$totalPages = ceil($totalRecords / $recordsPerPage);

								// Display pagination links
								for ($i = 1; $i <= $totalPages; $i++) {
									$activeClass = ($i == $currentPage) ? "active" : "";
									echo '<a class="' . $activeClass . '" href="?page=' . $i . '">' . $i . '</a>';
								}
							?>
						</div>
						<!---------- End of Pagination ---------->	
					</form>
					
					<form method="post" action="" class="form-container" style="width: 17.5%; height: 685px; position: relative; right: 20px; bottom: 3px;">
						<h2>Create A New Hotel</h2>
						<input type="hidden" name="action" value="create">
						<label for="name">Name:</label>
						<input type="text" name="name" id="name" style="width: 94%;">
						<label for="description">Description:</label>
						<input type="text" name="description" id="description" style="width: 94%;">
						<label for="location">Location:</label>
						<input type="text" name="location" id="location" style="width: 94%;">
						<label for="rating">Rating:</label>
						<input type="number" name="rating" id="rating" step="0.1" style="width: 94%;">
						<label for="original_price">Original Price:</label>
						<input type="number" name="original_price" id="original_price" style="width: 94%;">
						<label for="discounted_price">Discounted Price:</label>
						<input type="number" name="discounted_price" id="discounted_price" style="width: 94%;">
						<label for="image_path">Image Path:</label>
						<input type="text" name="image_path" id="image_path" style="width: 94%;">
						<input type="submit" value="Create">
					</form>
				</div>
			</div>
			<!---------- End of Display Hotel ---------->
		
			<br><br>

			<!-- Edit Hotel -->
			<div id="editModal" class="modal">
				<div class="modal-content">
					<span class="close" onclick="closeEditModal()">&times;</span>
					<h2>Edit Hotel</h2>
					<form method="post" action="" style="padding-top: 10px;">
						<input type="hidden" name="action" value="update">
						<label for="edit_name">Name:</label>
						<input type="text" name="name" id="edit_name">
						<label for="edit_description">Description:</label>
						<input type="text" name="description" id="edit_description">
						<label for="edit_location">Location:</label>
						<input type="text" name="location" id="edit_location">
						<label for="edit_rating">Rating:</label>
						<input type="number" name="rating" id="edit_rating" step="0.1">
						<label for="edit_original_price">Original Price:</label>
						<input type="number" name="original_price" id="edit_original_price">
						<label for="edit_discounted_price">Discounted Price:</label>
						<input type="number" name="discounted_price" id="edit_discounted_price">
						<label for="edit_image_path">Image Path:</label>
						<input type="text" name="image_path" id="edit_image_path">
						<input type="submit" value="Update">
					</form>
				</div>
			</div>
			<!---------- End of Edit Hotel ---------->

			<!---------- Delete Hotel ---------->
			<div id="deleteModal" class="modal">
				<div class="modal-content" style="text-align: center;">
					<span class="close" onclick="closeModal()">&times;</span>
					<h2>Confirm Delete</h2>
					<p>Are you sure you want to delete the hotel:</p>
					<p id="hotelName"></p>
					<button onclick="deletehotel()">Delete</button>
					<button onclick="closeModal()">Cancel</button>
				</div>
			</div>
			<!---------- End of Delete Hotel ---------->
		</div>
	
		<!---------- Script ---------->
		<script>
			// JavaScript function to display the delete confirmation message with the hotel name
			function confirmDelete(hotelName) {
				if (confirm('Are you sure you want to delete the hotel "' + hotelName + '"?')) {
					// Redirect to the delete_hotel.php file with the hotel name as a parameter
					location.href = 'delete_hotel.php?name=' + hotelName;
				}
			}
		</script>
		
		<script>
			// Function to open the modal
			function openModal(hotelName) {
				const modal = document.getElementById('deleteModal');
				modal.style.display = 'block';
				document.getElementById('hotelName').innerText = hotelName;
			}

			// Function to close the modal
			function closeModal() {
				const modal = document.getElementById('deleteModal');
				modal.style.display = 'none';
			}

			// Function to handle the delete button click in the modal
			function deletehotel() {
				// Get the hotel name from the modal
				const hotelName = document.getElementById('hotelName').innerText;
			  
				// Redirect to the Admin.php file with the hotel name as a parameter
				location.href = 'Admin_Hotels.php?name=' + hotelName;
			}
		</script>
		
		<script>
			// Function to open the edit modal and pre-fill fields with hotel details
			function openEditModal(name, description, location, rating, original_price, discounted_price, image_path) {
				const modal = document.getElementById('editModal');
				modal.style.display = 'block';
			  
				// Pre-fill form fields with hotel details
				document.getElementById('edit_name').value = name;
				document.getElementById('edit_description').value = description;
				document.getElementById('edit_location').value = location;
				document.getElementById('edit_rating').value = rating;
				document.getElementById('edit_original_price').value = original_price;
				document.getElementById('edit_discounted_price').value = discounted_price;
				document.getElementById('edit_image_path').value = image_path;
			}

			// Function to close the edit modal
			function closeEditModal() {
				const modal = document.getElementById('editModal');
				modal.style.display = 'none';
			}
		</script>
		<!---------- End of Script ---------->
		
	</body>
</html>
