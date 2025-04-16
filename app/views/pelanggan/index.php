<?php require_once '../app/views/layouts/header.php'?>

<div class="bg-gradient-to-b from-red-50 to-white rounded-xl shadow-lg p-6 mb-8"
     x-data="{
        show: false,
        pelanggan: null,
        showModal(id) {
            this.show = true;
            this.fetchDetail(id);
        },
        fetchDetail(id) {
            fetch(`<?= BASE_URL ?>/pelanggan/detail/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        this.pelanggan = data.data;
                    } else {
                        alert(data.message);
                        this.show = false;
                    }
                })
                .catch(error => {
                    console.error('Error fetching detail:', error);
                    alert('Gagal mengambil data pelanggan.');
                    this.show = false;
                });
        }
     }">
    <!-- Header Section with decorative element -->
    <div class="relative mb-8">
        <div class="absolute top-0 left-0 w-16 h-1 bg-red-500 rounded-full"></div>
        <h1 class="text-3xl font-bold text-red-800 pt-4">Data Pelanggan</h1>
        <p class="text-red-600 mt-2">Kelola informasi pelanggan Anda dengan mudah</p>
    </div>

    <!-- Search and Add Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <form action="<?= BASE_URL ?>/pelanggan" method="GET" class="flex-1 flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <input type="text" name="keyword" placeholder="Cari pelanggan..."
                       value="<?= isset($data['keyword']) ? htmlspecialchars($data['keyword']) : '' ?>"
                       class="w-full pl-12 pr-4 py-3 border border-red-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all shadow-sm">
                <i class="fas fa-search absolute left-4 top-3.5 text-red-400"></i>
            </div>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-3 px-6 rounded-lg flex items-center justify-center transition-all shadow-md hover:shadow-lg">
                <i class="fas fa-search mr-2"></i> Cari
            </button>
        </form>
        <a href="<?= BASE_URL ?>/pelanggan/tambah" class="bg-red-500 hover:bg-red-600 text-white py-3 px-6 rounded-lg flex items-center justify-center transition-all shadow-md hover:shadow-lg whitespace-nowrap">
            <i class="fas fa-plus mr-2"></i> Tambah Pelanggan
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-red-100">
                <thead>
                <tr class="bg-gradient-to-r from-red-600 to-red-500">
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider hidden md:table-cell">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Telepon</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider hidden lg:table-cell">Alamat</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-red-50">
                <?php foreach ($data['pelanggans'] as $index => $pelanggan): ?>
                    <tr class="hover:bg-red-50 transition-all <?= $index % 2 === 0 ? 'bg-white' : 'bg-red-50' ?>">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-full flex items-center justify-center">
                                    <span class="text-red-600 font-semibold"><?= substr($pelanggan['nama'], 0, 1) ?></span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"><?= $pelanggan['nama'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            <div class="text-sm text-gray-600"><?= $pelanggan['email'] ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600"><i class="fas fa-phone-alt text-red-400 mr-2"></i><?= $pelanggan['no_hp'] ?></div>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <div class="text-sm text-gray-600 max-w-xs truncate"><?= htmlspecialchars(substr($pelanggan['alamat'], 0, 20)) . (strlen($pelanggan['alamat']) > 20 ? '...' : '') ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <button
                                        class="text-white bg-red-500 hover:bg-red-600 rounded-full p-2 transition-all"
                                        @click="showModal($el.dataset.id)"
                                        data-id="<?= $pelanggan['id'] ?>"
                                        title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="<?= BASE_URL ?>/pelanggan/edit/<?= $pelanggan['id'] ?>"
                                   class="text-white bg-yellow-500 hover:bg-yellow-600 rounded-full p-2 transition-all"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= BASE_URL ?>/pelanggan/delete/<?= $pelanggan['id'] ?>" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pelanggan ini?');">
                                    <button type="submit"
                                            class="text-white bg-gray-500 hover:bg-gray-600 rounded-full p-2 transition-all"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <?php if (empty($data['pelanggans'])): ?>
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-users text-red-400 text-4xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-900">Tidak ada data pelanggan</h3>
                <p class="text-gray-500 mt-2">Silakan tambahkan pelanggan baru untuk mulai</p>
                <a href="<?= BASE_URL ?>/pelanggan/tambah" class="mt-4 inline-block bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded-lg transition-all">
                    <i class="fas fa-plus mr-2"></i> Tambah Pelanggan Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <nav class="mt-6">
        <ul class="flex justify-center space-x-2">
            <?php if ($data['currentPage'] > 1): ?>
                <li>
                    <a href="<?= BASE_URL ?>/pelanggan?page=<?= $data['currentPage'] - 1 ?>&keyword=<?= $data['keyword'] ?? '' ?>" class="px-4 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">
                        Previous
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                <li>
                    <a href="<?= BASE_URL ?>/pelanggan?page=<?= $i ?>&keyword=<?= $data['keyword'] ?? '' ?>" class="px-4 py-2 <?= $i == $data['currentPage'] ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-600' ?> rounded hover:bg-red-300">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
            <?php if ($data['currentPage'] < $data['totalPages']): ?>
                <li>
                    <a href="<?= BASE_URL ?>/pelanggan?page=<?= $data['currentPage'] + 1 ?>&keyword=<?= $data['keyword'] ?? '' ?>" class="px-4 py-2 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">
                        Next
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Detail Modal -->
    <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-auto" style="display: none;">
        <div @click.away="show = false" class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-auto">
            <div class="p-6 border-b border-red-100 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-red-700">Detail Pelanggan</h3>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6" x-show="pelanggan">
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-3">
                        <span class="text-red-600 text-2xl font-bold" x-text="pelanggan?.nama.charAt(0)"></span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800" x-text="pelanggan?.nama"></h3>
                </div>

                <div class="space-y-4">
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-10 text-red-500"><i class="fas fa-envelope"></i></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium" x-text="pelanggan?.email"></p>
                        </div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-10 text-red-500"><i class="fas fa-phone"></i></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Telepon</p>
                            <p class="font-medium" x-text="pelanggan?.no_hp"></p>
                        </div>
                    </div>
                    <div class="flex border-b border-gray-100 pb-3">
                        <div class="w-10 text-red-500"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="font-medium" x-text="pelanggan?.alamat"></p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button @click="show = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all">
                        Tutup
                    </button>
                    <a :href="`<?= BASE_URL ?>/pelanggan/edit/${pelanggan?.id}`" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all">
                        Edit Pelanggan
                    </a>
                </div>
            </div>
            <!-- Loading state -->
            <div class="p-6 text-center" x-show="show && !pelanggan">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-red-500 border-t-transparent"></div>
                <p class="mt-2 text-gray-600">Memuat data pelanggan...</p>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'?>
