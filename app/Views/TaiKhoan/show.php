<?php $title = 'Chi tiết tài khoản'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/tai-khoan" class="hover:text-cyan-600 transition-colors">Tài khoản</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Chi tiết tài khoản</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Chi tiết tài khoản</h1>
            <p class="text-slate-600">Xem thông tin chi tiết tài khoản người dùng</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
            <a href="/tai-khoan/edit/<?= $taiKhoan['id'] ?? 1 ?>" 
               class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Chỉnh sửa
            </a>
            <a href="/tai-khoan" 
               class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Quay lại
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-6 border-b border-slate-200">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                <?= substr($taiKhoan['ho_ten'] ?? 'TK', 0, 1) ?>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($taiKhoan['ho_ten'] ?? 'Nguyễn Văn A') ?></h2>
                            <p class="text-slate-600"><?= htmlspecialchars($taiKhoan['email'] ?? 'nguyenvana@example.com') ?></p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= ($taiKhoan['trang_thai'] ?? 1) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= ($taiKhoan['trang_thai'] ?? 1) ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                </span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?= ucfirst($taiKhoan['vai_tro'] ?? 'khach_hang') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Số điện thoại</label>
                                <p class="text-slate-800 font-medium"><?= htmlspecialchars($taiKhoan['so_dien_thoai'] ?? '0123456789') ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Ngày sinh</label>
                                <p class="text-slate-800"><?= date('d/m/Y', strtotime($taiKhoan['ngay_sinh'] ?? '1990-01-01')) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Giới tính</label>
                                <p class="text-slate-800"><?= ($taiKhoan['gioi_tinh'] ?? 'nam') == 'nam' ? 'Nam' : 'Nữ' ?></p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Ngày tạo</label>
                                <p class="text-slate-800"><?= date('d/m/Y H:i', strtotime($taiKhoan['ngay_tao'] ?? 'now')) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Cập nhật cuối</label>
                                <p class="text-slate-800"><?= date('d/m/Y H:i', strtotime($taiKhoan['ngay_cap_nhat'] ?? 'now')) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Lần đăng nhập cuối</label>
                                <p class="text-slate-800"><?= date('d/m/Y H:i', strtotime($taiKhoan['lan_dang_nhap_cuoi'] ?? 'now')) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Info -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Thông tin địa chỉ</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1">Địa chỉ</label>
                            <p class="text-slate-800"><?= htmlspecialchars($taiKhoan['dia_chi'] ?? '123 Đường ABC, Phường XYZ') ?></p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Thành phố</label>
                                <p class="text-slate-800"><?= htmlspecialchars($taiKhoan['thanh_pho'] ?? 'Hồ Chí Minh') ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Quận/Huyện</label>
                                <p class="text-slate-800"><?= htmlspecialchars($taiKhoan['quan_huyen'] ?? 'Quận 1') ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Mã bưu điện</label>
                                <p class="text-slate-800"><?= htmlspecialchars($taiKhoan['ma_buu_dien'] ?? '700000') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Info -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Bảo mật</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Xác thực email</label>
                                <div class="flex items-center">
                                    <?php if ($taiKhoan['email_xac_thuc'] ?? true): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Đã xác thực
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Chưa xác thực
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Xác thực 2 bước</label>
                                <div class="flex items-center">
                                    <?php if ($taiKhoan['xac_thuc_2_buoc'] ?? false): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Đã bật
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Chưa bật
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Số lần đăng nhập thất bại</label>
                                <p class="text-slate-800 font-medium"><?= $taiKhoan['so_lan_dang_nhap_that_bai'] ?? 0 ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-600 mb-1">Thay đổi mật khẩu lần cuối</label>
                                <p class="text-slate-800"><?= date('d/m/Y H:i', strtotime($taiKhoan['thay_doi_mat_khau_cuoi'] ?? 'now')) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Hành động nhanh</h3>
                </div>
                <div class="p-6 space-y-3">
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Gửi email xác thực
                    </button>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Đặt lại mật khẩu
                    </button>
                    <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Khóa tài khoản
                    </button>
                    <button class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Xóa tài khoản
                    </button>
                </div>
            </div>

            <!-- Account Stats -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Thống kê tài khoản</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Số đơn hàng</span>
                        <span class="text-lg font-bold text-cyan-600">12</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Tổng chi tiêu</span>
                        <span class="text-lg font-bold text-green-600">15.5M₫</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Điểm tích lũy</span>
                        <span class="text-lg font-bold text-yellow-600">1,250</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Đánh giá</span>
                        <span class="text-lg font-bold text-purple-600">8</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Hoạt động gần đây</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-slate-800">Đăng nhập thành công</p>
                                <p class="text-slate-500 text-xs">2 giờ trước</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-slate-800">Đặt phòng #12345</p>
                                <p class="text-slate-500 text-xs">1 ngày trước</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-slate-800">Cập nhật profile</p>
                                <p class="text-slate-500 text-xs">3 ngày trước</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-slate-800">Viết đánh giá</p>
                                <p class="text-slate-500 text-xs">1 tuần trước</p>
                            </div>
                        </div>
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

    // Quick action buttons
    const actionButtons = document.querySelectorAll('button[class*="bg-"]');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            if (confirm(`Bạn có chắc chắn muốn ${action.toLowerCase()}?`)) {
                // Add loading state
                const originalText = this.innerHTML;
                this.innerHTML = '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang xử lý...</span>';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                    alert(`${action} thành công!`);
                }, 2000);
            }
        });
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
