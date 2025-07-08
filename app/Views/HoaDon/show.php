<?php $title = 'Chi tiết hóa đơn'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/hoa-don" class="hover:text-cyan-600 transition-colors">Hóa đơn</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Chi tiết hóa đơn</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Chi tiết hóa đơn</h1>
            <p class="text-slate-600">Thông tin chi tiết đơn đặt phòng và thanh toán</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
            <button class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                In hóa đơn
            </button>
            <a href="/hoa-don/edit/<?= $hoaDon['id'] ?? 1 ?>" 
               class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Chỉnh sửa
            </a>
            <a href="/hoa-don" 
               class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Quay lại
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Invoice Header -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-6 border-b border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">Hóa đơn #<?= $hoaDon['ma_hoa_don'] ?? 'HD001' ?></h2>
                            <p class="text-slate-600 mt-1">Ngày tạo: <?= date('d/m/Y H:i', strtotime($hoaDon['ngay_tao'] ?? 'now')) ?></p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                <?php 
                                $status = $hoaDon['trang_thai'] ?? 'cho_thanh_toan';
                                switch($status) {
                                    case 'da_thanh_toan': echo 'bg-green-100 text-green-800'; break;
                                    case 'cho_thanh_toan': echo 'bg-yellow-100 text-yellow-800'; break;
                                    case 'da_huy': echo 'bg-red-100 text-red-800'; break;
                                    default: echo 'bg-slate-100 text-slate-800';
                                }
                                ?>">
                                <?php 
                                switch($status) {
                                    case 'da_thanh_toan': echo 'Đã thanh toán'; break;
                                    case 'cho_thanh_toan': echo 'Chờ thanh toán'; break;
                                    case 'da_huy': echo 'Đã hủy'; break;
                                    default: echo 'Chưa xác định';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-3">Thông tin khách hàng</h3>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium text-slate-600">Họ tên:</span> <?= htmlspecialchars($hoaDon['ten_khach_hang'] ?? 'Nguyễn Văn A') ?></p>
                                <p><span class="font-medium text-slate-600">Email:</span> <?= htmlspecialchars($hoaDon['email_khach_hang'] ?? 'nguyenvana@example.com') ?></p>
                                <p><span class="font-medium text-slate-600">Điện thoại:</span> <?= htmlspecialchars($hoaDon['sdt_khach_hang'] ?? '0123456789') ?></p>
                                <p><span class="font-medium text-slate-600">Địa chỉ:</span> <?= htmlspecialchars($hoaDon['dia_chi_khach_hang'] ?? '123 Đường ABC, Q1, TP.HCM') ?></p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-3">Thông tin đặt phòng</h3>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium text-slate-600">Ngày nhận phòng:</span> <?= date('d/m/Y', strtotime($hoaDon['ngay_nhan_phong'] ?? '+1 day')) ?></p>
                                <p><span class="font-medium text-slate-600">Ngày trả phòng:</span> <?= date('d/m/Y', strtotime($hoaDon['ngay_tra_phong'] ?? '+3 days')) ?></p>
                                <p><span class="font-medium text-slate-600">Số đêm:</span> <?= $hoaDon['so_dem'] ?? 2 ?> đêm</p>
                                <p><span class="font-medium text-slate-600">Số khách:</span> <?= $hoaDon['so_khach'] ?? 2 ?> người</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Chi tiết đơn hàng</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Sản phẩm/Dịch vụ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Số lượng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Đơn giá</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Phòng Deluxe</p>
                                            <p class="text-sm text-slate-500">2 giường đơn, View thành phố</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-900">2 đêm</td>
                                <td class="px-6 py-4 text-sm text-slate-900">1,500,000₫</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">3,000,000₫</td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Spa Massage</p>
                                            <p class="text-sm text-slate-500">Massage toàn thân 60 phút</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-900">2 lần</td>
                                <td class="px-6 py-4 text-sm text-slate-900">500,000₫</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">1,000,000₫</td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-orange-100 to-red-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">Bữa sáng</p>
                                            <p class="text-sm text-slate-500">Buffet sáng 2 người</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-900">2 suất</td>
                                <td class="px-6 py-4 text-sm text-slate-900">200,000₫</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">400,000₫</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Tóm tắt thanh toán</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Tạm tính:</span>
                            <span class="text-slate-800">4,400,000₫</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Thuế VAT (10%):</span>
                            <span class="text-slate-800">440,000₫</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Phí dịch vụ (5%):</span>
                            <span class="text-slate-800">220,000₫</span>
                        </div>
                        <div class="flex justify-between items-center text-green-600">
                            <span>Giảm giá (SUMMER20):</span>
                            <span>-200,000₫</span>
                        </div>
                        <hr class="border-slate-200">
                        <div class="flex justify-between items-center text-lg font-bold">
                            <span class="text-slate-800">Tổng cộng:</span>
                            <span class="text-cyan-600">4,860,000₫</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Đã thanh toán:</span>
                            <span class="text-green-600 font-medium"><?= ($hoaDon['trang_thai'] ?? 'cho_thanh_toan') == 'da_thanh_toan' ? '4,860,000₫' : '0₫' ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Còn lại:</span>
                            <span class="text-red-600 font-medium"><?= ($hoaDon['trang_thai'] ?? 'cho_thanh_toan') == 'da_thanh_toan' ? '0₫' : '4,860,000₫' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Payment Status -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Trạng thái thanh toán</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto mb-3 rounded-full flex items-center justify-center
                                <?php 
                                $status = $hoaDon['trang_thai'] ?? 'cho_thanh_toan';
                                switch($status) {
                                    case 'da_thanh_toan': echo 'bg-green-100'; break;
                                    case 'cho_thanh_toan': echo 'bg-yellow-100'; break;
                                    case 'da_huy': echo 'bg-red-100'; break;
                                    default: echo 'bg-slate-100';
                                }
                                ?>">
                                <svg class="w-8 h-8 
                                    <?php 
                                    switch($status) {
                                        case 'da_thanh_toan': echo 'text-green-600'; break;
                                        case 'cho_thanh_toan': echo 'text-yellow-600'; break;
                                        case 'da_huy': echo 'text-red-600'; break;
                                        default: echo 'text-slate-600';
                                    }
                                    ?>" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <?php if ($status == 'da_thanh_toan'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    <?php elseif ($status == 'da_huy'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    <?php else: ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    <?php endif; ?>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-slate-800">
                                <?php 
                                switch($status) {
                                    case 'da_thanh_toan': echo 'Đã thanh toán'; break;
                                    case 'cho_thanh_toan': echo 'Chờ thanh toán'; break;
                                    case 'da_huy': echo 'Đã hủy'; break;
                                    default: echo 'Chưa xác định';
                                }
                                ?>
                            </h4>
                            <p class="text-sm text-slate-600 mt-1">
                                <?php if ($status == 'da_thanh_toan'): ?>
                                    Thanh toán vào <?= date('d/m/Y H:i', strtotime($hoaDon['ngay_thanh_toan'] ?? 'now')) ?>
                                <?php elseif ($status == 'da_huy'): ?>
                                    Hủy vào <?= date('d/m/Y H:i', strtotime($hoaDon['ngay_huy'] ?? 'now')) ?>
                                <?php else: ?>
                                    Chờ khách hàng thanh toán
                                <?php endif; ?>
                            </p>
                        </div>

                        <?php if ($status == 'cho_thanh_toan'): ?>
                        <div class="space-y-2">
                            <button class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Xác nhận thanh toán
                            </button>
                            <button class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Hủy hóa đơn
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Phương thức thanh toán</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800"><?= $hoaDon['phuong_thuc_thanh_toan'] ?? 'Thẻ tín dụng' ?></p>
                            <p class="text-sm text-slate-500">**** **** **** 1234</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Actions -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Hành động</h3>
                </div>
                <div class="p-6 space-y-3">
                    <button class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Gửi hóa đơn qua email
                    </button>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Tải xuống PDF
                    </button>
                    <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Tạo hóa đơn VAT
                    </button>
                    <button class="w-full bg-slate-500 hover:bg-slate-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Sao chép hóa đơn
                    </button>
                </div>
            </div>

            <!-- Customer History -->
            <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Lịch sử khách hàng</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600">Tổng đơn hàng</span>
                        <span class="font-medium text-slate-800">12</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600">Tổng chi tiêu</span>
                        <span class="font-medium text-slate-800">58,400,000₫</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600">Khách hàng từ</span>
                        <span class="font-medium text-slate-800">01/2023</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600">Hạng thành viên</span>
                        <span class="font-medium text-cyan-600">VIP Gold</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations
    const elements = document.querySelectorAll('.bg-white');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        setTimeout(() => {
            el.style.transition = 'all 0.6s ease';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Action buttons
    const actionButtons = document.querySelectorAll('button[class*="bg-"]');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            
            if (action.includes('Xác nhận thanh toán')) {
                if (confirm('Bạn có chắc chắn muốn xác nhận thanh toán cho hóa đơn này?')) {
                    // Add loading state
                    const originalText = this.innerHTML;
                    this.innerHTML = '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang xử lý...</span>';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        alert('Xác nhận thanh toán thành công!');
                        location.reload();
                    }, 2000);
                }
            } else if (action.includes('Hủy hóa đơn')) {
                if (confirm('Bạn có chắc chắn muốn hủy hóa đơn này? Hành động này không thể hoàn tác.')) {
                    alert('Hủy hóa đơn thành công!');
                    location.reload();
                }
            } else if (action.includes('In hóa đơn')) {
                window.print();
            } else {
                alert(`${action} thành công!`);
            }
        });
    });

    // Table row hover effects
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
            this.style.transition = 'all 0.2s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
