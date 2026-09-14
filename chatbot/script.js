function sendMessage() {

    const input = document.getElementById("userInput");
    const text = input.value.trim();

    // Jangan kirim kalau kosong
    if (text === "") {
        return;
    }

    // Tampilkan pesan user
    appendMessage(text, "user");

    // Kosongkan input
    input.value = "";


    // Kirim pesan ke PHP
    fetch("chat.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },

        body: "pesan=" + encodeURIComponent(text)

    })

    .then(response => response.text())

    .then(reply => {

        // Tampilkan jawaban dari PHP
        appendMessage(reply, "bot");

    })

    .catch(error => {

        console.error(error);

        appendMessage(
            "Maaf, terjadi kesalahan saat menghubungi server.",
            "bot"
        );

    });
}


// Fungsi menampilkan pesan
function appendMessage(text, sender) {

    const chatBox = document.getElementById("chatBox");

    const message = document.createElement("div");

    message.classList.add("message", sender);

    message.textContent = text;

    chatBox.appendChild(message);

    // Scroll otomatis
    chatBox.scrollTop = chatBox.scrollHeight;
}


// Tekan Enter untuk mengirim
document.getElementById("userInput").addEventListener(
    "keypress",
    function(event) {

        if (event.key === "Enter") {
            sendMessage();
        }

    }
);