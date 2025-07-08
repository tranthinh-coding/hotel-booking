<?php $title = 'Chỉnh sửa tài khoản'; ?>
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
            <li class="text-slate-800 font-medium">Chỉnh sửa tài khoản</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Chỉnh sửa tài khoản</h1>
        <p class="text-slate-600">Cập nhật thông tin tài khoản người dùng</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="xl:col-span-2">
            <form id="editAccountForm" class="space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Thông tin cơ bản</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ho_ten" class="block text-sm font-medium text-slate-700 mb-2">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="ho_ten" name="ho_ten" 
                                       value="<?= htmlspecialchars($taiKhoan['ho_ten'] ?? 'Nguyễn Văn A') ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" 
                                       value="<?= htmlspecialchars($taiKhoan['email'] ?? 'nguyenvana@example.com') ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                                <p class="text-xs text-slate-500 mt-1">Email đã được xác thực</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="so_dien_thoai" class="block text-sm font-medium text-slate-700 mb-2">
                                    Số điện thoại <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="so_dien_thoai" name="so_dien_thoai" 
                                       value="<?= htmlspecialchars($taiKhoan['so_dien_thoai'] ?? '0123456789') ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                            <div>
                                <label for="ngay_sinh" class="block text-sm font-medium text-slate-700 mb-2">
                                    Ngày sinh <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="ngay_sinh" name="ngay_sinh" 
                                       value="<?= $taiKhoan['ngay_sinh'] ?? '1990-01-01' ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="gioi_tinh" class="block text-sm font-medium text-slate-700 mb-2">
                                    Giới tính <span class="text-red-500">*</span>
                                </label>
                                <select id="gioi_tinh" name="gioi_tinh" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="nam" <?= ($taiKhoan['gioi_tinh'] ?? 'nam') == 'nam' ? 'selected' : '' ?>>Nam</option>
                                    <option value="nu" <?= ($taiKhoan['gioi_tinh'] ?? 'nam') == 'nu' ? 'selected' : '' ?>>Nữ</option>
                                    <option value="khac" <?= ($taiKhoan['gioi_tinh'] ?? 'nam') == 'khac' ? 'selected' : '' ?>>Khác</option>
                                </select>
                            </div>
                            <div>
                                <label for="vai_tro" class="block text-sm font-medium text-slate-700 mb-2">
                                    Vai trò <span class="text-red-500">*</span>
                                </label>
                                <select id="vai_tro" name="vai_tro" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="khach_hang" <?= ($taiKhoan['vai_tro'] ?? 'khach_hang') == 'khach_hang' ? 'selected' : '' ?>>Khách hàng</option>
                                    <option value="nhan_vien" <?= ($taiKhoan['vai_tro'] ?? 'khach_hang') == 'nhan_vien' ? 'selected' : '' ?>>Nhân viên</option>
                                    <option value="quan_ly" <?= ($taiKhoan['vai_tro'] ?? 'khach_hang') == 'quan_ly' ? 'selected' : '' ?>>Quản lý</option>
                                    <option value="admin" <?= ($taiKhoan['vai_tro'] ?? 'khach_hang') == 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-slate-800">Thay đổi mật khẩu</h2>
                            <label class="flex items-center">
                                <input type="checkbox" id="change_password" class="form-checkbox h-4 w-4 text-cyan-600">
                                <span class="ml-2 text-sm text-slate-600">Thay đổi mật khẩu</span>
                            </label>
                        </div>
                    </div>
                    <div id="password_section" class="p-6 space-y-4 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="mat_khau_moi" class="block text-sm font-medium text-slate-700 mb-2">
                                    Mật khẩu mới
                                </label>
                                <div class="relative">
                                    <input type="password" id="mat_khau_moi" name="mat_khau_moi" 
                                           class="w-full px-3 py-2 pr-10 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                           placeholder="Nhập mật khẩu mới">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('mat_khau_moi')">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <div class="flex items-center space-x-1 text-xs">
                                        <div id="length-check" class="flex items-center">
                                            <span class="w-3 h-3 rounded-full bg-slate-300 mr-1"></span>
                                            <span class="text-slate-500">Ít nhất 8 ký tự</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-1 text-xs mt-1">
                                        <div id="uppercase-check" class="flex items-center">
                                            <span class="w-3 h-3 rounded-full bg-slate-300 mr-1"></span>
                                            <span class="text-slate-500">Chữ hoa</span>
                                        </div>
                                        <div id="number-check" class="flex items-center ml-4">
                                            <span class="w-3 h-3 rounded-full bg-slate-300 mr-1"></span>
                                            <span class="text-slate-500">Số</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="xac_nhan_mat_khau_moi" class="block text-sm font-medium text-slate-700 mb-2">
                                    Xác nhận mật khẩu mới
                                </label>
                                <div class="relative">
                                    <input type="password" id="xac_nhan_mat_khau_moi" name="xac_nhan_mat_khau_moi" 
                                           class="w-full px-3 py-2 pr-10 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                           placeholder="Nhập lại mật khẩu mới">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('xac_nhan_mat_khau_moi')">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <p id="password-match" class="text-xs text-slate-500 mt-1">Mật khẩu phải trùng khớp</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Địa chỉ</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="dia_chi" class="block text-sm font-medium text-slate-700 mb-2">
                                Địa chỉ
                            </label>
                            <input type="text" id="dia_chi" name="dia_chi" 
                                   value="<?= htmlspecialchars($taiKhoan['dia_chi'] ?? '123 Đường ABC, Phường XYZ') ?>"
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                   placeholder="Số nhà, tên đường">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="thanh_pho" class="block text-sm font-medium text-slate-700 mb-2">
                                    Thành phố
                                </label>
                                <select id="thanh_pho" name="thanh_pho" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                                    <option value="ho_chi_minh" <?= ($taiKhoan['thanh_pho'] ?? 'ho_chi_minh') == 'ho_chi_minh' ? 'selected' : '' ?>>Hồ Chí Minh</option>
                                    <option value="ha_noi" <?= ($taiKhoan['thanh_pho'] ?? 'ho_chi_minh') == 'ha_noi' ? 'selected' : '' ?>>Hà Nội</option>
                                    <option value="da_nang" <?= ($taiKhoan['thanh_pho'] ?? 'ho_chi_minh') == 'da_nang' ? 'selected' : '' ?>>Đà Nẵng</option>
                                    <option value="can_tho" <?= ($taiKhoan['thanh_pho'] ?? 'ho_chi_minh') == 'can_tho' ? 'selected' : '' ?>>Cần Thơ</option>
                                    <option value="hai_phong" <?= ($taiKhoan['thanh_pho'] ?? 'ho_chi_minh') == 'hai_phong' ? 'selected' : '' ?>>Hải Phòng</option>
                                </select>
                            </div>
                            <div>
                                <label for="quan_huyen" class="block text-sm font-medium text-slate-700 mb-2">
                                    Quận/Huyện
                                </label>
                                <input type="text" id="quan_huyen" name="quan_huyen" 
                                       value="<?= htmlspecialchars($taiKhoan['quan_huyen'] ?? 'Quận 1') ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="Quận/Huyện">
                            </div>
                            <div>
                                <label for="ma_buu_dien" class="block text-sm font-medium text-slate-700 mb-2">
                                    Mã bưu điện
                                </label>
                                <input type="text" id="ma_buu_dien" name="ma_buu_dien" 
                                       value="<?= htmlspecialchars($taiKhoan['ma_buu_dien'] ?? '700000') ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="700000">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Cài đặt tài khoản</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="email_xac_thuc" name="email_xac_thuc" value="1"
                                           <?= ($taiKhoan['email_xac_thuc'] ?? true) ? 'checked' : '' ?>
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="email_xac_thuc" class="ml-2 block text-sm text-slate-700">
                                        Email đã xác thực
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="trang_thai" name="trang_thai" value="1"
                                           <?= ($taiKhoan['trang_thai'] ?? true) ? 'checked' : '' ?>
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="trang_thai" class="ml-2 block text-sm text-slate-700">
                                        Tài khoản hoạt động
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="xac_thuc_2_buoc" name="xac_thuc_2_buoc" value="1"
                                           <?= ($taiKhoan['xac_thuc_2_buoc'] ?? false) ? 'checked' : '' ?>
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="xac_thuc_2_buoc" class="ml-2 block text-sm text-slate-700">
                                        Xác thực 2 bước
                                    </label>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="thong_bao_email" name="thong_bao_email" value="1"
                                           <?= ($taiKhoan['thong_bao_email'] ?? true) ? 'checked' : '' ?>
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="thong_bao_email" class="ml-2 block text-sm text-slate-700">
                                        Nhận thông báo qua email
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="thong_bao_sms" name="thong_bao_sms" value="1"
                                           <?= ($taiKhoan['thong_bao_sms'] ?? false) ? 'checked' : '' ?>
                                           class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-slate-300 rounded">
                                    <label for="thong_bao_sms" class="ml-2 block text-sm text-slate-700">
                                        Nhận thông báo qua SMS
                                    </label>
                                </div>
                                <div>
                                    <label for="so_lan_dang_nhap_that_bai" class="block text-sm font-medium text-slate-700 mb-2">
                                        Số lần đăng nhập thất bại
                                    </label>
                                    <input type="number" id="so_lan_dang_nhap_that_bai" name="so_lan_dang_nhap_that_bai" 
                                           value="<?= $taiKhoan['so_lan_dang_nhap_that_bai'] ?? 0 ?>"
                                           class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                           readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="/tai-khoan/show/<?= $taiKhoan['id'] ?? 1 ?>" 
                       class="px-6 py-2 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors text-center">
                        Hủy bỏ
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        Cập nhật tài khoản
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Summary -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Tóm tắt tài khoản</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">ID tài khoản</span>
                        <span class="text-sm font-medium text-slate-800">#<?= $taiKhoan['id'] ?? 1 ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Ngày tạo</span>
                        <span class="text-sm text-slate-800"><?= date('d/m/Y', strtotime($taiKhoan['ngay_tao'] ?? 'now')) ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Cập nhật cuối</span>
                        <span class="text-sm text-slate-800"><?= date('d/m/Y', strtotime($taiKhoan['ngay_cap_nhat'] ?? 'now')) ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Đăng nhập cuối</span>
                        <span class="text-sm text-slate-800"><?= date('d/m/Y H:i', strtotime($taiKhoan['lan_dang_nhap_cuoi'] ?? 'now')) ?></span>
                    </div>
                </div>
            </div>

            <!-- Security Info -->
            <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-xl border border-red-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Bảo mật</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-sm text-slate-600">Email đã xác thực</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                        <span class="text-sm text-slate-600">Chưa bật xác thực 2 bước</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                        <span class="text-sm text-slate-600">Mật khẩu mạnh</span>
                    </div>
                </div>
                <button class="w-full mt-4 bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                    Đặt lại mật khẩu
                </button>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Hành động nhanh</h3>
                </div>
                <div class="p-6 space-y-3">
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                        Gửi email xác thực
                    </button>
                    <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                        Khóa tài khoản
                    </button>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                        Xem lịch sử hoạt động
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.type === 'password' ? 'text' : 'password';
    field.type = type;
}

document.addEventListener('DOMContentLoaded', function() {
    // Toggle password section
    const changePasswordCheckbox = document.getElementById('change_password');
    const passwordSection = document.getElementById('password_section');
    
    changePasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordSection.classList.remove('hidden');
        } else {
            passwordSection.classList.add('hidden');
            // Clear password fields
            document.getElementById('mat_khau_moi').value = '';
            document.getElementById('xac_nhan_mat_khau_moi').value = '';
        }
    });

    // Password strength checking (only when section is visible)
    const passwordInput = document.getElementById('mat_khau_moi');
    const confirmPasswordInput = document.getElementById('xac_nhan_mat_khau_moi');
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const numberCheck = document.getElementById('number-check');
    const passwordMatch = document.getElementById('password-match');

    function updatePasswordStrength() {
        if (passwordSection.classList.contains('hidden')) return;
        
        const password = passwordInput.value;
        
        // Length check
        if (password.length >= 8) {
            lengthCheck.querySelector('span').classList.remove('bg-slate-300');
            lengthCheck.querySelector('span').classList.add('bg-green-500');
            lengthCheck.querySelector('span:last-child').classList.remove('text-slate-500');
            lengthCheck.querySelector('span:last-child').classList.add('text-green-600');
        } else {
            lengthCheck.querySelector('span').classList.remove('bg-green-500');
            lengthCheck.querySelector('span').classList.add('bg-slate-300');
            lengthCheck.querySelector('span:last-child').classList.remove('text-green-600');
            lengthCheck.querySelector('span:last-child').classList.add('text-slate-500');
        }
        
        // Uppercase check
        if (/[A-Z]/.test(password)) {
            uppercaseCheck.querySelector('span').classList.remove('bg-slate-300');
            uppercaseCheck.querySelector('span').classList.add('bg-green-500');
            uppercaseCheck.querySelector('span:last-child').classList.remove('text-slate-500');
            uppercaseCheck.querySelector('span:last-child').classList.add('text-green-600');
        } else {
            uppercaseCheck.querySelector('span').classList.remove('bg-green-500');
            uppercaseCheck.querySelector('span').classList.add('bg-slate-300');
            uppercaseCheck.querySelector('span:last-child').classList.remove('text-green-600');
            uppercaseCheck.querySelector('span:last-child').classList.add('text-slate-500');
        }
        
        // Number check
        if (/\d/.test(password)) {
            numberCheck.querySelector('span').classList.remove('bg-slate-300');
            numberCheck.querySelector('span').classList.add('bg-green-500');
            numberCheck.querySelector('span:last-child').classList.remove('text-slate-500');
            numberCheck.querySelector('span:last-child').classList.add('text-green-600');
        } else {
            numberCheck.querySelector('span').classList.remove('bg-green-500');
            numberCheck.querySelector('span').classList.add('bg-slate-300');
            numberCheck.querySelector('span:last-child').classList.remove('text-green-600');
            numberCheck.querySelector('span:last-child').classList.add('text-slate-500');
        }
    }

    function checkPasswordMatch() {
        if (passwordSection.classList.contains('hidden')) return;
        
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword === '') {
            passwordMatch.textContent = 'Mật khẩu phải trùng khớp';
            passwordMatch.classList.remove('text-green-600', 'text-red-600');
            passwordMatch.classList.add('text-slate-500');
        } else if (password === confirmPassword) {
            passwordMatch.textContent = 'Mật khẩu trùng khớp';
            passwordMatch.classList.remove('text-slate-500', 'text-red-600');
            passwordMatch.classList.add('text-green-600');
        } else {
            passwordMatch.textContent = 'Mật khẩu không trùng khớp';
            passwordMatch.classList.remove('text-slate-500', 'text-green-600');
            passwordMatch.classList.add('text-red-600');
        }
    }

    passwordInput.addEventListener('input', updatePasswordStrength);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    passwordInput.addEventListener('input', checkPasswordMatch);

    // Phone number formatting
    const phoneInput = document.getElementById('so_dien_thoai');
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 10) value = value.slice(0, 10);
        this.value = value;
    });

    // Form submission
    const form = document.getElementById('editAccountForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validation for password change
        if (changePasswordCheckbox.checked) {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (password !== confirmPassword) {
                alert('Mật khẩu và xác nhận mật khẩu không trùng khớp!');
                return;
            }
            
            if (password.length < 8 || !/[A-Z]/.test(password) || !/\d/.test(password)) {
                alert('Mật khẩu không đáp ứng yêu cầu bảo mật!');
                return;
            }
        }
        
        // Success animation
        const button = form.querySelector('button[type="submit"]');
        button.innerHTML = '<span class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang cập nhật...</span>';
        button.disabled = true;
        
        setTimeout(() => {
            alert('Cập nhật tài khoản thành công!');
            window.location.href = '/tai-khoan';
        }, 2000);
    });

    // Quick action buttons
    const actionButtons = document.querySelectorAll('button[class*="bg-"]:not([type="submit"])');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            if (confirm(`Bạn có chắc chắn muốn ${action.toLowerCase()}?`)) {
                alert(`${action} thành công!`);
            }
        });
    });

    // Animation on load
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
