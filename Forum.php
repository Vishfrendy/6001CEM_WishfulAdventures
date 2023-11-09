<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wishfuladventures_travel_website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data from the database
$sql = "SELECT name FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Forum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #555;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }

        section {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .forum-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .forum-post {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .user-info {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .post-content {
            line-height: 1.5;
        }

        .reply {
            margin-left: 20px;
            padding: 10px;
            background-color: #eaeaea;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <section>
        <div class="forum-title">Travel Forums</div>

        <?php
        // Iterate through the user data and generate HTML for each user
        while ($row = $result->fetch_assoc()) {
            $username = $row['name'];

            // Generate HTML for each forum post
            echo '<div class="forum-post">';
            echo '<div class="user-info">' . $username . ' | Date</div>';
            echo '<div class="post-content">';
            echo '<p>This is a sample forum post. Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>';
            echo '</div>';

            // Generate HTML for replies (you can fetch these from the database as well)
            echo '<div class="reply">';
            echo '<div class="user-info">ReplyUser1 | Date</div>';
            echo '<div class="post-content">';
            echo '<p>This is a reply to the sample forum post. Duis aute irure dolor in reprehenderit...</p>';
            echo '</div>';
            echo '</div>';

            // Repeat the above block for additional replies if needed

            echo '</div>'; // Close forum-post div
        }
        ?>

    </section>

    <footer>
        &copy; 2023 My Forum
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

