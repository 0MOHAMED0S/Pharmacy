<!DOCTYPE html>
<html>
<head>
    <title>Medicine OCR Scanner</title>
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@4.0.2/dist/tesseract.min.js"></script>
</head>
<body>
    <h2>Scan Medicine Name from Paper</h2>

    <video id="video" width="320" height="240" autoplay></video><br>
    <button onclick="capture()">📸 Capture</button>
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>

    <form id="ocr-form" action="{{ url('/medicine/search') }}" method="POST">
        @csrf
        <input type="hidden" name="name" id="medicine-name">
        <p><strong>Recognized Name:</strong> <span id="output"></span></p>
        <button type="submit" style="display:none;" id="submitBtn">🔍 Search Medicine</button>
    </form>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        const output = document.getElementById('output');
        const submitBtn = document.getElementById('submitBtn');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => video.srcObject = stream)
            .catch(err => alert("Camera access denied: " + err));

        function capture() {
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');

            Tesseract.recognize(
                imageData,
                'eng',
                { logger: m => console.log(m) }
            ).then(({ data: { text } }) => {
                const cleaned = text.trim().split('\n')[0]; // First line
                document.getElementById('medicine-name').value = cleaned;
                output.textContent = cleaned;
                submitBtn.style.display = 'inline-block';
            });
        }
    </script>
</body>
</html>
