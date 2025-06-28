<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicine OCR Scanner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@4.0.2/dist/tesseract.min.js"></script>

    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Segoe UI', sans-serif;
        }
        .scanner-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        video {
            border-radius: 12px;
            width: 100%;
            height: auto;
        }
        #output {
            font-size: 1.1rem;
            color: #333;
        }
        .btn-primary {
            margin-top: 1rem;
        }
        .loading {
            font-size: 0.9rem;
            color: #888;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="scanner-container">
    <h3 class="mb-3">📷 Scan Medicine Name</h3>

    <video id="video" autoplay playsinline></video>
    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>

    <div class="d-grid gap-2">
        <button class="btn btn-primary" onclick="capture()">📸 Capture and Recognize</button>
    </div>

    <form id="ocr-form" action="{{ url('/medicine/search') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="name" id="medicine-name">
        <p><strong>Detected Name:</strong> <span id="output">-</span></p>
        <div id="loading" class="loading"></div>
        <button type="submit" class="btn btn-success mt-2" style="display:none;" id="submitBtn">🔍 Search Medicine</button>
    </form>
</div>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const output = document.getElementById('output');
    const submitBtn = document.getElementById('submitBtn');
    const loading = document.getElementById('loading');

    // Open the BACK camera on mobile
    navigator.mediaDevices.getUserMedia({
        video: {
            facingMode: { exact: "environment" } // back camera
        }
    }).then(stream => {
        video.srcObject = stream;
    }).catch(err => {
        alert("Camera access error: " + err);
    });

function capture() {
    output.textContent = "-";
    loading.textContent = "Enhancing image & recognizing...";

    // Draw the image from video to canvas
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Get image data from canvas
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = imageData.data;

    // Basic preprocessing: grayscale + threshold (binarize)
    for (let i = 0; i < data.length; i += 4) {
        const avg = (data[i] + data[i+1] + data[i+2]) / 3;
        const threshold = avg > 140 ? 255 : 0;  // simple contrast
        data[i] = data[i+1] = data[i+2] = threshold; // RGB
    }
    ctx.putImageData(imageData, 0, 0); // write back to canvas

    const enhancedImage = canvas.toDataURL('image/png');

    Tesseract.recognize(enhancedImage, 'eng', {
        logger: m => console.log(m)
    }).then(({ data: { text } }) => {
        const cleaned = text.trim().split('\n')[0]; // first line
        document.getElementById('medicine-name').value = cleaned;
        output.textContent = cleaned || "No text found";
        loading.textContent = "";
        submitBtn.style.display = cleaned ? 'inline-block' : 'none';
    }).catch(() => {
        loading.textContent = "Failed to recognize text.";
    });
}

</script>

</body>
</html>
