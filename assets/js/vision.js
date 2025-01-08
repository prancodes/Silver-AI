const messages = [
  {
    content: "My name is not ChatGPT, I am Silver AI",
    role: "system",
  },
];

function addMessage(msg, isUser) {
  const messagesDiv = document.getElementById("messages");
  const messageDiv = document.createElement("div");
  messageDiv.classList.add("message");
  if (isUser) {
    messageDiv.classList.add("user-message");
  }
  messageDiv.innerHTML = msg; // Use innerHTML to support HTML content
  messagesDiv.appendChild(messageDiv);
  messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

function descImage() {
  let imageUrl = document.getElementById("image-url").value.trim();
  let inputMessage = document.getElementById("input-message").value.trim();

  if (imageUrl && inputMessage) {
    const imagePreview = `<img src="${imageUrl}" alt="Image Preview" style="max-width: 100%; height: auto;"><br>Description: ${inputMessage}`;
    addMessage(imagePreview, true);

    messages.push({
      content: inputMessage,
      role: "user",
    });

    (async () => {
      try {
        const response = await puter.ai.chat(inputMessage, imageUrl, { stream: true });
        let fullResponse = "";
        const messageDiv = document.createElement("div");
        messageDiv.classList.add("message");
        document.getElementById("messages").appendChild(messageDiv);
        
        for await (const part of response) {
          fullResponse += part?.text?.replaceAll("\n", "<br>");
          messageDiv.innerHTML = fullResponse;
          messageDiv.scrollTop = messageDiv.scrollHeight;
        }

        messages.push({
          content: fullResponse,
          role: "assistant",
        });
      } catch (error) {
        console.error("An error occurred:", error);
        addMessage(
          "An error occurred while processing your request. Please try again.",
          false
        );
      }
    })();
  }
}
