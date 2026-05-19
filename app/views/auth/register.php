<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WebIn</title>
    <style>
        body { background-color: #f6f7fb; margin: 0; padding: 24px; font-family: sans-serif; }
    </style>
</head>
<body>

    <form action="/register" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm">Konfirmasi Password:</label>
        <input type="password" id="confirm" name="confirm" required><br><br>

        <label for="kelas">Kelas:</label>
        <select id="kelas" name="kelas" required>
            <option value="">Pilih Kelas</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>

        <label for="jurusan">Jurusan:</label>
        <select id="jurusan" name="jurusan" required>
            <option value="">Pilih Jurusan</option>
            <option value="TKJ 1">TKJ 1</option>
            <option value="TKJ 2">TKJ 2</option>
            <option value="TKJ 3">TKJ 3</option>
            <option value="AKL 1">AKL 1</option>
            <option value="AKL 2">AKL 2</option>
            <option value="BID 1">BID 1</option>
            <option value="BID 2">BID 2</option>
        </select><br><br>

        <button type="submit">Register</button>
    </form>

    <a href="/login">Sudah Punya Akun</a>
</body>
</html>