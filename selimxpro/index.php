<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sikkim Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: rgb(67, 109, 244);
            --primary-dark: #d50000;
            --text: #e0e0e0;
            --bg: #000000;
            --input-bg: rgba(255, 255, 255, 0.05);
            --border: rgba(255, 255, 255, 0.1);
            --error: #ff2a6d;
            --success: #05ffa1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', monospace;
        }

        body {
            background: var(--bg);
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                            url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABtJREFUeNpiZGBgaGAgAjAxEAlGFVJHIUCAAQDcngCUgqGMqwAAAABJRU5ErkJggg==');
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.5rem;
            color: var(--text);
        }

        .login-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 2.5rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border);
            box-shadow: 0 0 20px rgba(255, 23, 68, 0.2);
            width: min(100%, 400px);
            backdrop-filter: blur(10px);
        }

        .brand-wrapper {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-wrapper h2 {
            color: var(--primary);
            font-size: 2rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(255, 23, 68, 0.5);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 1px;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.25rem;
            font-size: 1rem;
            color: var(--text);
            background: var(--input-bg);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(255, 23, 68, 0.2);
        }

        .form-control::placeholder {
            color: rgba(224, 224, 224, 0.5);
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--primary);
            border-radius: 0.25rem;
            background: transparent;
            color: var(--primary);
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 2px;
        }

        .btn-login:hover {
            background: var(--primary);
            color: var(--bg);
        }

        .error-message {
            background: rgba(255, 42, 109, 0.1);
            border: 1px solid var(--error);
            color: var(--error);
            padding: 0.75rem;
            border-radius: 0.25rem;
            margin-top: 1rem;
            font-size: 0.875rem;
            text-align: center;
        }

        .error-message.success {
            background: rgba(5, 255, 161, 0.1);
            border-color: var(--success);
            color: var(--success);
        }

        .whatsapp-container {
            margin-top: 2rem;
            text-align: center;
        }

        .whatsapp-link {
            font-size: 2rem;
            color: #25D366;
            transition: all 0.3s ease;
        }

        .whatsapp-link:hover {
            color: #128C7E;
            transform: scale(1.1);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="brand-wrapper">
            <h2>Sikkim Admin</h2>
        </div>
        
        <form action="maulyikarisalu.php" method="post">
            <div class="form-group">
                <label for="username"><i class="fas fa-user-secret"></i> Username</label>
                <input type="text" class="form-control" id="username" name="username" required 
                       placeholder="Enter username">
            </div>
            
            <div class="form-group">
                <label for="password"><i class="fas fa-key"></i> Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                       placeholder="Enter password">
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            
            <?php 
		if(isset($_GET['err']) == "ture") {
	  ?>	
		<div class="error-message"><i class="fas fa-shield-virus"></i> Access Denied: Invalid Credentials</div>
	  <?
		}
		else if(isset($_GET['msg']) == "ture"){
	  ?>
			<div class="error-message"><i class="fas fa-shield-virus"></i> Unauthorized access</div>
			
	  <?php
		}
		else if(isset($_GET['logout']) == "ture"){
	  ?>
			<div class="error-message"><i class="fas fa-shield-virus"></i> Logged out </div>
			
	  <?php 
	    }
	  ?>
            
         </form>

       
    </div>
</body>
</html>