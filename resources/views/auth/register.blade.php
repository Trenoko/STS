<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up - MasakKu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Croissant One', cursive;
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            min-height: 600px;
            background: white;
        }
        
        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: white;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo {
            width: 250px;
            height: 180px;
            margin-bottom: 1.5rem;
        }
        
        .brand-name {
            font-size: 2.5rem;
            font-weight: 400;
            color: #8B4513;
            font-family: 'Croissant One', cursive;
        }
        
        .right-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .form-container {
            width: 100%;
            max-width: 400px;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 2rem;
        }
        
        .form-title {
            font-size: 2rem;
            font-weight: 400;
            color: #8B4513;
            text-align: center;
            margin-bottom: 2rem;
            font-family: 'Croissant One', cursive;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
            font-size: 0.9rem;
        }
        
        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-icon {
            position: absolute;
            left: 12px;
            color: #999;
            z-index: 1;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            background: white;
            transition: border-color 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #8B4513;
        }
        
        .btn-signup {
            width: 100%;
            padding: 12px;
            background-color: #8B4513;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 400;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 1.5rem;
            font-family: 'Croissant One', cursive;
        }
        
        .btn-signup:hover {
            background-color: #6d3410;
        }
        
        .login-link {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }
        
        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 400;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                min-height: auto;
            }
            
            .left-section {
                padding: 1rem;
            }
            
            .logo {
                width: 180px;
                height: 130px;
            }
            
            .brand-name {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="left-section">
            <div class="logo-container">
                <!-- MasakKu Logo -->
                <div class="logo">
                    <img src="{{ asset('images/masakku-logo.png') }}" alt="MasakKu Logo" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <div class="brand-name">MasakKu</div>
            </div>
        </div>
        
        
        <div class="right-section">
            <div class="form-container">
                <h1 class="form-title">Sign up</h1>
                
                <form method="POST" action="#">
                    @csrf
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-container">
                            <img src="{{ asset('images/icon-user.svg') }}" class="input-icon" alt="User Icon">
                            <input type="text" id="username" name="username" class="form-input" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-container">
                            <img src="{{ asset('images/icon-email.svg') }}" class="input-icon" alt="Email Icon">
                            <input type="email" id="email" name="email" class="form-input" placeholder="Email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-container">
                            <img src="{{ asset('images/icon-password.svg') }}" class="input-icon" alt="Password Icon">
                            <input type="password" id="password" name="password" class="form-input" placeholder="Password" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <div class="input-container">
                            <img src="{{ asset('images/icon-password.svg') }}" class="input-icon" alt="Password Icon">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Confirm password" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-signup">Sign up</button>
                </form>
                
                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Click here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
