<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodies - Sign Up</title>
    <style>
        body { 
            margin: 0; 
            font-family: 'Segoe UI', sans-serif; 
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.7)), 
                        url('https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex; 
            justify-content: center; 
            padding: 40px 20px; 
        }

        .container { 
            width: 100%; 
            max-width: 400px; 
        }

        .back-nav { 
            display: flex; 
            align-items: center; 
            text-decoration: none; 
            color: white; 
            margin-bottom: 30px; 
            font-weight: bold; 
        }

        .input-box { 
            background: #fff; 
            border: 1px solid #e0e0e0; 
            border-radius: 12px; 
            padding: 10px 15px; 
            margin-bottom: 18px; 
            position: relative; 
        }

        .input-box:focus-within { 
            border-color: #FFCC00; 
            box-shadow: 0 4px 12px rgba(255,204,0,0.1); 
        }

        .input-box label { 
            display: block; 
            font-size: 11px; 
            color: #999; 
            margin-bottom: 4px; 
            text-transform: uppercase; 
        }

        .input-box input { 
            border: none; 
            width: 100%; 
            outline: none; 
            font-size: 15px; 
            color: #333; 
        }

        .btn-yellow { 
            background: #FFCC00; 
            border: none; 
            width: 91%; 
            padding: 16px; 
            border-radius: 12px; 
            font-weight: bold; 
            font-size: 16px; 
            cursor: pointer; 
            text-align: center; 
            color: black; 
        }

        .terms { 
            text-align: center; 
            font-size: 12px; 
            color: white; 
            margin: 20px 0; 
        }

        .login-footer { 
            text-align: center; 
            margin-top: 20px; 
            font-size: 14px; 
            color: white;
        }

        .login-footer a { 
            color: #FFCC00; 
            text-decoration: none; 
            font-weight: bold; 
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- ✅ BACK LINK FIX -->
        <a href="signin.php" class="back-nav">
            <span style="font-size: 20px; margin-right: 10px;">←</span> Sign Up
        </a>

        <h2 style="color:white">Enter Your Details Here</h2>

        <!-- ✅ FORM START -->
        <form action="register_process.php" method="POST">

            <div class="input-box">
                <label>Name</label>
                <input type="text" name="name" placeholder="John Doe" required>
            </div>

            <div class="input-box">
                <label>Email</label>
                <input type="email" name="email" placeholder="johndoe123@gmail.com" required>
            </div>

            <div class="input-box">
                <label>Phone</label>
                <input type="text" name="phone" placeholder="0123456789" required>
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create password" required>
            </div>

            <div class="input-box">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Re-enter password" required>
            </div>

            <p class="terms">
                By signing up you accept our <a href="#">terms</a> and <a href="#">privacy policy</a>
            </p>

            <!-- ✅ BUTTON FIX -->
            <button type="submit" class="btn-yellow">Sign Up</button>

        </form>
        <!-- ✅ FORM END -->

        <div class="login-footer">
            Already have an account? <a href="signin.php">Sign In</a>
        </div>

    </div>
</body>
</html>