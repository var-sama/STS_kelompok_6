function login() {
  const username = document.getElementById("username").value;
  const kelas = document.getElementById("kelas").value;
  const password = document.getElementById("password").value;

  if (!username || !kelas || !password) {
    alert("Semua field wajib diisi!");
    return;
  }

  alert(
    "Login berhasil!\n" +
    "Username: " + username +
    "\nKelas: " + kelas
  );
}
