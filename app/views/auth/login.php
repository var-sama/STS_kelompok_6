<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WebIn</title>
    <style>
        body { background-color: #f6f7fb; margin: 0; padding: 24px; font-family: sans-serif; }
    </style>
</head>
<body>
    <h1>Ini adalah halaman login</h1>

    <form action="/login" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <a href="/register">Belum punya akun</a>
</body>
</html>