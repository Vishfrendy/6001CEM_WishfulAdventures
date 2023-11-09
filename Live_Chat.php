<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        .chat-container {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .chat-header {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        
        .chat-messages {
            padding: 10px;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .chat-input {
            display: flex;
            padding: 10px;
        }
        
        #message-input {
            flex-grow: 1;
            padding: 5px;
        }
        
        #send-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
    <title>Live Chat</title>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">Live Chat</div>
        <div class="chat-messages" id="chat-messages">
            <div class="message">
                <strong>Agent:</strong> Hello! How may I help you?
            </div>
        </div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type your message...">
            <button id="send-button">Send</button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const messageInput = document.getElementById("message-input");
            const sendButton = document.getElementById("send-button");
            const chatMessages = document.getElementById("chat-messages");

            sendButton.addEventListener("click", function () {
                const messageText = messageInput.value.trim();
                if (messageText !== "") {
                    appendMessage("You", messageText);
                    messageInput.value = "";
                    // Simulate receiving a response after a brief delay
                    setTimeout(function () {
                        const response = getTravelResponse(messageText);
                        appendMessage("Agent", response);
                    }, 1000);
                }
            });

            function appendMessage(sender, message) {
                const messageElement = document.createElement("div");
                messageElement.classList.add("message");
                messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
                chatMessages.appendChild(messageElement);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function getTravelResponse(message) {
                message = message.toLowerCase();
                if (message.includes("flight")) {
                    return "We offer a variety of flight options to different destinations. When and where would you like to fly?";
                } else if (message.includes("hotel")) {
                    return "We have a selection of hotels ranging from budget to luxury. Where are you planning to stay?";
                } else if (message.includes("vacation")) {
                    return "Planning a vacation is exciting! Which destination are you interested in?";
                } 
				else {
                    return "I'm here to help with your travel plans. Feel free to ask any questions you have!";
                }
            }
        });
    </script>
</body>
</html>
