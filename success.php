<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Top Up Berhasil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-xl p-10 max-w-md w-full text-center">
    <svg class="mx-auto mb-4 w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Top Up Berhasil!</h1>

    <div class="mt-6 text-left text-sm bg-gray-50 p-4 rounded-md">
      <p><strong>ID Pemain:</strong> <span id="playerId" class="text-gray-800"></span></p>
      <p><strong>Jumlah Diamond:</strong> <span id="diamond" class="text-gray-800"></span></p>
      <p><strong>Metode Pembayaran:</strong> <span id="payment" class="text-gray-800"></span></p>
    </div>

    <a href="index.php" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Kembali</a>
  </div>

  <script>
    document.getElementById('playerId').innerText = localStorage.getItem('playerId') || '-';
    document.getElementById('diamond').innerText = localStorage.getItem('diamond') || '-';
    document.getElementById('payment').innerText = localStorage.getItem('payment') || '-';

    localStorage.removeItem('playerId');
    localStorage.removeItem('diamond');
    localStorage.removeItem('payment');
  </script>
</body>
</html>
