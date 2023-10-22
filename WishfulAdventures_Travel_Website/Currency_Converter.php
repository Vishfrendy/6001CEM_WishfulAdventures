<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Currency Converter</title>
		
		<!---------- Style ---------->
		<style>
			body {
				font-family: Arial, sans-serif;
				background-color: #fff;
				margin: 0;
				padding: 0;
			}

			#container {
				max-width: 600px;
				margin: 0 auto;
				padding: 24px;
				background-color: #ffffff;
				border-radius: 8px;
				box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
				margin-top: 36px;
			}

			h1 {
				text-align: center;
				margin-bottom: 30px;
			}

			label, select, input[type="number"], input[type="button"] {
				display: block;
				margin-bottom: 10px;
			}

			select, input[type="number"], input[type="button"] {
				width: 100%;
				padding: 10px;
				border: 1px solid #ccc;
				border-radius: 4px;
			}

			input[type="button"] {
				background-color: #ca8dfd;
				color: #ffffff;
				cursor: pointer;
				font-size: 16px;
			}

			input[type="button"]:hover {
				background-color: #330066;
			}

			#result {
				margin-top: 40px;
				font-size: 18px;
				display: flex;
				flex-direction: column;
				align-items: center;
				text-align: center;
			}

			#amount {
				width: 96.5%;
			}
		</style>
		<!---------- End of Style ---------->
	</head>

	<body>
		<!--Link Header.php For Header-->
		<?php include 'Header.php'; ?>
		
		<!---------- Currency Converter ---------->
		<div id="container">
			<h1>Currency Converter</h1>
			<form>
				<label for="amount">Amount:</label>
				<input id="amount" type="number" value="" placeholder="Enter Amount" />
				<br>
				
				<label for="primary">Primary Currency:</label>
				<select id="primary" class="input"></select>
				<br>
				
				<label for="secondary">Converted Currency:</label>
				<select id="secondary" class="input"></select>
				<br>
				
				<input id="btn-convert" type="button" value="Convert" />   
			</form>

			<p id="result" style="display:none;">
				<span id="txt-primary"></span>
				<span id="txt-secondary"></span>
			</p>
		</div>
		<!---------- End of Currency Converter ---------->

		<!---------- Script ---------->
		<script>
			const currencies = {
				AUD: "Australian Dollar",
				CAD: "Canadian Dollar",
				EUR: "Euro",
				GBP: "British Pound",
				INR: "Indian Rupee",
				JPY: "Japanese Yen",
				USD: "United States Dollar",
				ZAR: "South African Rand",
				MYR: "Malaysian Ringgit"
			};

			const primaryCurrency = document.getElementById("primary");
			const secondaryCurrency = document.getElementById("secondary");
			primaryCurrency.innerHTML = getOptions(currencies);
			secondaryCurrency.innerHTML = getOptions(currencies);

			function getOptions(data) {
				return Object.entries(data)
				.map(([country, currency]) => `<option value="${country}">${country} | ${currency}</option>`)
				.join("");
			}

			document.getElementById("btn-convert").addEventListener("click", fetchCurrencies);

			function fetchCurrencies() {
				const primary = primaryCurrency.value;
				const secondary = secondaryCurrency.value;
				const amount = document.getElementById("amount").value;
	
				// API key for ExchangeRate-API
				fetch("https://v6.exchangerate-api.com/v6/ac87ec82b933842fb690b75e/latest/" + primary) 
				.then((response) => {
					if (response.ok) {
						return response.json();
					} else {
						throw new Error("NETWORK RESPONSE ERROR");
					}
				})
				.then((data) => {
					console.log(data);
					displayCurrency(data, primary, secondary, amount);
				})
				.catch((error) => console.error("FETCH ERROR:", error));
			}

			function displayCurrency(data, primary, secondary, amount) {
				const calculated = amount * data.conversion_rates[secondary];
				document.getElementById("result").setAttribute("style", "display:block");
				document.getElementById("txt-primary").innerText = amount + " " + primary + " = ";
				document.getElementById("txt-secondary").innerText = calculated + " " + secondary;
			}
		</script>
		<!---------- End of Script ---------->
		
	</body>
</html>
