<?php require_once '../app/views/layouts/header.php'?>

<!-- Main Content -->
<div class="flex-1 overflow-x-hidden bg-gray-50">
    <!-- Top Navigation -->
    <header class="bg-gradient-to-r from-red-600 to-red-800 shadow-lg">
        <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center">
                    <h2 class="text-2xl font-bold text-white">Daftar Produk</h2>
                </div>
                <form action="<?= BASE_URL ?>/produk" method="GET" class="flex w-full md:w-auto">
                    <div class="relative flex-grow">
                        <input type="text" name="keyword" value="<?= isset($data['keyword']) ? $data['keyword'] : '' ?>"
                               placeholder="Cari produk..."
                               class="w-full px-4 py-3 rounded-l-lg border-0 focus:outline-none focus:ring-2 focus:ring-red-400 shadow-sm">
                        <button type="submit" class="absolute right-0 top-0 h-full px-4 bg-red-500 hover:bg-red-600 text-white rounded-r-lg transition duration-200 ease-in-out">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Produk Card -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border-t-4 border-red-500">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-full mr-5">
                            <i class="fas fa-box text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Produk</h3>
                            <p class="text-3xl font-bold text-gray-800 mt-1"><?= $data['total_produk'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Terjual Card -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border-t-4 border-red-500">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-full mr-5">
                            <i class="fas fa-shopping-cart text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Produk Terjual</h3>
                            <p class="text-3xl font-bold text-gray-800 mt-1"><?= $data['total_terjual'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan Card -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border-t-4 border-red-500">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-full mr-5">
                            <i class="fas fa-money-bill-wave text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Pendapatan</h3>
                            <p class="text-3xl font-bold text-gray-800 mt-1">Rp <?= number_format($data['total_pendapatan'],0,',','.') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Management Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-800">Kelola Produk</h2>
                <a href="<?= BASE_URL ?>/produk/tambah"
                   class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    <i class="fas fa-plus mr-2"></i> Tambah Produk
                </a>
            </div>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i>
                        <p><?= $_SESSION['success_message'] ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tambahkan tabel produk atau daftar produk di sini -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white divide-y divide-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-red-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Produk</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Stok</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <?php foreach ($data['produks'] as $produk): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $produk['nama_produk'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp <?= number_format($produk['harga_produk'],0,',','.') ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= $produk['stok'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= $produk['terjual'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?= BASE_URL ?>/produk/edit/<?= $produk['id'] ?>" class="text-pink hover:text-pink-dark mr-2"><i class="fas fa-edit"></i></a>
                                <a href="<?= BASE_URL ?>/produk/delete/<?= $produk['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <?php if ($data['current_page'] > 1): ?>
                        <a href="<?= BASE_URL ?>/produk?page=<?= $data['current_page'] - 1 ?><?= isset($data['keyword']) && !empty($data['keyword']) ? '&keyword=' . $data['keyword'] : '' ?>" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                        <a href="<?= BASE_URL ?>/produk?page=<?= $i ?><?= isset($data['keyword']) && !empty($data['keyword']) ? '&keyword=' . $data['keyword'] : '' ?>"
                           class="px-3 py-1 <?= $i === $data['current_page'] ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?> rounded-md">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($data['current_page'] < $data['total_pages']): ?>
                        <a href="<?= BASE_URL ?>/produk?page=<?= $data['current_page'] + 1 ?><?= isset($data['keyword']) && !empty($data['keyword']) ? '&keyword=' . $data['keyword'] : '' ?>" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </main>
</div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('[onclick]')) {
                const message = e.target.getAttribute('onclick').match(/return confirm\('([^']+)'\)/)[1];
                if (!confirm(message)) {
                    e.preventDefault();
                }
            }
        });
    </script>

<?php require_once '../app/views/layouts/footer.php'?>
