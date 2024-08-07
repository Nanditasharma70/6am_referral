<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0; /* Light background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .welcome-container {
            text-align: center;
        }
        .welcome-container h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }
        .welcome-container button {
            padding: 12px 24px;
            background-color: #007bff; /* Blue background for button */
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .welcome-container button:hover {
            background-color: #0056b3; /* Darker blue for hover effect */
            transform: scale(1.02); /* Slight scale effect on hover */
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome to Our Site</h1>
        <button onclick="window.location.href='{{ route('register.form') }}'">Go to Register Page</button>
    </div>
</body>
</html>
