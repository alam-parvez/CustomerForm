<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        #preview {
            display: none;
            width: 150px;
            margin-top: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h3 class="text-center mb-4">Customer Registration</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <form action="{{url('/customers/store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer ID</label>
            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>

        <div class="mb-3 text-center">
            <video id="webcam" autoplay style="width: 100%; max-width: 300px; border: 2px solid #ddd; border-radius: 5px;"></video>
            <br>
            <button type="button" class="btn btn-primary mt-2" onclick="captureImage()">Capture Image</button>
            <br>
            <img id="preview">
            <input type="hidden" name="image" id="capturedImage">
        </div>

        <button type="submit" class="btn btn-success w-100">Submit</button>
    </form>
</div>

<script>
    function startWebcam() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                document.getElementById('webcam').srcObject = stream;
            })
            .catch(error => console.error('Webcam error:', error));
    }

    function captureImage() {
        const video = document.getElementById('webcam');
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');

        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        const imageData = canvas.toDataURL('image/png'); 
        document.getElementById('capturedImage').value = imageData;

        const preview = document.getElementById('preview');
        preview.src = imageData;
        preview.style.display = 'block';
    }

    window.onload = startWebcam;
</script>

</body>
</html>

