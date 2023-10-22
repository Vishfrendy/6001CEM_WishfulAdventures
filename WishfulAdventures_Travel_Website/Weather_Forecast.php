<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Weather Forecast</title>
		
		<!---------- Style ---------->
		<style>
			* {
				margin: 0;
				padding: 0;
			}
			
			h1 {
				font-size: 1.75rem;
				text-align: center;
				padding: 18px 0;
				color: #000;
			}
			
			.container {
				display: flex;
				gap: 35px;
				padding: 30px;
				width: 1200px;
				margin: 0 auto;
			}
			
			.weather-input {
				width: 250px;
				text-align: center;
				margin: auto;
			}
			
			.weather-input input {
				height: 46px;
				width: 250px;
				outline: none;
				font-size: 1.07rem;
				text-align: center;
				margin: 10px 0 15px 0;
				border-radius: 4px;
				border: 1px solid #ccc;
			}
			
			.weather-input input:focus {
				border: 1px solid #ca8dfd;
			}
			
			.weather-input button {
				width: 250px;
				padding: 10px 0;
				cursor: pointer;
				outline: none;
				border: none;
				border-radius: 4px;
				font-size: 1rem;
				color: #fff;
				background: #ca8dfd;
				transition: 0.2s ease;
			}
			
			.weather-input .search-btn:hover {
				background: #330066;
			}
			
			.weather-data {
				width: 100%;
			}
			
			.weather-data .current-weather {
				color: #fff;
				background: #ca8dfd;
				border-radius: 5px;
				padding: 20px 70px 20px 20px;
				display: flex;
				justify-content: space-between;
			}

			.current-weather h2 {
				font-weight: 700;
				font-size: 1.7rem;
			}
			
			.weather-data h6 {
				margin-top: 12px;
				font-size: 1rem;
				font-weight: 500;
			}
			
			.current-weather .icon {
				text-align: center;
			}
			
			.current-weather .icon img {
				max-width: 120px;
				margin-top: -15px;
			}
			
			.current-weather .icon h6 {
				margin-top: -10px;
				text-transform: capitalize;
			}
			
			.days-forecast h2 {
				padding-top: 20px;
				margin: 20px 0;
				font-size: 1.5rem;
			}
			
			.days-forecast .weather-cards {
				display: flex;
				gap: 20px;
			} 
			
			.icon h6 {
				text-shadow: 1px 1px 2px #000000;	
			}
			
			.weather-cards .card {
				color: #fff;
				padding: 18px 16px;
				list-style: none;
				width: calc(100% / 5);
				background: #ca8dfd;
				border-radius: 5px;
				text-shadow: 1px 1px 2px #000000;
			}
			
			.details {
				text-shadow: 1px 1px 2px #000000;
			}
			
			.weather-cards .card h3 {
				font-size: 1.3rem;
				font-weight: 600;
			}
			
			.weather-cards .card img {
				max-width: 70px;
				margin: 5px 0 -12px 0;
			}
			
			.search-container {
				display: flex;
				align-items: center;
				gap: 10px;
			}
		</style>
		<!---------- End of Style ---------->
	</head>
	
	<body>
		<!--Link Header.php For Header-->
		<?php include 'Header.php'; ?>
		
		<h1>Weather Dashboard</h1>
		
		<!---------- Search Section ---------->
		<div class="container">
			<div class="weather-input">
				<!--<h3>Enter a City Name</h3>-->
				<input class="city-input" type="text" placeholder="Search City (Ex. London)">
				<button class="search-btn">Search</button>
			</div>
		</div>
		<!---------- End of Search Section ---------->
		
		<!---------- Weather Forecast ---------->
		<div class="container">
			<div class="weather-data">
				<h2 style="margin: 20px 0; font-size: 1.5rem;">Today Forecast</h2>
				<div class="current-weather">
					<div class="details">
						<h2>_______ ( ______ )</h2>
						<h6>Temperature: __°C</h6>
						<h6>Wind: __ M/S</h6>
						<h6>Humidity: __%</h6>
					</div>
				</div>
				
				<div class="days-forecast">
					<h2>5-Day Forecast</h2>
					<ul class="weather-cards">
						<li class="card">
							<h3>( ______ )</h3>
							<h6>Temp: __C</h6>
							<h6>Wind: __ M/S</h6>
							<h6>Humidity: __%</h6>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!---------- End of Weather Forecast ---------->

		<!---------- Script ---------->
		<script>
			const cityInput = document.querySelector(".city-input");
			const searchButton = document.querySelector(".search-btn");
			const currentWeatherDiv = document.querySelector(".current-weather");
			const weatherCardsDiv = document.querySelector(".weather-cards");

			const API_KEY = "70a03e5af44ce0af5f562a4ae85e0218"; // API key for OpenWeatherMap API

			const createWeatherCard = (cityName, weatherItem, index) => {
				if (index === 0) {
					return `
						<div class="details">
							<h2>${cityName} (${formatDate(weatherItem.dt_txt)})</h2>
							<h6>Temperature: ${(weatherItem.main.temp - 273.15).toFixed(2)}°C</h6>
							<h6>Wind: ${weatherItem.wind.speed} M/S</h6>
							<h6>Humidity: ${weatherItem.main.humidity}%</h6>
						</div>
						
						<div class="icon">
							<img src="https://openweathermap.org/img/wn/${weatherItem.weather[0].icon}@4x.png" alt="weather-icon">
							<h6>${weatherItem.weather[0].description}</h6>
						</div>
					`;
				} else {
					return `
						<li class="card">
							 <h3>(${formatDate(weatherItem.dt_txt)})</h3>
							<img src="https://openweathermap.org/img/wn/${weatherItem.weather[0].icon}@4x.png" alt="weather-icon">
							<h6>Temp: ${(weatherItem.main.temp - 273.15).toFixed(2)}°C</h6>
							<h6>Wind: ${weatherItem.wind.speed} M/S</h6>
							<h6>Humidity: ${weatherItem.main.humidity}%</h6>
						</li>
					`;
				}
			}

			const getWeatherDetails = (cityName, latitude, longitude) => {
				const WEATHER_API_URL = `https://api.openweathermap.org/data/2.5/forecast?lat=${latitude}&lon=${longitude}&appid=${API_KEY}`;

				fetch(WEATHER_API_URL).then(response => response.json()).then(data => {
					// Filter the forecasts to get only one forecast per day
					const uniqueForecastDays = [];
					const fiveDaysForecast = data.list.filter(forecast => {
						const forecastDate = new Date(forecast.dt_txt).getDate();
						if (!uniqueForecastDays.includes(forecastDate)) {
							return uniqueForecastDays.push(forecastDate);
						}
					});

					// Clearing previous weather data
					cityInput.value = "";
					currentWeatherDiv.innerHTML = "";
					weatherCardsDiv.innerHTML = "";

					// Creating weather cards and adding them to the DOM
					fiveDaysForecast.forEach((weatherItem, index) => {
						const html = createWeatherCard(cityName, weatherItem, index);
						if (index === 0) {
							currentWeatherDiv.insertAdjacentHTML("beforeend", html);
						} else {
							weatherCardsDiv.insertAdjacentHTML("beforeend", html);
						}
					});        
				}).catch(() => {
					alert("An error occurred while fetching the weather forecast!");
				});
			}

			const getCityCoordinates = () => {
				const cityName = cityInput.value.trim();
				if (cityName === "") return;
				const API_URL = `https://api.openweathermap.org/geo/1.0/direct?q=${cityName}&limit=1&appid=${API_KEY}`;
				
				// Get entered city coordinates (latitude, longitude, and name) from the API response
				fetch(API_URL).then(response => response.json()).then(data => {
					if (!data.length) return alert(`No coordinates found for ${cityName}`);
					const { lat, lon, name } = data[0];
					getWeatherDetails(name, lat, lon);
				}).catch(() => {
					alert("An error occurred while fetching the coordinates!");
				});
			}

			const getUserCoordinates = () => {
				navigator.geolocation.getCurrentPosition(
					position => {
						const { latitude, longitude } = position.coords; // Get coordinates of user location
						// Get city name from coordinates using reverse geocoding API
						const API_URL = `https://api.openweathermap.org/geo/1.0/reverse?lat=${latitude}&lon=${longitude}&limit=1&appid=${API_KEY}`;
						fetch(API_URL).then(response => response.json()).then(data => {
							const { name } = data[0];
							getWeatherDetails(name, latitude, longitude);
						}).catch(() => {
							alert("An error occurred while fetching the city name!");
						});
					},
					error => { // Show alert if user denied the location permission
						if (error.code === error.PERMISSION_DENIED) {
							alert("Geolocation request denied. Please reset location permission to grant access again.");
						} else {
							alert("Geolocation request error. Please reset location permission.");
						}
					});
			}
			
			const formatDate = dateString => {
				const date = new Date(dateString);
				const day = String(date.getDate()).padStart(2, '0');
				const month = String(date.getMonth() + 1).padStart(2, '0');
				const year = date.getFullYear();
				return `${day}/${month}/${year}`;
			};

			searchButton.addEventListener("click", getCityCoordinates);
			cityInput.addEventListener("keyup", e => e.key === "Enter" && getCityCoordinates());
		</script>
		<!---------- End of Script ---------->
		
	</body>
</html>
