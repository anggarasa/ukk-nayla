<?php require_once '../app/views/layouts/header.php'?>

<!-- Main Content -->
<div class="min-h-screen bg-gradient-to-br from-red-50 to-white py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all hover:shadow-xl">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-500 px-6 py-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="text-white">
                        <h3 class="text-xl md:text-2xl font-bold">Tambah Produk Baru</h3>
                        <p class="mt-1 text-red-100">Silakan masukan data produk baru.</p>
                    </div>

                    <div>
                        <a href="<?= BASE_URL ?>/produk" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feedback Messages -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 m-6 rounded-md animate-pulse">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <?= $_SESSION['success_message'] ?>
                    </div>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 m-6 rounded-md animate-pulse">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <?= $_SESSION['error_message'] ?>
                    </div>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <!-- Form -->
            <form action="<?= BASE_URL ?>/produk/store" method="post" class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nama Produk -->
                    <div class="space-y-2">
                        <label for="nama" class="text-sm font-medium text-gray-700 flex items-center">
                            Nama Produk <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <input
                                    type="text"
                                    name="nama"
                                    id="nama"
                                    value="<?= isset($oldInput['nama']) ? htmlspecialchars($oldInput['nama']) : '' ?>"
                                    required
                                    class="pl-10 block w-full px-3 py-3 bg-white border <?= isset($errors['nama']) ? 'border-red-500' : 'border-gray-300' ?> rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                    placeholder="Masukkan nama produk"
                            >
                        </div>
                        <?php if (isset($errors['nama'])): ?>
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <?= $errors['nama'] ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Harga Produk -->
                    <div class="space-y-2">
                        <label for="harga" class="text-sm font-medium text-gray-700 flex items-center">
                            Harga <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input
                                    type="number"
                                    name="harga"
                                    id="harga"
                                    value="<?= isset($oldInput['harga']) ? htmlspecialchars($oldInput['harga']) : '' ?>"
                                    required
                                    class="pl-10 block w-full px-3 py-3 bg-white border <?= isset($errors['harga']) ? 'border-red-500' : 'border-gray-300' ?> rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                    placeholder="Rp. "
                            >
                        </div>
                        <?php if (isset($errors['harga'])): ?>
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <?= $errors['harga'] ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Stok -->
                    <div class="space-y-2 md:col-span-2">
                        <label for="stok" class="text-sm font-medium text-gray-700 flex items-center">
                            Stok <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <input
                                    type="number"
                                    name="stok"
                                    id="stok"
                                    value="<?= isset($oldInput['stok']) ? htmlspecialchars($oldInput['stok']) : '' ?>"
                                    required
                                    class="pl-10 block w-full px-3 py-3 bg-white border <?= isset($errors['stok']) ? 'border-red-500' : 'border-gray-300' ?> rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                    placeholder="0"
                            >
                        </div>
                        <?php if (isset($errors['stok'])): ?>
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <?= $errors['stok'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-10 flex flex-col sm:flex-row sm:justify-end gap-3">
                    <button type="reset" class="w-full sm:w-auto px-6 py-3 bg-white text-red-600 font-medium rounded-lg border border-red-200 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Reset
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-medium rounded-lg hover:from-red-700 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all shadow-md">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Simpan Produk
                        </div>
                    </button>
                </div>
            </form>
        </div>

        <!-- Form Tips -->
        <div class="mt-6 bg-white p-4 rounded-lg shadow text-center">
            <p class="text-sm text-gray-500">
                <span class="text-red-500">*</span> Bidang wajib diisi
            </p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'?>
