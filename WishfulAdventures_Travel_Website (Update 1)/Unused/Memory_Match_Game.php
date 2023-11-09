<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Memory Match Game</title>

		<style>
		body {
		  background-color: #fff;
		}
		.wrapper {
		  box-sizing: content-box;
		  width: 26.87em;
		  padding: 2.5em 3em;
		  background-color: #ffffff;
		  position: absolute;
		  transform: translate(-50%, -50%);
		  left: 50%;
		  top: 50%;
		  border-radius: 0.6em;
		  box-shadow: 0 0.9em 2.8em rgba(86, 66, 0, 0.2);
		}
		.game-container {
		  position: relative;
		  width: 100%;
		  display: grid;
		  gap: 0.6em;
		}
		.stats-container {
		  text-align: right;
		  margin-bottom: 1.2em;
		}
		.stats-container span {
		  font-weight: 600;
		}
		.card-container {
		  position: relative;
		  width: 6.25em;
		  height: 6.25em;
		  cursor: pointer;
		}
		.card-before,
		.card-after {
		  position: absolute;
		  border-radius: 5px;
		  width: 100%;
		  height: 100%;
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  border: 4px solid #000000;
		  transition: transform 0.7s ease-out;
		  backface-visibility: hidden;
		}
		.card-before {
		  background-color: #ca8dfd;
		  font-size: 2.8em;
		  font-weight: 600;
		  color: white;
		}
		.card-after img {
		  width: 100px;
		  height: 100px;
		}
		.card-after {
		  background-color: #ffffff;
		  transform: rotateY(180deg);
		}
		.card-container.flipped .card-before {
		  transform: rotateY(180deg);
		}
		.card-container.flipped .card-after {
		  transform: rotateY(0deg);
		}
	
		button {
		  border: none;
		  border-radius: 0.3em;
		  padding: 1em 1.5em;
		  cursor: pointer;
		  background-color: #ca8dfd;
		  color: white;
		}
		
		#stop {
		  font-size: 1.1em;
		  display: block;
		  margin: 1.1em auto 0 auto;
		  background-color: #ca8dfd;
		  color: #ffffff;
		}
		.controls-container button {
		  font-size: 1.1em;
		  box-shadow: 0 0.6em 2em rgba(86, 66, 0, 0.2);
		  position: relative;
		  top: 575px;
		  left: 890px;
		}
		.hide {
		  display: none;
		}
		#result {
		  text-align: center;
		}
		#result h2 {
		  font-size: 2.5em;
		}
		#result h4 {
		  font-size: 1.8em;
		  margin: 0.6em 0 1em 0;
		}
		</style>
	</head>

	<body>
		<!--Link Header.php For Header-->
		<?php include 'Header.php'; ?>
		
		<div class="wrapper">
		  <div class="stats-container">
			<div id="moves-count"></div>
			<div id="time"></div>
		  </div>
		  <div class="game-container"></div>
		  <button id="stop" class="hide">Stop Game</button>
		</div>
		
		<div class="controls-container">
		  <p id="result"></p>
		  <button id="start">Start Game</button>
		</div>
		
		<script>
		const moves = document.getElementById("moves-count");
		const timeValue = document.getElementById("time");
		const startButton = document.getElementById("start");
		const stopButton = document.getElementById("stop");
		const gameContainer = document.querySelector(".game-container");
		const result = document.getElementById("result");
		const controls = document.querySelector(".controls-container");
		let cards;
		let interval;
		let firstCard = false;
		let secondCard = false;

		//Items array
		const items = [
		  { name: "malaysia", image: "https://thesmartlocal.my/wp-content/uploads/2023/01/Free-things-to-do-in-Kuala-Lumpur-23.jpg" },
		  { name: "australia", image: "https://expatra.com/wp-content/uploads/2021/08/Sydney_opera_house.jpg" },
		  { name: "philippines", image: "https://i.natgeofe.com/n/8632bc0a-6c1c-4f6c-80da-7aeda6ec47c5/Archipelago%20Philippines_square.jpg" },
		  { name: "thailand", image: "https://media.timeout.com/images/105240236/image.jpg" },
		  { name: "south_korea", image: "https://tourscanner.com/blog/wp-content/uploads/2022/08/things-to-do-in-Seoul-South-Korea.jpg" },
		  { name: "france", image: "https://www.ciee.org/sites/default/files/images/2023-04/paris-tower-river-skyline_0.jpg" },
		  { name: "spain", image: "https://spanishstudies.org/wp-content/uploads/2019/05/spanish-studies-abroad-barcelona-sagrada-familia.jpg" },
		  { name: "brazil", image: "https://i.fltcdn.net/contents/3260/original_1470729031686_6sq048cl3di.jpeg" },
		  //{ name: "italy", image: "1" },
		  //{ name: "switzerland", image: "2" },
		  //{ name: "belgium", image: "3" },
		  //{ name: "united_kingdom", image: "4" },
		  //{ name: "ireland", image: "5" },
		  //{ name: "japan", image: "6" },
		  //{ name: "new_zealand", image: "7" },
		];

		//Initial Time
		let seconds = 0,
		  minutes = 0;
		//Initial moves and win count
		let movesCount = 0,
		  winCount = 0;

		//For timer
		const timeGenerator = () => {
		  seconds += 1;
		  //minutes logic
		  if (seconds >= 60) {
			minutes += 1;
			seconds = 0;
		  }
		  //format time before displaying
		  let secondsValue = seconds < 10 ? `0${seconds}` : seconds;
		  let minutesValue = minutes < 10 ? `0${minutes}` : minutes;
		  timeValue.innerHTML = `<span>Time:</span>${minutesValue}:${secondsValue}`;
		};

		//For calculating moves
		const movesCounter = () => {
		  movesCount += 1;
		  moves.innerHTML = `<span>Moves:</span>${movesCount}`;
		};

		//Pick random objects from the items array
		const generateRandom = (size = 4) => {
		  //temporary array
		  let tempArray = [...items];
		  //initializes cardValues array
		  let cardValues = [];
		  //size should be double (4*4 matrix)/2 since pairs of objects would exist
		  size = (size * size) / 2;
		  //Random object selection
		  for (let i = 0; i < size; i++) {
			const randomIndex = Math.floor(Math.random() * tempArray.length);
			cardValues.push(tempArray[randomIndex]);
			//once selected remove the object from temp array
			tempArray.splice(randomIndex, 1);
		  }
		  return cardValues;
		};

		const matrixGenerator = (cardValues, size = 4) => {
		  gameContainer.innerHTML = "";
		  cardValues = [...cardValues, ...cardValues];
		  //simple shuffle
		  cardValues.sort(() => Math.random() - 0.5);
		  for (let i = 0; i < size * size; i++) {
			/*
				Create Cards
				before => front side (contains question mark)
				after => back side (contains actual image);
				data-card-values is a custom attribute which stores the names of the cards to match later
			  */
			gameContainer.innerHTML += `
			 <div class="card-container" data-card-value="${cardValues[i].name}">
				<div class="card-before">?</div>
				<div class="card-after">
				<img src="${cardValues[i].image}" class="image"/></div>
			 </div>
			 `;
		  }
		  //Grid
		  gameContainer.style.gridTemplateColumns = `repeat(${size},auto)`;

		  //Cards
		  cards = document.querySelectorAll(".card-container");
		  cards.forEach((card) => {
			card.addEventListener("click", () => {
			  //If selected card is not matched yet then only run (i.e already matched card when clicked would be ignored)
			  if (!card.classList.contains("matched")) {
				//flip the cliked card
				card.classList.add("flipped");
				//if it is the firstcard (!firstCard since firstCard is initially false)
				if (!firstCard) {
				  //so current card will become firstCard
				  firstCard = card;
				  //current cards value becomes firstCardValue
				  firstCardValue = card.getAttribute("data-card-value");
				} else {
				  //increment moves since user selected second card
				  movesCounter();
				  //secondCard and value
				  secondCard = card;
				  let secondCardValue = card.getAttribute("data-card-value");
				  if (firstCardValue == secondCardValue) {
					//if both cards match add matched class so these cards would beignored next time
					firstCard.classList.add("matched");
					secondCard.classList.add("matched");
					//set firstCard to false since next card would be first now
					firstCard = false;
					//winCount increment as user found a correct match
					winCount += 1;
					//check if winCount ==half of cardValues
					if (winCount == Math.floor(cardValues.length / 2)) {
					  result.innerHTML = `<h2>You Won</h2>
					<h4>Moves: ${movesCount}</h4>`;
					  stopGame();
					}
				  } else {
					//if the cards dont match
					//flip the cards back to normal
					let [tempFirst, tempSecond] = [firstCard, secondCard];
					firstCard = false;
					secondCard = false;
					let delay = setTimeout(() => {
					  tempFirst.classList.remove("flipped");
					  tempSecond.classList.remove("flipped");
					}, 900);
				  }
				}
			  }
			});
		  });
		};

		//Start game
		startButton.addEventListener("click", () => {
		  movesCount = 0;
		  seconds = 0;
		  minutes = 0;
		  //controls amd buttons visibility
		  controls.classList.add("hide");
		  stopButton.classList.remove("hide");
		  startButton.classList.add("hide");
		  //Start timer
		  interval = setInterval(timeGenerator, 1000);
		  //initial moves
		  moves.innerHTML = `<span>Moves:</span> ${movesCount}`;
		  initializer();
		});

		//Stop game
		stopButton.addEventListener(
		  "click",
		  (stopGame = () => {
			controls.classList.remove("hide");
			stopButton.classList.add("hide");
			startButton.classList.remove("hide");
			clearInterval(interval);
		  })
		);

		//Initialize values and func calls
		const initializer = () => {
		  result.innerText = "";
		  winCount = 0;
		  let cardValues = generateRandom();
		  console.log(cardValues);
		  matrixGenerator(cardValues);
		};
		</script>
	</body>
</html>
