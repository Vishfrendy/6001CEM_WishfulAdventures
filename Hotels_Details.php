<!-- hotel_details.php -->

<?php
// Step 1: Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'wishfuladventures_travel_website');

// Step 2: Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 3: Get the hotel ID from the URL parameter
$hotel_id = $_GET['id'];

// Step 4: Fetch data for the specific hotel
$sql = "SELECT * FROM hotels WHERE id = $hotel_id";
$result = mysqli_query($conn, $sql);

// Step 5: Display the hotel details
if ($row = mysqli_fetch_assoc($result)) {
    echo '<div>';
    echo '<h1>' . $row['name'] . '</h1>';
    echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
    echo '<p>Location: ' . $row['location'] . '</p>';
    echo '<p>Description: ' . $row['description'] . '</p>';
    echo '<p>Rating: ' . $row['rating'] . '</p>';
    echo '<p>Discounted Price: RM' . $row['discounted_price'] . '</p>';
    echo '<p>Original Price: RM' . $row['original_price'] . '</p>';
    // Add more details as needed

    echo '</div>';
}

// Step 6: Close the database connection
mysqli_close($conn);
?>
