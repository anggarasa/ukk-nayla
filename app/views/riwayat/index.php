<?php require_once '../app/views/layouts/header.php'?>

    <div class="container mx-auto px-4 py-8 max-w-6xl" x-data="{
        show: false,
        transaksi: null,
        detailItems: [],
        showModal(id) {
            this.show = true;
            this.fetchDetail(id);
        },
        fetchDetail(id) {
            fetch(`<?= BASE_URL ?>/riwayat/detail/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        this.transaksi = data.transaksi;
                        this.detailItems = Array.isArray(data.data) ? data.data : [data.data];
                    } else {
                        alert(data.message);
                        this.show = false;
                    }
                })
                .catch(error => {
                    console.error('Error fetching detail:', error);
                    alert('Gagal mengambil data transaksi.');
                    this.show = false;
                });
        }
    }">
        <!-- Modern header with red gradient background -->
        <div class="rounded-xl bg-gradient-to-r from-red-500 to-red-600 p-6 shadow-lg mb-8 transform hover:scale-[1.01] transition-transform duration-300">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-white p-3 rounded-full shadow-md mr-4">
                        <i class="fas fa-history text-red-600 text-2xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Riwayat Transaksi</h1>
                </div>
                <form action="<?= BASE_URL ?>/riwayat/search" method="post" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <input type="text" name="keyword" placeholder="Cari transaksi..."
                               value="<?= isset($data['keyword']) ? $data['keyword'] : '' ?>"
                               class="pl-10 pr-4 py-3 rounded-lg border-0 focus:outline-none focus:ring-2 focus:ring-red-300 w-full sm:w-64 shadow-md text-gray-700">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-red-400"></i>
                    </div>
                    <button type="submit" class="bg-white text-red-600 font-semibold px-4 py-3 rounded-lg hover:bg-red-50 transition duration-300 shadow-md flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                    <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                        <a href="<?= BASE_URL ?>/riwayat" class="bg-red-800 px-4 py-3 text-center text-white rounded-lg hover:bg-red-900 transition duration-300 shadow-md flex items-center justify-center">
                            <i class="fas fa-undo mr-2"></i> Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <!-- Table for desktop view -->
        <div class="hidden md:block bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Pembayaran</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Kembalian</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <?php if (empty($data['transaksis'])): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-receipt text-red-400 text-5xl mb-3"></i>
                                    <p class="text-lg">Belum ada data transaksi</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['transaksis'] as $index => $transaksi): ?>
                            <tr class="hover:bg-red-50 transition duration-200 <?= $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-xs bg-red-100 text-red-800 px-2.5 py-1 rounded-full mr-2">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            <?= date('d/m/Y', strtotime($transaksi['tgl_transaksi'])) ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-red-100 p-2 rounded-full mr-2">
                                            <i class="fas fa-user text-red-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-800"><?= $transaksi['nama_pelanggan'] ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-800 font-semibold">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-800">Rp <?= number_format($transaksi['uang_diberikan'], 0, ',', '.') ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-800">Rp <?= number_format($transaksi['kembalian'], 0, ',', '.') ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button @click="showModal(<?= $transaksi['transaksi_id'] ?>)" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg transition-colors duration-300 inline-flex items-center">
                                        <i class="fas fa-eye mr-1.5"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card view for mobile -->
        <div class="md:hidden space-y-4">
            <?php if (empty($data['transaksis'])): ?>
                <div class="bg-white rounded-xl p-8 text-center shadow-md">
                    <i class="fas fa-receipt text-red-400 text-5xl mb-3"></i>
                    <p class="text-lg text-gray-500">Belum ada data transaksi</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['transaksis'] as $transaksi): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="bg-red-600 px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="bg-white p-1.5 rounded-full mr-2">
                                    <i class="fas fa-calendar-day text-red-600 text-xs"></i>
                                </div>
                                <span class="text-white text-sm font-medium"><?= date('d M Y', strtotime($transaksi['tgl_transaksi'])) ?></span>
                            </div>
                            <span class="bg-red-700 text-white text-xs px-2 py-1 rounded-full">ID: <?= $transaksi['transaksi_id'] ?></span>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center mb-3">
                                <div class="bg-red-100 p-2 rounded-full mr-2">
                                    <i class="fas fa-user text-red-600"></i>
                                </div>
                                <span class="font-medium text-gray-800"><?= $transaksi['nama_pelanggan'] ?></span>
                            </div>

                            <div class="grid grid-cols-2 gap-3 mb-4 text-sm">
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-gray-500 text-xs mb-1">Total Harga</p>
                                    <p class="font-bold text-gray-800">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-gray-500 text-xs mb-1">Pembayaran</p>
                                    <p class="font-bold text-gray-800">Rp <?= number_format($transaksi['uang_diberikan'], 0, ',', '.') ?></p>
                                </div>
                                <div class="col-span-2 bg-gray-50 p-3 rounded-lg">
                                    <p class="text-gray-500 text-xs mb-1">Kembalian</p>
                                    <p class="font-bold text-gray-800">Rp <?= number_format($transaksi['kembalian'], 0, ',', '.') ?></p>
                                </div>
                            </div>

                            <button @click="showModal(<?= $transaksi['transaksi_id'] ?>)" class="w-full bg-red-600 hover:bg-red-700 text-white py-2.5 rounded-lg transition-colors duration-300 flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i> Lihat Detail Transaksi
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination Controls -->
        <div class="mt-8 flex justify-center items-center">
            <div class="bg-white rounded-xl shadow-lg p-4 flex items-center space-x-2">
                <?php if($data['total_pages'] > 1): ?>
                    <!-- Previous Page Button -->
                    <?php if($data['current_page'] > 1): ?>
                        <?php $prevPage = $data['current_page'] - 1; ?>
                        <?php $url = isset($data['keyword']) && !empty($data['keyword'])
                            ? BASE_URL . "/riwayat/search"
                            : BASE_URL . "/riwayat/index/{$prevPage}"; ?>

                        <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                            <form action="<?= $url ?>" method="post" class="inline">
                                <input type="hidden" name="keyword" value="<?= $data['keyword'] ?>">
                                <input type="hidden" name="page" value="<?= $prevPage ?>">
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                    <i class="fas fa-chevron-left mr-1"></i> Prev
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?= $url ?>" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-chevron-left mr-1"></i> Prev
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left mr-1"></i> Prev
                        </button>
                    <?php endif; ?>

                    <!-- Page Number Buttons -->
                    <div class="flex space-x-1">
                        <?php
                        // Calculate range of visible page numbers
                        $startPage = max(1, $data['current_page'] - 2);
                        $endPage = min($data['total_pages'], $data['current_page'] + 2);

                        // Always show first page button
                        if($startPage > 1):
                            $url = isset($data['keyword']) && !empty($data['keyword']) ? BASE_URL . "/riwayat/search" : BASE_URL . "/riwayat/index/1";
                            ?>
                            <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                            <form action="<?= $url ?>" method="post" class="inline">
                                <input type="hidden" name="keyword" value="<?= $data['keyword'] ?>">
                                <input type="hidden" name="page" value="1">
                                <button type="submit" class="px-4 py-2 rounded-lg hover:bg-red-100 transition-colors <?= $data['current_page'] == 1 ? 'bg-red-500 text-white' : 'bg-white text-red-500' ?>">
                                    1
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?= $url ?>" class="px-4 py-2 rounded-lg hover:bg-red-100 transition-colors <?= $data['current_page'] == 1 ? 'bg-red-500 text-white' : 'bg-white text-red-500' ?>">
                                1
                            </a>
                        <?php endif; ?>

                            <?php if($startPage > 2): ?>
                            <span class="px-4 py-2">...</span>
                        <?php endif; ?>
                        <?php endif; ?>

                        <!-- Page buttons in the middle -->
                        <?php for($i = $startPage; $i <= $endPage; $i++): ?>
                            <?php if($i == 1 || $i == $data['total_pages']) continue; // Skip if it's first or last page as we're handling them separately ?>
                            <?php $url = isset($data['keyword']) && !empty($data['keyword']) ? BASE_URL . "/riwayat/search" : BASE_URL . "/riwayat/index/{$i}"; ?>

                            <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                                <form action="<?= $url ?>" method="post" class="inline">
                                    <input type="hidden" name="keyword" value="<?= $data['keyword'] ?>">
                                    <input type="hidden" name="page" value="<?= $i ?>">
                                    <button type="submit" class="px-4 py-2 rounded-lg hover:bg-red-100 transition-colors <?= $data['current_page'] == $i ? 'bg-red-500 text-white' : 'bg-white text-red-500' ?>">
                                        <?= $i ?>
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?= $url ?>" class="px-4 py-2 rounded-lg hover:bg-red-100 transition-colors <?= $data['current_page'] == $i ? 'bg-red-500 text-white' : 'bg-white text-red-500' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- Always show last page button -->
                        <?php if($endPage < $data['total_pages']): ?>
                            <?php if($endPage < $data['total_pages'] - 1): ?>
                                <span class="px-4 py-2">...</span>
                            <?php endif; ?>

                            <?php $url = isset($data['keyword']) && !empty($data['keyword'])
                                ? BASE_URL . "/riwayat/search"
                                : BASE_URL . "/riwayat/index/{$data['total_pages']}"; ?>

                            <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                                <form action="<?= $url ?>" method="post" class="inline">
                                    <input type="hidden" name="keyword" value="<?= $data['keyword'] ?>">
                                    <input type="hidden" name="page" value="<?= $data['total_pages'] ?>">
                                    <button type="submit" class="px-4 py-2 rounded-lg hover:bg-red-100 transition-colors <?= $data['current_page'] == $data['total_pages'] ? 'bg-red-500 text-white' : 'bg-white text-red-500' ?>">
                                        <?= $data['total_pages'] ?>
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?= $url ?>" class="px-4 py-2 rounded-lg hover:bg-red-100 transition-colors <?= $data['current_page'] == $data['total_pages'] ? 'bg-red-500 text-white' : 'bg-white text-red-500' ?>">
                                    <?= $data['total_pages'] ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Next Page Button -->
                    <?php if($data['current_page'] < $data['total_pages']): ?>
                        <?php $nextPage = $data['current_page'] + 1; ?>
                        <?php $url = isset($data['keyword']) && !empty($data['keyword'])
                            ? BASE_URL . "/riwayat/search"
                            : BASE_URL . "/riwayat/index/{$nextPage}"; ?>

                        <?php if(isset($data['keyword']) && !empty($data['keyword'])): ?>
                            <form action="<?= $url ?>" method="post" class="inline">
                                <input type="hidden" name="keyword" value="<?= $data['keyword'] ?>">
                                <input type="hidden" name="page" value="<?= $nextPage ?>">
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                    Next <i class="fas fa-chevron-right ml-1"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="<?= $url ?>" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                Next <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                            Next <i class="fas fa-chevron-right ml-1"></i>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pagination Info -->
        <div class="text-center mt-4 text-gray-600">
            <?php if($data['total_data'] > 0): ?>
                Menampilkan halaman <?= $data['current_page'] ?> dari <?= $data['total_pages'] ?>
                (Total: <?= $data['total_data'] ?> transaksi)
            <?php else: ?>
                Tidak ada data transaksi yang ditemukan
            <?php endif; ?>
        </div>

        <!-- Detailed Transaction Modal -->
        <div x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="show"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity" @click="show = false">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div x-show="show"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <div class="flex justify-between items-center pb-3 border-b border-gray-200 mb-4">
                                    <h3 class="text-2xl leading-6 font-bold text-gray-900 flex items-center">
                                        <i class="fas fa-file-invoice text-red-600 mr-2"></i>
                                        Detail Transaksi
                                    </h3>
                                    <button @click="show = false" class="bg-white rounded-full p-1 hover:bg-red-50 focus:outline-none">
                                        <i class="fas fa-times text-red-600 text-xl"></i>
                                    </button>
                                </div>

                                <div x-show="transaksi" class="mb-6">
                                    <div class="bg-red-50 rounded-lg p-4 mb-4 border border-red-100">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">ID Transaksi</p>
                                                <p class="font-medium" x-text="transaksi?.transaksi_id"></p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">Tanggal</p>
                                                <p class="font-medium" x-text="transaksi?.tgl_transaksi"></p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">Pelanggan</p>
                                                <p class="font-medium" x-text="transaksi?.nama_pelanggan"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="font-bold text-lg mb-3 text-gray-800">Daftar Item</h4>

                                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                                        <table class="w-full">
                                            <thead>
                                            <tr class="bg-gray-50 text-gray-600">
                                                <th class="py-3 px-4 text-left text-xs font-medium uppercase">Produk</th>
                                                <th class="py-3 px-4 text-left text-xs font-medium uppercase">Harga</th>
                                                <th class="py-3 px-4 text-left text-xs font-medium uppercase">Jumlah</th>
                                                <th class="py-3 px-4 text-right text-xs font-medium uppercase">Subtotal</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                            <template x-for="(item, index) in detailItems" :key="index">
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-3 px-4 text-sm" x-text="item.nama_produk"></td>
                                                    <td class="py-3 px-4 text-sm">Rp <span x-text="new Intl.NumberFormat('id-ID').format(item.harga_produk)"></span></td>
                                                    <td class="py-3 px-4 text-sm" x-text="item.jumlah"></td>
                                                    <td class="py-3 px-4 text-sm text-right">Rp <span x-text="new Intl.NumberFormat('id-ID').format(item.subtotal)"></span></td>
                                                </tr>
                                            </template>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="flex justify-end mt-4">
                                        <div class="bg-gray-50 rounded-lg p-4 w-full md:w-64">
                                            <div class="flex justify-between py-2">
                                                <span class="text-gray-600">Total</span>
                                                <span class="font-medium">Rp <span x-text="new Intl.NumberFormat('id-ID').format(transaksi?.total_harga)"></span></span>
                                            </div>
                                            <div class="flex justify-between py-2 border-t border-gray-200">
                                                <span class="text-gray-600">Pembayaran</span>
                                                <span class="font-medium">Rp <span x-text="new Intl.NumberFormat('id-ID').format(transaksi?.uang_diberikan)"></span></span>
                                            </div>
                                            <div class="flex justify-between py-2 border-t border-gray-200">
                                                <span class="text-gray-600">Kembalian</span>
                                                <span class="font-medium">Rp <span x-text="new Intl.NumberFormat('id-ID').format(transaksi?.kembalian)"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once '../app/views/layouts/footer.php'?>
