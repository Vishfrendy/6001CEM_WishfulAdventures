<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel API</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        #hotels-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .hotel-card {
            position: relative;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .hotel-count {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #3498db;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .hotel-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Hotels List</h1>

<div id="hotels-list" class="flex-container"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fetch hotels from the API
    fetch('api.php') // Assuming your PHP script is named api.php
        .then(response => response.json())
        .then(data => {
            // Display hotels in the HTML
            const hotelsList = document.getElementById('hotels-list');
            data.hotels.forEach((hotel, index) => {
                const hotelElement = document.createElement('div');
                hotelElement.className = 'hotel-card';
                hotelElement.innerHTML = `
                    <div class="hotel-count">${index + 1}</div>
                    <h2>${hotel.name}</h2>
                    <p>${hotel.description}</p>
                    <p>Rating: ${hotel.rating}</p>
                    <p>Price Range: $${hotel.min_price} - $${hotel.max_price}</p>
                    <img src="${hotel.image_path}" alt="${hotel.name}">
                `;
                hotelsList.appendChild(hotelElement);
            });
        })
        .catch(error => console.error('Error fetching hotels:', error));
});
</script>

</body>
</html>
