<?php
$title = 'Lịch sử đặt phòng - Ocean Pearl Hotel';
ob_start();
?>

<style>
/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Modal animations */
#bookingDetailsModal {
    transition: opacity 0.3s ease-in-out;
}

#bookingDetailsModal.hidden {
    opacity: 0;
    pointer-events: none;
}

#bookingDetailsModal:not(.hidden) {
    opacity: 1;
}

/* Smooth transitions for modal content */
#bookingDetailsContent {
    transition: all 0.2s ease-in-out;
}

/* Scrollbar styling for modal */
#bookingDetailsModal .max-h-\[90vh\] {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

#bookingDetailsModal .max-h-\[90vh\]::-webkit-scrollbar {
    width: 6px;
}

#bookingDetailsModal .max-h-\[90vh\]::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

#bookingDetailsModal .max-h-\[90vh\]::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

#bookingDetailsModal .max-h-\[90vh\]::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>

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

<!-- Booking Details Modal -->
<div id="bookingDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xs max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Chi tiết đặt phòng</h3>
                    <button onclick="closeBookingDetailsModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div id="bookingDetailsContent">
                    <div class="flex items-center justify-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <span class="ml-2 text-gray-600">Đang tải...</span>
                    </div>
                </div>
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

    // Close modals when clicking outside
    document.getElementById('reviewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReviewModal();
        }
    });

    document.getElementById('bookingDetailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeBookingDetailsModal();
        }
    });

    function showBookingDetails(maHoaDon) {
        // Hiển thị modal và loading
        document.getElementById('bookingDetailsModal').classList.remove('hidden');
        document.getElementById('bookingDetailsContent').innerHTML = `
            <div class="flex items-center justify-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <span class="ml-2 text-gray-600">Đang tải chi tiết...</span>
            </div>
        `;

        // Gọi API lấy chi tiết
        fetch(`/tai-khoan/chi-tiet-hoa-don?id=${maHoaDon}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderBookingDetails(data.data);
                } else {
                    showError(data.error || 'Không thể tải chi tiết đặt phòng');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Có lỗi xảy ra khi tải dữ liệu');
            });
    }

    function renderBookingDetails(booking) {
        const statusLabels = {
            'cho_xac_nhan': 'Chờ xác nhận',
            'da_xac_nhan': 'Đã xác nhận', 
            'da_thanh_toan': 'Đã thanh toán',
            'da_huy': 'Đã hủy'
        };

        const statusColors = {
            'cho_xac_nhan': 'bg-yellow-100 text-yellow-800',
            'da_xac_nhan': 'bg-blue-100 text-blue-800',
            'da_thanh_toan': 'bg-green-100 text-green-800',
            'da_huy': 'bg-red-100 text-red-800'
        };

        let roomsHtml = '';
        if (booking.rooms_data && booking.rooms_data.length > 0) {
            roomsHtml = booking.rooms_data.map(room => `
                <div class="border border-gray-200 rounded-lg p-3 sm:p-4 mb-4">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-3">
                        <h4 class="font-medium text-gray-900 mb-1 sm:mb-0">${room.ten_phong}</h4>
                        <span class="text-blue-600 font-semibold text-sm sm:text-base">${new Intl.NumberFormat('vi-VN').format(room.gia_hien_tai)}₫/giờ</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-sm mb-3">
                        <div>
                            <span class="text-gray-600">Check-in:</span>
                            <div class="font-medium">${formatDateTime(room.check_in)}</div>
                        </div>
                        <div>
                            <span class="text-gray-600">Check-out:</span>
                            <div class="font-medium">${formatDateTime(room.check_out)}</div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t">
                        <span class="text-gray-600">${room.so_gio.toFixed(1)} giờ</span>
                        <span class="font-semibold text-base sm:text-lg">${new Intl.NumberFormat('vi-VN').format(room.tien_phong)}₫</span>
                    </div>
                </div>
            `).join('');
        } else {
            roomsHtml = '<p class="text-gray-500">Không có phòng nào được đặt</p>';
        }

        let servicesHtml = '';
        if (booking.services_data && booking.services_data.length > 0) {
            servicesHtml = `
                <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
                    <h4 class="font-medium text-gray-900 mb-3">Dịch vụ bổ sung</h4>
                    <div class="space-y-2">
                        ${booking.services_data.map(service => `
                            <div class="flex justify-between items-center py-1">
                                <div class="flex-1 min-w-0">
                                    <span class="text-gray-900 block truncate">${service.ten_dich_vu}</span>
                                    <span class="text-gray-500 text-sm">Số lượng: ${service.so_luong}</span>
                                </div>
                                <span class="font-medium ml-2">${new Intl.NumberFormat('vi-VN').format(service.thanh_tien)}₫</span>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        const content = `
            <div class="space-y-6">
                <!-- Header thông tin cơ bản -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Thông tin đặt phòng</h4>
                            <div class="space-y-1 text-sm">
                                <p><span class="text-gray-600">Mã đặt:</span> <span class="font-medium">#${booking.ma_hoa_don}</span></p>
                                <p><span class="text-gray-600">Ngày đặt:</span> <span class="font-medium">${formatDateTime(booking.thoi_gian_dat)}</span></p>
                                <p><span class="text-gray-600">Trạng thái:</span> 
                                    <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium ${statusColors[booking.trang_thai] || 'bg-gray-100 text-gray-800'}">
                                        ${statusLabels[booking.trang_thai] || 'Không xác định'}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Thông tin khách hàng</h4>
                            <div class="space-y-1 text-sm">
                                <p><span class="text-gray-600">Họ tên:</span> <span class="font-medium">${booking.ten_khach_hang}</span></p>
                                <p><span class="text-gray-600">Email:</span> <span class="font-medium">${booking.email_khach_hang || 'N/A'}</span></p>
                                <p><span class="text-gray-600">SĐT:</span> <span class="font-medium">${booking.sdt_khach_hang || 'N/A'}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chi tiết phòng -->
                <div>
                    <h4 class="font-medium text-gray-900 mb-4">Chi tiết phòng đặt</h4>
                    ${roomsHtml}
                </div>

                <!-- Dịch vụ -->
                ${servicesHtml}

                <!-- Tổng kết -->
                <div class="bg-blue-50 rounded-lg p-3 sm:p-4">
                    <h4 class="font-medium text-gray-900 mb-3">Tổng kết thanh toán</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tiền phòng:</span>
                            <span class="font-medium">${new Intl.NumberFormat('vi-VN').format(booking.tong_tien_phong)}₫</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tiền dịch vụ:</span>
                            <span class="font-medium">${new Intl.NumberFormat('vi-VN').format(booking.tong_tien_dich_vu)}₫</span>
                        </div>
                        <hr class="border-gray-300">
                        <div class="flex justify-between text-base sm:text-lg font-semibold">
                            <span class="text-gray-900">Tổng cộng:</span>
                            <span class="text-blue-600">${new Intl.NumberFormat('vi-VN').format(booking.tong_tien)}₫</span>
                        </div>
                    </div>
                </div>

                ${booking.ghi_chu ? `
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
                        <h4 class="font-medium text-gray-900 mb-2">Ghi chú</h4>
                        <p class="text-gray-700">${booking.ghi_chu}</p>
                    </div>
                ` : ''}
            </div>
        `;

        document.getElementById('bookingDetailsContent').innerHTML = content;
    }

    function closeBookingDetailsModal() {
        document.getElementById('bookingDetailsModal').classList.add('hidden');
    }

    function showError(message) {
        document.getElementById('bookingDetailsContent').innerHTML = `
            <div class="text-center py-8">
                <div class="text-red-500 text-2xl mb-2">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <p class="text-gray-600">${message}</p>
                <button onclick="closeBookingDetailsModal()" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    Đóng
                </button>
            </div>
        `;
    }

    function formatDateTime(dateTimeString) {
        if (!dateTimeString) return 'N/A';
        const date = new Date(dateTimeString);
        return date.toLocaleString('vi-VN', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/app.php';
?>