<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MedBot – AI Medical Assistant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f7fc;
      margin: 0;
      padding: 0;
    }

    header {
      background: linear-gradient(135deg, #0073e6, #003366);
      color: white;
      padding: 60px 20px;
      text-align: center;
    }

    header h1 {
      font-size: 2rem;
    }

    .chat-wrapper {
      max-width: 700px;
      margin: 40px auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      padding: 30px;
    }

    .chat-box {
      height: 400px;
      overflow-y: auto;
      margin-bottom: 1rem;
    }

    .chat-message {
      padding: 10px 15px;
      border-radius: 12px;
      margin-bottom: 10px;
      max-width: 80%;
      word-wrap: break-word;
    }

    .user-message {
      background-color: #d0ebff;
      color: #084298;
      align-self: flex-end;
      margin-left: auto;
    }

    .bot-message {
      background-color: #e3fcec;
      color: #0f5132;
      align-self: flex-start;
      margin-right: auto;
    }

    .chat-input {
      display: flex;
      gap: 10px;
    }

    .chat-input input {
      flex-grow: 1;
    }

    .copy-icon {
      float: right;
      cursor: pointer;
      font-size: 14px;
      color: #198754;
      margin-left: 8px;
    }

    .copy-icon:hover {
      color: #145c32;
    }

    .typing-indicator {
      font-style: italic;
      color: #888;
      margin-top: 5px;
      align-self: flex-start;
    }
     footer {
      background: #222;
      color: white;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <header>
    <h1>💊 MedBot – Your AI Medical Assistant</h1>
    <p class="lead">Ask anything about medicines, symptoms, or health tips.</p>
  </header>

  <div class="chat-wrapper d-flex flex-column">
    <div id="chat-box" class="chat-box d-flex flex-column"></div>

    <form id="chat-form" class="chat-input">
      <input type="text" id="user-input" class="form-control" placeholder="Ask a medical question..." required>
      <button type="submit" class="btn btn-success">Send</button>
    </form>
  </div>
  <footer>
    <p>&copy; 2025 Smart Pharmacy. All rights reserved.</p>
  </footer>
<script>
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cacheKey = "medChatCache";

    function scrollChatToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function loadChatFromCache() {
        const cached = localStorage.getItem(cacheKey);
        if (cached) {
            chatBox.innerHTML = cached;
            attachCopyListeners(); // reattach copy icons
            scrollChatToBottom();
        }
    }

    function saveChatToCache() {
        localStorage.setItem(cacheKey, chatBox.innerHTML);
    }

    function attachCopyListeners() {
        document.querySelectorAll('.copy-icon').forEach(icon => {
            icon.onclick = () => {
                const message = icon.previousElementSibling?.textContent?.replace(/^MedBot:\s*/, '') || '';
                navigator.clipboard.writeText(message.trim());
                icon.innerHTML = '✅';
                setTimeout(() => icon.innerHTML = '📋', 1000);
            };
        });
    }

    function addMessage(role, message) {
        const msgDiv = document.createElement('div');
        msgDiv.classList.add('chat-message', role === 'user' ? 'user-message' : 'bot-message');

        if (role === 'bot') {
            msgDiv.innerHTML = `
                <span><strong>MedBot:</strong> ${message}</span>
                <span class="copy-icon" title="Copy">📋</span>
            `;
        } else {
            msgDiv.innerHTML = `<strong>You:</strong> ${message}`;
        }

        chatBox.appendChild(msgDiv);
        saveChatToCache();
        attachCopyListeners();
        scrollChatToBottom();
    }

    chatForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const message = userInput.value.trim();
        if (!message) return;

        addMessage('user', message);
        userInput.value = '';

        const typingDiv = document.createElement('div');
        typingDiv.classList.add('typing-indicator');
        typingDiv.setAttribute('id', 'typing');
        typingDiv.textContent = 'MedBot is typing...';
        chatBox.appendChild(typingDiv);
        scrollChatToBottom();

        fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('typing')?.remove();
            if (data.reply) {
                addMessage('bot', data.reply);
            } else {
                addMessage('bot', '[Error] Could not process your request.');
            }
        })
        .catch(err => {
            document.getElementById('typing')?.remove();
            console.error(err);
            addMessage('bot', '[Network error]');
        });
    });

    loadChatFromCache();
</script>

</body>
</html>
