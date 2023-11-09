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
			$rating = isset($_POST["rating"]) ? $_POST["rating"] : '';
			$min_price = isset($_POST["min_price"]) ? $_POST["min_price"] : '';
			$max_price = isset($_POST["max_price"]) ? $_POST["max_price"] : '';
			$image_path = isset($_POST["image_path"]) ? $_POST["image_path"] : '';
			createDestinations($name, $description, $rating, $min_price, $max_price, $image_path);
			
			// Redirect after successful form submission
			header("Location: Admin.php");
			exit(); // Make sure to exit after redirecting
			
		} elseif ($action === "update") {
			$name = isset($_POST["name"]) ? $_POST["name"] : '';
			$description = isset($_POST["description"]) ? $_POST["description"] : '';
			$rating = isset($_POST["rating"]) ? $_POST["rating"] : '';
			$min_price = isset($_POST["min_price"]) ? $_POST["min_price"] : '';
			$max_price = isset($_POST["max_price"]) ? $_POST["max_price"] : '';
			$image_path = isset($_POST["image_path"]) ? $_POST["image_path"] : '';
			updateDestinations($name, $description, $rating, $min_price, $max_price, $image_path);
		} elseif ($action === "delete") {
			$name = isset($_POST["name"]) ? $_POST["name"] : '';
			deleteDestinations($name);
		}
	}

	// Create a new destinations
	function createDestinations($name, $description, $rating, $min_price, $max_price, $image_path) {
		global $conn;
		$sql = "INSERT INTO destinations (name, description, rating, min_price, max_price, image_path) VALUES ('$name', '$description', '$rating', '$min_price', '$max_price', '$image_path')";
		$conn->query($sql);
	}

	// Read destinations details by name
	function readDestinations($name) {
		global $conn;
		$sql = "SELECT * FROM destinations WHERE name = '$name'";
		$result = $conn->query($sql);
		return $result->fetch_assoc();
	}

	// Update destinations details by name
	function updateDestinations($name, $description, $rating, $min_price, $max_price, $image_path) {
		global $conn;
		$sql = "UPDATE destinations SET description = '$description', rating = '$rating', min_price = '$min_price', max_price = '$max_price', image_path = '$image_path' WHERE name = '$name'";
		$conn->query($sql);
	}

	// Delete destinations by name
	function deleteDestinations($name) {
		global $conn;
		$sql = "DELETE FROM destinations WHERE name = '$name'";
		$conn->query($sql);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin</title>
		
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
			
			/* Additional styles for the destinations list table */
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
			
			/* Style for Rating, Min Price and Max Price columns */
			th:nth-child(3), /* Rating */
			th:nth-child(4), /* Min Price */
			th:nth-child(5) { /* Max Price */
				width: 8%;
				text-align: center;
			}

			/* Center the rating, min_price, max_price, and image_path values */
			td:nth-child(1), /* Name */
			td:nth-child(3), /* Rating */
			td:nth-child(4), /* Min Price */
			td:nth-child(5), /* Max Price */
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
			
			<!---------- Display Destination ---------->
			<div style="display: flex; flex-direction: column; align-items: center; padding-top: 10px;">
				<div style="display: flex; justify-content: space-between;">
					<form class="form-container" style="position: relative; left: 275px; margin-top: 27px;">
						<h2>Destinations List</h2>
						<table>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Rating</th>
								<th>Min Price</th>
								<th>Max Price</th>
								<th>Image Path</th>
								<th>Action</th>
							</tr>
							
							<?php
								// Retrieve all destinations from the database
								$sql = "SELECT * FROM destinations";
								$result = $conn->query($sql);
								
								// Pagination logic
								$recordsPerPage = 10;
								$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
								$offset = ($currentPage - 1) * $recordsPerPage;

								// Retrieve limited destinations from the database
								$sql = "SELECT * FROM destinations LIMIT $offset, $recordsPerPage";
								$result = $conn->query($sql);
									
								if ($result->num_rows > 0) {
									// Within the while loop that displays destination details in the table
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
											echo "<td>" . $row["name"] . "</td>";
											echo "<td>" . $row["description"] . "</td>";
											echo "<td>" . $row["rating"] . "</td>";
											echo "<td>RM " . $row["min_price"] . "</td>";
											echo "<td>RM " . $row["max_price"] . "</td>";
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
													echo "<button type='button' onclick=\"openEditModal('" . $row["name"] . "', '" . $row["description"] . "', '" . $row["rating"] . "', '" . $row["min_price"] . "', '" . $row["max_price"] . "', '" . $row["image_path"] . "')\" title='Edit' class='icon-button edit-button'><i class='fas fa-edit'></i></button>";
													echo "<button type='button' onclick=\"openModal('" . $row["name"] . "')\" title='Delete' class='icon-button delete-button'><i class='fas fa-trash'></i></button>";
												echo "</div>";
											echo "</td>";
										echo "</tr>";
									}
								} else {
									echo "<tr><td colspan='7'>No destinations found.</td></tr>";
								}
							?>
							
							<?php
								// delete_destination.php
								if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["name"])) {
									$name = $_GET["name"];
									// Perform the delete operation using the $name variable
									// For example, you can call the deleteDestinations() function from the main PHP file.
									deleteDestinations($name);
									// Redirect back to the main page (Admin.php) after deletion.
									header("Location: Admin.php");
									exit();
								}
							?>
						</table>
						
						<!---------- Pagination ---------->
						<div class="pagination">
							<?php
								// Count total number of records
								$totalCountSql = "SELECT COUNT(*) as total FROM destinations";
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
					
					<form method="post" action="" class="form-container" style="width: 17.5%; height: 650px; position: relative; right: 20px; bottom: 3px;">
						<h2>Create A New Destination</h2>
						<input type="hidden" name="action" value="create">
						<label for="name">Name:</label>
						<input type="text" name="name" id="name" style="width: 94%;">
						<label for="description">Description:</label>
						<input type="text" name="description" id="description" style="width: 94%;">
						<label for="rating">Rating:</label>
						<input type="number" name="rating" id="rating" step="0.1" style="width: 94%;">
						<label for="min_price">Min Price:</label>
						<input type="number" name="min_price" id="min_price" style="width: 94%;">
						<label for="max_price">Max Price:</label>
						<input type="number" name="max_price" id="max_price" style="width: 94%;">
						<label for="image_path">Image Path:</label>
						<input type="text" name="image_path" id="image_path" style="width: 94%;">
						<input type="submit" value="Create">
					</form>
				</div>
			</div>
			<!---------- End of Display Destination ---------->
			
			<br><br>

			<!---------- Edit Destination ---------->
			<div id="editModal" class="modal">
				  <div class="modal-content">
					<span class="close" onclick="closeEditModal()">&times;</span>
					<h2>Edit Destination</h2>
					<form method="post" action="" style="padding-top: 10px;">
						<input type="hidden" name="action" value="update">
						<label for="edit_name">Name:</label>
						<input type="text" name="name" id="edit_name">
						<label for="edit_description">Description:</label>
						<input type="text" name="description" id="edit_description">
						<label for="edit_rating">Rating:</label>
						<input type="number" name="rating" id="edit_rating" step="0.1">
						<label for="edit_min_price">Min Price:</label>
						<input type="number" name="min_price" id="edit_min_price">
						<label for="edit_max_price">Max Price:</label>
						<input type="number" name="max_price" id="edit_max_price">
						<label for="edit_image_path">Image Path:</label>
						<input type="text" name="image_path" id="edit_image_path">
						<input type="submit" value="Update">
					</form>
				  </div>
			</div>
			<!---------- End of Edit Destination ---------->

			<!---------- Delete Destination ---------->
			<div id="deleteModal" class="modal">
				<div class="modal-content" style="text-align: center;">
					<span class="close" onclick="closeModal()">&times;</span>
					<h2>Confirm Delete</h2>
					<p>Are you sure you want to delete the destination:</p>
					<p id="destinationName"></p>
					<button onclick="deleteDestination()">Delete</button>
					<button onclick="closeModal()">Cancel</button>
				</div>
			</div>
			<!---------- End of Delete Destination ---------->
			
		</div>

		<!---------- Script ---------->
		<script>
			// JavaScript function to display the delete confirmation message with the destination name
			function confirmDelete(destinationName) {
				if (confirm('Are you sure you want to delete the destination "' + destinationName + '"?')) {
					// Redirect to the delete_destination.php file with the destination name as a parameter
					location.href = 'delete_destination.php?name=' + destinationName;
				}
			}
		</script>
		
		<script>
			// Function to open the modal
			function openModal(destinationName) {
				const modal = document.getElementById('deleteModal');
				modal.style.display = 'block';
				document.getElementById('destinationName').innerText = destinationName;
			}

			// Function to close the modal
			function closeModal() {
				const modal = document.getElementById('deleteModal');
				modal.style.display = 'none';
			}

			// Function to handle the delete button click in the modal
			function deleteDestination() {
				// Get the destination name from the modal
				const destinationName = document.getElementById('destinationName').innerText;
			  
				// Redirect to the Admin.php file with the destination name as a parameter
				location.href = 'Admin.php?name=' + destinationName;
			}
		</script>
		
		<script>
			// Function to open the edit modal and pre-fill fields with destination details
			function openEditModal(name, description, rating, min_price, max_price, image_path) {
				const modal = document.getElementById('editModal');
				modal.style.display = 'block';
			  
				// Pre-fill form fields with destination details
				document.getElementById('edit_name').value = name;
				document.getElementById('edit_description').value = description;
				document.getElementById('edit_rating').value = rating;
				document.getElementById('edit_min_price').value = min_price;
				document.getElementById('edit_max_price').value = max_price;
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
