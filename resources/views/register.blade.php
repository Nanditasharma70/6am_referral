<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input {
            border-radius: 4px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert-success {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center">Register</h1>
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="referral_code">Referral Code (Optional)</label>
                    <input type="text" name="referral_code" id="referral_code" class="form-control" value="{{ old('referral_code') }}">
                    @error('referral_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212; /* Dark background for the whole page */
            color: #e0e0e0; /* Light text color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #1f1f1f; /* Darker background for the container */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 360px;
            text-align: center;
            border: 1px solid #333; /* Subtle border to make the container stand out */
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #ffffff; /* White color for the header */
            font-size: 24px; /* Slightly larger font size */
        }
        .register-container input {
            padding: 12px;
            width: calc(100% - 24px); /* Full-width with padding adjustment */
            margin-bottom: 15px;
            border: 1px solid #444; /* Slightly lighter border */
            border-radius: 6px;
            background-color: #2c2c2c; /* Dark background for inputs */
            color: #e0e0e0; /* Light text color for inputs */
            font-size: 16px;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }
        .register-container input:focus {
            border-color: #007bff; /* Blue border on focus */
            background-color: #333; /* Slightly lighter background on focus */
            outline: none; /* Remove default focus outline */
        }
        .register-container input::placeholder {
            color: #aaa; /* Lighter placeholder text */
        }
        .register-container button {
            padding: 12px;
            background-color: #007bff; /* Blue background for button */
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .register-container button:hover {
            background-color: #0056b3; /* Darker blue for hover effect */
            transform: scale(1.02); /* Slight scale effect on hover */
        }
        .register-container p {
            color: #ff4d4d; /* Error message color */
            margin: 5px 0;
            font-size: 14px;
        }
        .status-message {
            color: #28a745; /* Success message color */
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        @if (session('status'))
            <p class="status-message">{{ session('status') }}</p>
        @endif
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
            @error('username')
                <p>{{ $message }}</p>
            @enderror
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <p>{{ $message }}</p>
            @enderror
            <input type="text" name="referral_code" placeholder="Referral Code (optional)" value="{{ old('referral_code') }}">
            @error('referral_code')
                <p>{{ $message }}</p>
            @enderror
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>




