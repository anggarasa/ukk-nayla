<?php require_once '../app/views/layouts/header.php'?>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gradient-to-r from-red-50 to-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-600 to-red-800 px-6 py-5 border-b border-red-300">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="text-white mb-4 md:mb-0">
                    <h3 class="text-xl md:text-2xl font-bold">Edit Produk</h3>
                    <p class="mt-1 text-red-100 font-light"><?= $data['produk']['nama_produk'] ?></p>
                </div>

                <div>
                    <a href="<?= BASE_URL ?>/produk" class="flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-red-700 hover:bg-red-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <?php
        $oldInput = isset($_SESSION['old_input']) ? $_SESSION['old_input'] : [];
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
        unset($_SESSION['old_input'], $_SESSION['errors']);
        ?>

        <form action="<?= BASE_URL ?>/produk/update/<?= $data['produk']['id'] ?>" method="post" class="px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Nama Produk -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-red-100 transition-all duration-300 hover:shadow-md">
                    <label for="nama" class="block text-base font-medium text-gray-800 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="nama" id="nama"
                               value="<?= isset($oldInput['nama']) ? htmlspecialchars($oldInput['nama']) : htmlspecialchars($data['produk']['nama_produk']) ?>"
                               required
                               class="block w-full px-4 py-3 bg-gray-50 border <?= isset($errors['nama']) ? 'border-red-500' : 'border-red-200' ?> rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-700"
                               placeholder="Masukkan nama produk">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <?php if (isset($errors['nama'])): ?>
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <?= $errors['nama'] ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Harga Produk -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-red-100 transition-all duration-300 hover:shadow-md">
                    <label for="harga" class="block text-base font-medium text-gray-800 mb-2">Harga <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-500">Rp</span>
                        </div>
                        <input type="number" name="harga" id="harga"
                               value="<?= isset($oldInput['harga']) ? htmlspecialchars($oldInput['harga']) : htmlspecialchars($data['produk']['harga_produk']) ?>"
                               required
                               class="block w-full pl-12 pr-4 py-3 bg-gray-50 border <?= isset($errors['harga']) ? 'border-red-500' : 'border-red-200' ?> rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-700"
                               placeholder="0">
                    </div>
                    <?php if (isset($errors['harga'])): ?>
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <?= $errors['harga'] ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Stok -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-red-100 transition-all duration-300 hover:shadow-md md:col-span-2">
                    <label for="stok" class="block text-base font-medium text-gray-800 mb-2">Stok <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" name="stok" id="stok"
                               value="<?= isset($oldInput['stok']) ? htmlspecialchars($oldInput['stok']) : htmlspecialchars($data['produk']['stok']) ?>"
                               required
                               class="block w-full px-4 py-3 bg-gray-50 border <?= isset($errors['stok']) ? 'border-red-500' : 'border-red-200' ?> rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-700"
                               placeholder="0">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                    </div>
                    <?php if (isset($errors['stok'])): ?>
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <?= $errors['stok'] ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-10 flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'?>
