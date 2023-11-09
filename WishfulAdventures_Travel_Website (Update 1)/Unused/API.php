<?php
header('Content-Type: application/json');

// Sample data
$hotels = [
    [
        "name" => "Berjaya Times Square Hotel, Kuala Lumpur",
        "description" => "1, Jalan Imbi, Kuala Lumpur 55100, Malaysia",
        "rating" => 3.5,
        "min_price" => 261,
        "max_price" => 373,
        "image_path" => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/10/23/91/53/hotel-exterior.jpg?w=1200&h=-1&s=1",
    ],
    [
        "name" => "Hotel Royal Kuala Lumpur",
        "description" => "Jalan Walter Grenier, Kuala Lumpur 55100, Malaysia",
        "rating" => 3.5,
        "min_price" => 181,
        "max_price" => 307,
        "image_path" => "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0a/f0/95/26/caption.jpg?w=1200&h=-1&s=1",
    ],
    // ... (add more hotels as needed)
];

// API endpoint to get a list of hotels
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(["hotels" => $hotels]);
}
?>

