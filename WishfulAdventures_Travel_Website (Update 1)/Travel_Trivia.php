<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Travel Trivia Challenge</title>
		
		<!---------- Style ---------->
		<style>
			body {
				font-family: 'Arial', sans-serif;
				text-align: center;
				background-color: #fff;
			}
			
			#quiz-container {
				position: relative;
				top: 100px;
				max-width: 600px;
				margin: auto;
				background-color: #fff;
				padding: 20px;
				border-radius: 8px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			}
			
			#question-count-container {
				text-align: left;
				margin-bottom: 20px;
				font-weight: bold;
			}
			
			#question-container {
				text-align: left;
				margin-bottom: 20px;
			}
			
			#options-container {
				text-align: center;
			}
			
			.option {
				display: inline-block;
				margin: 5px;
				padding: 10px 20px;
				background-color: #ca8dfd;
				color: #fff;
				text-decoration: none;
				border-radius: 5px;
				cursor: pointer;
				border: 0px solid #fff;
			}
			.option:hover {
				background-color: #330066;
				position: relative;
				bottom: 1px;
				transform: scale(1.05);
			}
			
			#result-container {
				margin-top: 20px;
				font-weight: bold;
			}

			#exit-button {
				position: relative;
				left: 300px;
				bottom: 12px;
				padding: 5px 10px;
				background-color: #ff5555;
				color: #fff;
				border: none;
				border-radius: 5px;
				cursor: pointer;
			}
			
			#quiz-container h2 {
				padding-bottom: 16px;
			}
		</style>
		<!---------- End of Style ---------->
	</head>

	<body>
		<!--Link Header.php For Header-->
		<?php include 'Header.php'; ?>

		<div id="quiz-container">
			<button id="exit-button" onclick="exitQuiz()">x</button>
			<h2>Travel Trivia Challenge</h2>
			<div id="question-count-container">
				<p id="question-count"></p>
			</div>
			
			<div id="question-container">
				<p id="question"></p>
			</div>
			
			<div id="options-container">
				<button class="option" onclick="checkAnswer(this)">Option 1</button>
				<button class="option" onclick="checkAnswer(this)">Option 2</button>
				<button class="option" onclick="checkAnswer(this)">Option 3</button>
				<button class="option" onclick="checkAnswer(this)">Option 4</button>
			</div>
			
			<div id="result-container"></div>
		</div>

		<!---------- Script ---------->
		<script>
			const questions = [
				{
					question: "What is the capital of France?",
					options: ["Berlin", "Madrid", "Paris", "Rome"],
					correctAnswer: "Paris"
				},
				{
					question: "Which country is known as the Land of the Rising Sun?",
					options: ["China", "Japan", "South Korea", "Vietnam"],
					correctAnswer: "Japan"
				},
				{
					question: "In which city can you find the Colosseum?",
					options: ["Rome", "Athens", "Cairo", "Istanbul"],
					correctAnswer: "Rome"
				},
				{
					question: "What is the currency of Japan?",
					options: ["Yuan", "Won", "Yen", "Ringgit"],
					correctAnswer: "Yen"
				},
				{
					question: "Which river runs through Egypt?",
					options: ["Nile", "Amazon", "Ganges", "Danube"],
					correctAnswer: "Nile"
				},
				{
					question: "The Great Barrier Reef is located in which country?",
					options: ["Australia", "Brazil", "Mexico", "Thailand"],
					correctAnswer: "Australia"
				},
				{
					question: "What is the official language of Brazil?",
					options: ["Spanish", "Portuguese", "Italian", "French"],
					correctAnswer: "Portuguese"
				},
				{
					question: "Which desert is the largest in the world?",
					options: ["Sahara", "Gobi", "Atacama", "Antarctic"],
					correctAnswer: "Sahara"
				},
				{
					question: "Machu Picchu is an ancient city located in which country?",
					options: ["Peru", "Mexico", "Ecuador", "Chile"],
					correctAnswer: "Peru"
				},
				{
					question: "What is the tallest mountain in the world?",
					options: ["Mount Everest", "K2", "Kangchenjunga", "Lhotse"],
					correctAnswer: "Mount Everest"
				},
				{
					question: "Which city is known as the 'City of Love'?",
					options: ["Venice", "Paris", "Rome", "Barcelona"],
					correctAnswer: "Paris"
				},
				{
					question: "In which country can you find the ancient city of Petra?",
					options: ["Egypt", "Jordan", "Lebanon", "Iraq"],
					correctAnswer: "Jordan"
				},
				{
					question: "What is the currency of India?",
					options: ["Rupee", "Baht", "Peso", "Dinar"],
					correctAnswer: "Rupee"
				},
				{
					question: "Which ocean is the largest?",
					options: ["Atlantic", "Indian", "Arctic", "Pacific"],
					correctAnswer: "Pacific"
				},
				{
					question: "The Louvre Museum is located in which city?",
					options: ["London", "Paris", "Berlin", "Rome"],
					correctAnswer: "Paris"
				},
				{
					question: "Which country is famous for its tulip fields?",
					options: ["Italy", "Netherlands", "France", "Switzerland"],
					correctAnswer: "Netherlands"
				},
				{
					question: "What is the capital of Australia?",
					options: ["Canberra", "Sydney", "Melbourne", "Perth"],
					correctAnswer: "Canberra"
				},
				{
					question: "Which African country is known as the 'Pearl of Africa'?",
					options: ["Kenya", "Nigeria", "Uganda", "South Africa"],
					correctAnswer: "Uganda"
				},
				{
					question: "In which country can you find the ancient city of Troy?",
					options: ["Greece", "Turkey", "Italy", "Egypt"],
					correctAnswer: "Turkey"
				},
				{
					question: "What is the national animal of Canada?",
					options: ["Bald Eagle", "Moose", "Panda", "Beaver"],
					correctAnswer: "Beaver"
				},
				{
					question: "What is the capital of India?",
					options: ["New Delhi", "Tamil Nadu", "Kerala", "Andhra Pradesh"],
					correctAnswer: "New Delhi"
				},
				{
					question: "What is the tallest mountain in Malaysia?",
					options: ["Mount Kinabalu", "Mount Mulu", "Mounth Ophir", "Mount Stong"],
					correctAnswer: "Mount Kinabalu"
				},
				{
					question: "What is the longest river in Malaysia?",
					options: ["Sungai Rajang", "Sungai Pahang", "Sungai Perak", "Sungai Kinabatangan"],
					correctAnswer: "Sungai Rajang"
				},
				{
					question: "What is the former name of Singapore?",
					options: ["Temasik", "Ceylon", "Southern Rhodesia", "Yamato"],
					correctAnswer: "Temasik"
				},
				{
					question: "What is the capital of Pulau Pinang, Malaysia?",
					options: ["George Town", "Nairobi", "Cape Town", "Kuala Lumpur"],
					correctAnswer: "George Town"
				},
				{
					question: "What is the capital of Thailand?",
					options: ["Phuket", "Bangkok", "Krabi", "Chiang Mai"],
					correctAnswer: "Bangkok"
				},
				{
					question: "What is the name of the river around Bangkok?",
					options: ["Pa Sak River", "Mae Klong River", "Mekong River", "Chao Phraya River"],
					correctAnswer: "Chao Phraya River"
				},
				{
					question: "What is the former capital of Myanmar?",
					options: ["Rakhine", "Kachin", "Rangoon", "Kayah"],
					correctAnswer: "Rangoon"
				},
				{
					question: "What is the name of the river where Yangon is situated?",
					options: ["Yangon River", "Sittaung River", "Dawei River", "Chindwin River"],
					correctAnswer: "Yangon River"
				},
				{
					question: "What is the largest and most populous island of Japan?",
					options: ["Hokkaido", "Honshu", "Kyushu", "Shikoku"],
					correctAnswer: "Honshu"
				},
				{
					question: "What is the capital of Japan?",
					options: ["Kyoto", "Osaka", "Tokyo", "Hokkaido"],
					correctAnswer: "Tokyo"
				},
				{
					question: "What is the tallest mountain in Japan?",
					options: ["Mount Norikura", "Mount Fuji", "Mount Haku", "Mount Hotaka"],
					correctAnswer: "Mount Fuji"
				},
				{
					question: "What is the capital of South Korea?",
					options: ["Busan", "Daegu", "Gwangju", "Seoul"],
					correctAnswer: "Seoul"
				},
				{
					question: "What is the capital of Taiwan?",
					options: ["Tainan", "Kaohsiung", "Taipei", "Taichung"],
					correctAnswer: "Taipei"
				},
				{
					question: "What is the capital of Cambodia?",
					options: ["Prey Veng", "Koh Kong", "Phnom Penh", "Siem Reap"],
					correctAnswer: "Phnom Penh"
				},
				{
					question: "What is the capital of Indonesia?",
					options: ["Jakarta", "Surabaya", "Bandung", "Medan"],
					correctAnswer: "Jakarta"
				},
				{
					question: "What is the old capital of Indonesia?",
					options: ["Semarang", "Makassar", "Yogyakarta", "Denpasar"],
					correctAnswer: "Yogyakarta"
				},
				{
					question: "What is the capital of Phillipines?",
					options: ["Cebu", "Manila", "Davao", "Quezon"],
					correctAnswer: "Manila"
				},
				{
					question: "In which island is Manilla located?",
					options: ["Luzon Island", "Mindanao Island", "Camiguin Island", "Boracay Island"],
					correctAnswer: "Luzon Island"
				},
				{
					question: "How many states does Malaysia have?",
					options: ["12", "13", "14", "15"],
					correctAnswer: "13"
				},
				{
					question: "What is the national flower for Malaysia?",
					options: ["Bunga Rafflesia", "Bunga Melati", "Bunga Mawar", "Bunga Raya"],
					correctAnswer: "Bunga Raya"
				},
				{
					question: "Which state is known as rice bowl of Malaysia?",
					options: ["Perlis", "Pahang", "Kedah", "Perak"],
					correctAnswer: "Kedah"
				},
				{
					question: "Which fruit is famous in Malaysia?",
					options: ["Pineapple", "Mango", "Kiwi", "Durian"],
					correctAnswer: "Durian"
				},
				{
					question: "Which Malaysian island is well known as 'The Jewel of Kedah'?",
					options: ["Pangkor Island", "Langkawi Island", "Redang Island", "Penang Island"],
					correctAnswer: "Langkawi Island"
				},	
				{
					question: "Which mountain range is the highest in the world?",
					options: ["Andes", "Alps", "Himalayas", "Rockies"],
					correctAnswer: "Himalayas"
				},	
				{
					question: "Which country is famous for its fjords?",
					options: ["Sweden", "Norway", "Iceland", "Finland"],
					correctAnswer: "Norway"
				},	
				{
					question: "What is the nickname for New York City?",
					options: ["The Windy City", "The Big Apple", "The City of Angels", "The City of Lights"],
					correctAnswer: "The Big Apple"
				},	
				{
					question: "What is the famous ancient wonder located in Egypt?",
					options: ["Acropolis", "Colosseum", "Pyramids of Giza", "Machu Picchu"],
					correctAnswer: "Pyramids of Giza"
				},	
				{
					question: "Which European city is divided into two parts by the Bosphorus Strait?",
					options: ["Istanbul", "Athens", "Madrid", "Budapest"],
					correctAnswer: "Istanbul"
				},	
				{
					question: "Which U.S. state is known as the 'Sunshine State'?",
					options: ["California", "Florida", "Texas", "Hawaii"],
					correctAnswer: "Florida"
				},	
			];

			let correctAnswersCount = 0;
			let currentQuestionIndex = 0;

			function loadQuestion() {
				const currentQuestion = questions[currentQuestionIndex];
				document.getElementById('question-count').innerText = `Question ${currentQuestionIndex + 1}/${questions.length}`;
				document.getElementById('question').innerText = currentQuestion.question;

				const optionsContainer = document.getElementById('options-container');
				optionsContainer.innerHTML = "";
				currentQuestion.options.forEach((option, index) => {
					const button = document.createElement('button');
					button.classList.add('option');
					button.innerText = option;
					button.onclick = function() {
						checkAnswer(this);
					};
					optionsContainer.appendChild(button);
				});
			}

			function checkAnswer(selectedOption) {
				const selectedAnswer = selectedOption.innerText;
				const currentQuestion = questions[currentQuestionIndex];

				if (selectedAnswer === currentQuestion.correctAnswer) {
					document.getElementById('result-container').innerText = "Correct!";
					correctAnswersCount++;
				} else {
					document.getElementById('result-container').innerText = "Incorrect. The correct answer is: " + currentQuestion.correctAnswer;
				}

				currentQuestionIndex++;

				if (currentQuestionIndex < questions.length) {
					setTimeout(function () {
						loadQuestion();
						document.getElementById('result-container').innerText = "";
					}, 1000);
				} else {
					// Display the final results
					const quizContainer = document.getElementById('quiz-container');
					quizContainer.innerHTML = "<h2>Quiz Completed!</h2>";

					// Calculate percentage
					const percentage = (correctAnswersCount / questions.length) * 100;

					// Display the number of correct answers out of the total
					quizContainer.innerHTML += `<p>You got ${correctAnswersCount} out of ${questions.length} questions right!</p>`;

					if (percentage >= 90) {
						quizContainer.innerHTML += "<p>You've gotten a special discount:</p>";
						quizContainer.innerHTML += "<img src='Voucher.png' alt='Special Discount Image' style='width: 500px;'>";
					} else {
						quizContainer.innerHTML += "<p>Nice try! Have a good day.</p>";
					}
				}
			}
			
			function exitQuiz() {
				document.getElementById('quiz-container').innerHTML = "<h2>Quiz Aborted!</h2>";
			}

			// Initial load
			loadQuestion();
		</script>
		<!---------- Script ---------->
		
	</body>
</html>
