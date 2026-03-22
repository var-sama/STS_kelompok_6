<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/Login.css">
</head>
<body>  

<div class="container">

    <!-- Kiri (Logo) -->
    <div class="left">
        <img src="/icons/Register Login.png" class="logo">
    </div>

    <!-- Kanan (Form) -->
    <div class="right">
        <div class="login-box">
            <h1>Masuk Sebagai Bagian <span>Web-In</span></h1>

            <form action="/login" method="POST">
                <label>Username</label>
                <input type="text" name="username" required>

                <label>Password</label>
                <input type="password" name="password" required>
                

                <div class="dots">
                    <img src="/icons/Screenshot_2026-03-22_121911-removebg-preview.png" class="social-img">
                </div>

                <button type="submit">Login</button>
                <button type="button">Daftar</button>
            </form>

            <a href="#" class="forgot">Lupa password?</a>
        </div>
    </div>

</div>

<script src="script.js"></script>
</body>
</html>