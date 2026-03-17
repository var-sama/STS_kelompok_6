<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WebIn</title>
    <link rel="stylesheet" href="/css/Login.css">
</head>
<body>  



<div class="container">

    <!-- Kiri (Logo) -->
    <div class="left">
        <div class="logo-box">
            <h1>W-in</h1>
        </div>
    </div>

    <!-- Kanan (Form) -->
    <div class="right">
        <div class="login-box">
            <h2>Daftar Menjadi <span>Web-In</span></h2>

            <form action="/login" method="POST">
                <label>Username</label>
                <input type="text" name="username" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <div class="dots">
                    <img src="/public/icons/google.png">
                    <img src="/public/icons/x.png">
                    <img src="/public/icons/facebook.png">
                    <img src="/public/icons/google.png">
                    <img src="/public/icons/x.png">
                </div>

                <button type="submit">Login</button>
            </form>

            <p class="forgot">Lupa password?</p>
        </div>
    </div>

</div>

</body>
</html>

  <script src="script.js"></script>
</body>
</html>