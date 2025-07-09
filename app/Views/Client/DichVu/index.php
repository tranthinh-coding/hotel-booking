<?php
$title = 'Danh sách dịch vụ - Hotel Ocean';
ob_start();
?>

<!-- Services Section -->
<div class="py-12 bg-gradient-to-br from-seafoam-50 via-cyan-50 to-blue-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-concierge-bell text-ocean-600 mr-2"></i>
                    Danh sách dịch vụ
                </h1>
                <p class="text-gray-600">Khám phá các dịch vụ cao cấp tại khách sạn của chúng tôi</p>
            </div>
            <div>
                <a href="/contact" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all transform hover:scale-105 inline-flex items-center shadow-lg">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Liên hệ tư vấn
                </a>
            </div>
        </div>

<?php if (empty($dichVus)): ?>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-12 text-center shadow-lg border border-ocean-200">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-concierge-bell text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Hiện tại chưa có dịch vụ nào</h3>
        <p class="text-gray-600 mb-6">Vui lòng quay lại sau hoặc liên hệ với chúng tôi để biết thêm thông tin</p>
        <a href="/contact" class="bg-ocean-600 text-white px-6 py-3 rounded-lg hover:bg-ocean-700 transition-colors inline-flex items-center">
            <i class="fas fa-phone mr-2"></i>
            Liên hệ tư vấn
        </a>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($dichVus as $dichVu): ?>
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-ocean-200 transform hover:-translate-y-1">
                <!-- Service Icon -->
                <div class="h-32 bg-gradient-to-br from-seafoam-400 to-ocean-400 flex items-center justify-center">
                    <i class="fas fa-concierge-bell text-4xl text-white opacity-80"></i>
                </div>
                
                <!-- Service Info -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3"><?= htmlspecialchars($dichVu->ten_dich_vu) ?></h3>
                    
                    <div class="flex items-center justify-center mb-4">
                        <div class="text-center">
                            <div class="flex items-center justify-center text-ocean-600">
                                <i class="fas fa-money-bill-wave mr-2"></i>
                                <span class="text-2xl font-bold"><?= number_format($dichVu->gia) ?></span>
                            </div>
                            <span class="text-sm text-gray-500">VNĐ</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <div class="flex space-x-2">
                            <a href="/dich-vu/show/<?= $dichVu->ma_dich_vu ?>" 
                               class="flex-1 bg-ocean-100 text-ocean-700 px-3 py-2 rounded-lg hover:bg-ocean-200 transition-colors text-center text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                Xem chi tiết
                            </a>
                            <a href="/contact" 
                               class="flex-1 bg-green-100 text-green-700 px-3 py-2 rounded-lg hover:bg-green-200 transition-colors text-center text-sm">
                                <i class="fas fa-phone mr-1"></i>
                                Liên hệ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/app.php';
?>
