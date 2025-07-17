<?php
$title = 'Lịch sử đặt phòng - Ocean Pearl Hotel';
ob_start();
?>

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-teal-600 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-white">Lịch sử đặt phòng</h1>
            <p class="text-blue-100 mt-2">Quản lý và theo dõi các đặt phòng của bạn</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Navigation -->
        <div class="bg-white rounded-lg shadow-xs p-1 mb-8">
            <div class="flex flex-wrap gap-2">
                <a href="/tai-khoan" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-tachometer-alt mr-2"></i>Tổng quan
                </a>
                <a href="/tai-khoan/lich-su-dat-phong"
                    class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md font-medium">
                    <i class="fas fa-calendar-alt mr-2"></i>Lịch sử đặt phòng
                </a>
                <a href="/tai-khoan/lich-su-danh-gia" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-star mr-2"></i>Đánh giá của tôi
                </a>
                <a href="/profile" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <i class="fas fa-edit mr-2"></i>Chỉnh sửa hồ sơ
                </a>
            </div>
        </div>

        <!-- Booking List -->
        <?php if (isEmpty($bookings)): ?>
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-xs border border-gray-100 p-8 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Chưa có đặt phòng nào</h3>
                <p class="text-gray-500 mb-6">Bạn chưa thực hiện đặt phòng nào. Hãy khám phá các phòng của chúng tôi!</p>
                <a href="/dat-phong"
                    class="inline-flex items-center bg-gradient-to-r from-blue-600 to-teal-600 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-teal-700 transition-all">
                    <i class="fas fa-plus mr-2"></i>
                    Đặt phòng ngay
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php foreach ($bookings as $booking):
                    // Convert array to object for easier access
                    if (is_array($booking)) {
                        $booking = (object) $booking;
                    }

                    // Ensure safe values
                    $tenPhong = $booking->ten_phong ?? 'Phòng không xác định';
                    $loaiPhong = $booking->loai_phong ?? 'Loại phòng không xác định';
                    $maHoaDon = $booking->ma_hoa_don ?? 0;
                    $trangThai = $booking->trang_thai ?? 'khong_xac_dinh';
                    $tongTien = $booking->tong_tien ?? 0;
                    $checkIn = $booking->check_in ?? null;
                    $checkOut = $booking->check_out ?? null;
                    $giaPhong = $booking->gia_phong ?? 0;
                    $ngayTao = $booking->thoi_gian_dat ?? null;
                    $ghiChu = $booking->ghi_chu ?? '';
                    $maPhong = $booking->ma_phong ?? 0;
                    ?>
                    <div class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden">
                        <!-- Booking Header -->
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-bed text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            <?= htmlspecialchars($tenPhong) ?>
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            <?= htmlspecialchars($loaiPhong) ?> • Mã đặt: #<?= $maHoaDon ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 lg:mt-0 flex items-center space-x-4">
                                    <?php
                                    $statusColors = [
                                        'cho_xac_nhan' => 'bg-yellow-100 text-yellow-800',
                                        'da_xac_nhan' => 'bg-blue-100 text-blue-800',
                                        'da_thanh_toan' => 'bg-green-100 text-green-800',
                                        'da_huy' => 'bg-red-100 text-red-800'
                                    ];
                                    $statusLabels = [
                                        'cho_xac_nhan' => 'Chờ xác nhận',
                                        'da_xac_nhan' => 'Đã xác nhận',
                                        'da_thanh_toan' => 'Đã thanh toán',
                                        'da_huy' => 'Đã hủy'
                                    ];
                                    $colorClass = $statusColors[$trangThai] ?? 'bg-gray-100 text-gray-800';
                                    $statusLabel = $statusLabels[$trangThai] ?? 'Không xác định';
                                    ?>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $colorClass ?>">
                                        <?= $statusLabel ?>
                                    </span>
                                    <span class="text-lg font-bold text-gray-900">
                                        <?= number_format($tongTien) ?>đ
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Check-in/Check-out -->
                                <div class="space-y-4">
                                    <?php if ($checkIn): ?>
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-calendar-check text-green-500 mr-3"></i>
                                            <div>
                                                <p class="text-gray-500">Nhận phòng</p>
                                                <p class="font-medium"><?= date('d/m/Y H:i', strtotime($checkIn)) ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($checkOut): ?>
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-calendar-times text-red-500 mr-3"></i>
                                            <div>
                                                <p class="text-gray-500">Trả phòng</p>
                                                <p class="font-medium"><?= date('d/m/Y H:i', strtotime($checkOut)) ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Duration & Price -->
                                <div class="space-y-4">
                                    <?php if ($checkIn && $checkOut):
                                        $checkInDate = new DateTime($checkIn);
                                        $checkOutDate = new DateTime($checkOut);
                                        $timeDiff = $checkOutDate->getTimestamp() - $checkInDate->getTimestamp();
                                        $hours = max(1, ceil($timeDiff / 3600)); // Convert seconds to hours
                                        ?>
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-clock text-purple-500 mr-3"></i>
                                            <div>
                                                <p class="text-gray-500">Số giờ ở</p>
                                                <p class="font-medium"><?= $hours ?> giờ</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-money-bill-wave text-blue-500 mr-3"></i>
                                        <div>
                                            <p class="text-gray-500">Giá phòng</p>
                                            <p class="font-medium"><?= number_format($giaPhong) ?>đ</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="space-y-3">
                                    <?php if ($ngayTao): ?>
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-clock text-gray-500 mr-3"></i>
                                            <div>
                                                <p class="text-gray-500">Ngày đặt</p>
                                                <p class="font-medium"><?= date('d/m/Y H:i', strtotime($ngayTao)) ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-col space-y-2 pt-2">
                                        <?php if ($trangThai === 'cho_xac_nhan'): ?>
                                            <form action="/huy-dat-phong/<?= $maHoaDon ?>" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn hủy đặt phòng này?')">
                                                <button type="submit"
                                                    class="w-full bg-red-500 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-red-600 transition-colors">
                                                    <i class="fas fa-times mr-1"></i>
                                                    Hủy đặt phòng
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if ($trangThai === 'da_thanh_toan' && $checkOut && new DateTime($checkOut) < new DateTime()): ?>
                                            <button
                                                onclick="showReviewModal(<?= $maHoaDon ?>, <?= $maPhong ?>, '<?= htmlspecialchars($tenPhong) ?>')"
                                                class="w-full bg-yellow-500 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-yellow-600 transition-colors">
                                                <i class="fas fa-star mr-1"></i>
                                                Đánh giá
                                            </button>
                                        <?php endif; ?>

                                        <button onclick="showBookingDetails(<?= $maHoaDon ?>)"
                                            class="w-full bg-gray-500 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-gray-600 transition-colors">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Chi tiết
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <?php if (!empty($ghiChu)): ?>
                                <div class="mt-6 pt-6 border-t border-gray-100">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Ghi chú:</h4>
                                    <p class="text-sm text-gray-600"><?= htmlspecialchars($ghiChu) ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xs max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Đánh giá phòng</h3>
                    <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="reviewForm" action="/tai-khoan/danh-gia" method="POST">
                    <input type="hidden" id="review_ma_hoa_don" name="ma_hoa_don">
                    <input type="hidden" id="review_ma_phong" name="ma_phong">

                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Phòng: <span id="room_name" class="font-medium"></span></p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Điểm đánh giá</label>
                        <div class="flex space-x-2">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <button type="button" class="star-btn text-2xl text-gray-300 hover:text-yellow-400"
                                    data-rating="<?= $i ?>">
                                    <i class="fas fa-star"></i>
                                </button>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" id="diem_so" name="diem_so" required>
                    </div>

                    <div class="mb-6">
                        <label for="noi_dung" class="block text-sm font-medium text-gray-700 mb-2">Nội dung đánh
                            giá</label>
                        <textarea id="noi_dung" name="noi_dung" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Chia sẻ trải nghiệm của bạn..."></textarea>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" onclick="closeReviewModal()"
                            class="flex-1 bg-gray-200 text-gray-700 py-2 px-4 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                            Hủy
                        </button>
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            Gửi đánh giá
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showReviewModal(maHoaDon, maPhong, tenPhong) {
        document.getElementById('review_ma_hoa_don').value = maHoaDon;
        document.getElementById('review_ma_phong').value = maPhong;
        document.getElementById('room_name').textContent = tenPhong;
        document.getElementById('reviewModal').classList.remove('hidden');
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        document.getElementById('reviewForm').reset();
        // Reset stars
        document.querySelectorAll('.star-btn').forEach(star => {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        });
    }

    // Star rating
    document.querySelectorAll('.star-btn').forEach((star, index) => {
        star.addEventListener('click', function () {
            const rating = this.dataset.rating;
            document.getElementById('diem_so').value = rating;

            // Update visual stars
            document.querySelectorAll('.star-btn').forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });

    function showBookingDetails(maHoaDon) {
        // Implement booking details modal if needed
        alert('Chi tiết đặt phòng #' + maHoaDon);
    }
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/app.php';
?>