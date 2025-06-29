<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "web_phishing");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($user['password'] === $password) {
            $_SESSION['username'] = $username;
            $success = true;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Akun tidak ditemukan!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-500 flex items-center justify-center min-h-screen">

<?php if ($success): ?>
  <div class="text-center text-white">
    <div class="text-2xl font-bold mb-4">Login berhasil 🗿</div>
    <div class="flex justify-center">
      <svg class="w-10 h-10 animate-spin text-white" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
          d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z">
        </path>
      </svg>
    </div>
    <p class="mt-3">Mengalihkan ke dashboard...</p>
  </div>

  <script>
    setTimeout(() => {
      window.location.href = "dashboard.php";
    }, 3000); 
  </script>

<?php else: ?>
  <!-- Login Form -->
  <form method="POST" onsubmit="showLoading()" class="bg-white shadow-lg rounded-lg p-8 w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-purple-700 mb-6">Login Bang 🗿</h2>

    <?php if ($error): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <input type="text" name="username" placeholder="Username"
      class="w-full px-4 py-2 border border-gray-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-purple-600" required>

    <input type="password" name="password" placeholder="Password"
      class="w-full px-4 py-2 border border-gray-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-purple-600" required>

    <button id="loginBtn" type="submit"
      class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 transition-colors flex items-center justify-center">
      <span id="btnText">Login</span>
      <svg id="spinner" class="ml-2 w-5 h-5 animate-spin text-white hidden" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
          d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z">
        </path>
      </svg>
    </button>
  </form>

  <script>
    function showLoading() {
      const btn = document.getElementById("loginBtn");
      const spinner = document.getElementById("spinner");
      const btnText = document.getElementById("btnText");

      btn.disabled = true;
      btn.classList.add("opacity-70", "cursor-not-allowed");
      spinner.classList.remove("hidden");
      btnText.textContent = "Loading...";
    }
  </script>

<?php endif; ?>

</body>
</html>
