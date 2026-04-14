<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodies - Sign In</title>
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
            align-items: center; 
        }

        .card { 
            background: white; 
            width: 100%; 
            max-width: 400px; 
            border-radius: 20px; 
            overflow: hidden; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }

        .header-images { 
            padding: 30px; 
            text-align: center; 
            background: #fff; 
        }

        .brand { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin-top: 10px; 
        }

        .brand span { 
            color: #FFCC00; 
            font-size: 24px; 
            font-weight: bold; 
            margin-left: 10px; 
        }

        .form-container { 
            padding: 20px 30px 40px; 
            text-align: center; 
        }

        .input-group { 
            text-align: left; 
            margin-bottom: 20px; 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            padding: 10px 15px; 
            background: #fff; 
        }

        .input-group label { 
            display: block; 
            font-size: 11px; 
            color: #aaa; 
            text-transform: uppercase; 
        }

        .input-group input { 
            border: none; 
            width: 100%; 
            outline: none; 
            font-size: 14px; 
            padding-top: 5px; 
        }

        .btn-yellow { 
            background: #FFCC00; 
            border: none; 
            width: 94%; 
            padding: 10px; 
            border-radius: 10px; 
            font-weight: bold; 
            cursor: pointer; 
            font-size: 16px; 
            color: black; 
        }

        .footer-link { 
            margin-top: 20px; 
            font-size: 13px; 
            color: #666; 
        }

        .footer-link a { 
            color: #FFCC00; 
            text-decoration: none; 
            font-weight: bold; 
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="header-images">
            <div style="font-size: 40px;">🥗 🍕 🍹 🍛</div>
            <div class="brand"><span>🍔</span><span>Foodies</span></div>
        </div>

        <!-- ✅ FORM START -->
        <form class="form-container" action="login_process.php" method="POST">
            
            <h2 style="margin-bottom: 25px;">Sign In</h2>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <!-- ✅ SUBMIT BUTTON -->
            <button type="submit" class="btn-yellow">Sign In</button>

            <div class="footer-link">
                Don't have an account? <a href="signup.php">Sign Up</a>
            </div>

        </form>
        <!-- ✅ FORM END -->

    </div>
</body>
</html>