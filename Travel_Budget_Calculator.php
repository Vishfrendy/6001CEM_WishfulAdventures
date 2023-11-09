<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Your CSS styles here */
    </style>
    <title>Travel Budget Calculator</title>
</head>
<body>
    <div class="calculator">
        <h1>Travel Budget Calculator</h1>
        <label for="expenses">Total Expenses:</label>
        <input type="number" id="expenses" placeholder="Enter total expenses">
        <button id="calculateBtn">Calculate</button>
        <div id="result">
            <p id="budgetResult"></p>
            <p id="advice"></p>
        </div>
    </div>
    <script>
        document.getElementById("calculateBtn").addEventListener("click", calculateBudget);

        function calculateBudget() {
            const expensesInput = document.getElementById("expenses");
            const budgetResultElement = document.getElementById("budgetResult");
            const adviceElement = document.getElementById("advice");

            const totalExpenses = parseFloat(expensesInput.value);

            if (!isNaN(totalExpenses)) {
                const budgetPercentage = 0.2;
                const budgetAmount = totalExpenses * budgetPercentage;
                budgetResultElement.textContent = `Recommended travel budget: $${budgetAmount.toFixed(2)}`;

                if (budgetAmount < 500) {
                    adviceElement.textContent = "You might want to consider budget-friendly destinations.";
                } else if (budgetAmount >= 500 && budgetAmount < 1500) {
                    adviceElement.textContent = "You have a moderate budget to explore various destinations.";
                } else {
                    adviceElement.textContent = "You can consider luxury destinations for your travel.";
                }
            } else {
                budgetResultElement.textContent = "Please enter a valid number.";
                adviceElement.textContent = "";
            }
        }
    </script>
</body>
</html>
