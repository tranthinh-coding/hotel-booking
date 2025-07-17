<?php
$title = 'Đặt phòng thành công - Ocean Pearl Hotel';
ob_start();
?>

<!-- Modern CSS Styles -->
<style>
    .success-card {
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gradient-bg {
        background: linear-gradient(135deg,
                rgba(16, 185, 129, 0.05) 0%,
                rgba(34, 197, 94, 0.05) 50%,
                rgba(56, 189, 248, 0.05) 100%);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        border: none;
        box-shadow: 0 4px 14px rgba(14, 165, 233, 0.2);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
        background: linear-gradient(135deg, #0284c7 0%, #0891b2 100%);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.2);
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }

    .success-animation {
        animation: successPulse 2s ease-in-out infinite;
    }

    @keyframes successPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background: #10b981;
        animation: confetti 3s ease-in-out infinite;
    }

    @keyframes confetti {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }

        100% {
            transform: translateY(100px) rotate(720deg);
            opacity: 0;
        }
    }
</style>

<!-- Header -->
<div class="gradient-bg py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Icon -->
        <div class="text-center">
            <div class="relative inline-block mb-8">
                <!-- Confetti Animation -->
                <div class="absolute -top-4 -left-4 confetti" style="animation-delay: 0s;"></div>
                <div class="absolute -top-2 -right-2 confetti" style="animation-delay: 0.5s; background: #06b6d4;">
                </div>
                <div class="absolute -bottom-2 -left-2 confetti" style="animation-delay: 1s; background: #f59e0b;">
                </div>
                <div class="absolute -bottom-4 -right-4 confetti" style="animation-delay: 1.5s; background: #ef4444;">
                </div>

                <div
                    class="success-animation w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto shadow-xl">
                    <i class="fas fa-check text-3xl text-white"></i>
                </div>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                Đặt phòng thành công!
            </h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Cảm ơn bạn đã tin tưởng Ocean Pearl Hotel. Chúng tôi đã nhận được yêu cầu đặt phòng của bạn.
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (isset($hoaDon) && $hoaDon): ?>
            <!-- Booking Details -->
            <div class="success-card rounded-3xl overflow-hidden mb-8">
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-50 to-blue-50 px-8 py-6">
                    <h2 class="text-2xl font-bold text-slate-800 flex items-center">
                        <i class="fas fa-receipt text-green-500 mr-3"></i>
                        Chi tiết đặt phòng
                    </h2>
                    <p class="text-slate-600 mt-2">Thông tin chi tiết về phòng bạn đã đặt</p>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Booking Info -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                    Thông tin đặt phòng
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-slate-600">Mã đặt phòng:</span>
                                        <span class="font-bold text-blue-600">#<?= $hoaDon->ma_hoa_don ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-600">Ngày đặt:</span>
                                        <span
                                            class="font-semibold"><?= date('d/m/Y H:i', strtotime($hoaDon->ngay_tao)) ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-600">Trạng thái:</span>
                                        <span
                                            class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                            <?= htmlspecialchars($hoaDon->trang_thai) ?>
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center text-lg">
                                        <span class="text-slate-800 font-semibold">Tổng tiền:</span>
                                        <span
                                            class="font-bold text-green-600"><?= number_format($hoaDon->tong_tien) ?>₫</span>
                                    </div>
                                </div>
                            </div>

                            <?php if (isset($hoaDonPhong) && $hoaDonPhong): ?>
                                <!-- Room Details -->
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                        <i class="fas fa-bed text-blue-500 mr-2"></i>
                                        Thông tin phòng
                                    </h3>
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-slate-600">Tên phòng:</span>
                                            <span
                                                class="font-semibold"><?= htmlspecialchars($phong->ten_phong ?? 'N/A') ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600">Loại phòng:</span>
                                            <span
                                                class="font-semibold"><?= htmlspecialchars($loaiPhong->ten_loai_phong ?? 'N/A') ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600">Số khách:</span>
                                            <span class="font-semibold"><?= $hoaDonPhong->so_luong_khach ?> người</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600">Giá phòng:</span>
                                            <span
                                                class="font-semibold"><?= number_format($hoaDonPhong->gia_phong) ?>₫/giờ</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Time Details -->
                        <div class="space-y-6">
                            <?php if (isset($hoaDonPhong) && $hoaDonPhong): ?>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                        <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                        Thời gian
                                    </h3>
                                    <div class="space-y-4">
                                        <div class="bg-blue-50 p-4 rounded-xl">
                                            <div class="flex items-center mb-2">
                                                <i class="fas fa-calendar-plus text-blue-500 mr-2"></i>
                                                <span class="font-semibold text-blue-800">Nhận phòng</span>
                                            </div>
                                            <div class="text-lg font-bold text-blue-900">
                                                <?= date('d/m/Y', strtotime($hoaDonPhong->ngay_nhan_phong)) ?>
                                            </div>
                                            <div class="text-blue-700">
                                                <?= date('H:i', strtotime($hoaDonPhong->ngay_nhan_phong)) ?>
                                            </div>
                                        </div>

                                        <div class="bg-green-50 p-4 rounded-xl">
                                            <div class="flex items-center mb-2">
                                                <i class="fas fa-calendar-minus text-green-500 mr-2"></i>
                                                <span class="font-semibold text-green-800">Trả phòng</span>
                                            </div>
                                            <div class="text-lg font-bold text-green-900">
                                                <?= date('d/m/Y', strtotime($hoaDonPhong->ngay_tra_phong)) ?>
                                            </div>
                                            <div class="text-green-700">
                                                <?= date('H:i', strtotime($hoaDonPhong->ngay_tra_phong)) ?>
                                            </div>
                                        </div>

                                        <?php
                                        $checkin = new DateTime($hoaDonPhong->ngay_nhan_phong);
                                        $checkout = new DateTime($hoaDonPhong->ngay_tra_phong);
                                        $interval = $checkin->diff($checkout);
                                        $hours = ($interval->days * 24) + $interval->h + ($interval->i > 0 ? 1 : 0);
                                        ?>
                                        <div class="bg-slate-50 p-4 rounded-xl text-center">
                                            <div class="text-2xl font-bold text-slate-800"><?= $hours ?> giờ</div>
                                            <div class="text-slate-600">Thời gian lưu trú</div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Notes -->
                            <?php if (isNotEmpty($hoaDon->ghi_chu)): ?>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                        <i class="fas fa-comment-alt text-blue-500 mr-2"></i>
                                        Ghi chú
                                    </h3>
                                    <div class="bg-slate-50 p-4 rounded-xl">
                                        <p class="text-slate-700"><?= nl2br(htmlspecialchars($hoaDon->ghi_chu)) ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Important Information -->
        <div class="success-card rounded-3xl p-8 mb-8">
            <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                Thông tin quan trọng
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-6 rounded-xl">
                    <h4 class="font-semibold text-blue-800 mb-3 flex items-center">
                        <i class="fas fa-clock text-blue-600 mr-2"></i>
                        Chính sách checkin/checkout
                    </h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Checkin từ: 14:00</li>
                        <li>• Checkout trước: 12:00</li>
                        <li>• Late checkout: Phụ phí 50%</li>
                        <li>• Early checkin: Tùy vào tình trạng phòng</li>
                    </ul>
                </div>

                <div class="bg-green-50 p-6 rounded-xl">
                    <h4 class="font-semibold text-green-800 mb-3 flex items-center">
                        <i class="fas fa-shield-check text-green-600 mr-2"></i>
                        Chính sách hủy phòng
                    </h4>
                    <ul class="text-sm text-green-700 space-y-1">
                        <li>• Miễn phí hủy phòng trước 24h</li>
                        <li>• Hủy trong 24h: Phí 50%</li>
                        <li>• No-show: Tính 100% giá phòng</li>
                        <li>• Liên hệ để thay đổi đặt phòng</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/"
                class="btn-primary px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all transform hover:scale-105 text-center">
                <i class="fas fa-home mr-2"></i>
                Về trang chủ
            </a>

            <a href="/tai-khoan/lich-su-dat-phong"
                class="btn-secondary px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all transform hover:scale-105 text-center">
                <i class="fas fa-history mr-2"></i>
                Lịch sử đặt phòng
            </a>
        </div>

        <!-- Contact Section -->
        <div class="success-card rounded-3xl p-8 mt-8">
            <h3 class="text-xl font-bold text-slate-800 mb-6 text-center">
                <i class="fas fa-headset text-blue-500 mr-3"></i>
                Cần hỗ trợ thêm?
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-phone text-blue-600 text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Hotline</h4>
                    <p class="text-slate-600">+84 123 456 789</p>
                </div>

                <div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-envelope text-green-600 text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Email</h4>
                    <p class="text-slate-600">booking@oceanpearl.com</p>
                </div>

                <div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-comments text-yellow-600 text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Live Chat</h4>
                    <p class="text-slate-600">Hỗ trợ 24/7</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>