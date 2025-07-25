<?php
$title = 'Thông tin cá nhân - Hotel Ocean';
ob_start();
?>

<div class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-8 mb-8" style="margin-top: 20px;">
            <div class="flex items-center space-x-4 mb-6">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-ocean-500 to-ocean-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-3xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Thông tin cá nhân</h1>
                    <p class="text-gray-600">Quản lý thông tin tài khoản của bạn</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                        <i class="fas fa-edit text-ocean-600 mr-2"></i>
                        Cập nhật thông tin
                    </h2>

                    <form action="/profile" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ho_ten" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1"></i> Họ và tên
                                </label>
                                <input type="text" id="ho_ten" name="ho_ten"
                                    value="<?= htmlspecialchars(old('ho_ten') ?: ($user->ho_ten ?? '')) ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                                    required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-1"></i> Email
                                </label>
                                <input type="email" id="email" name="email"
                                    value="<?= htmlspecialchars(old('email') ?: ($user->email ?? '')) ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all"
                                    required>
                            </div>

                            <div>
                                <label for="so_dien_thoai" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-1"></i> Số điện thoại
                                </label>
                                <input type="tel" id="so_dien_thoai" name="sdt"
                                    value="<?= htmlspecialchars(old('sdt') ?: ($user->sdt ?? '')) ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="so_cccd" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-id-card mr-1"></i> Số CCCD
                                </label>
                                <input type="text" id="so_cccd" name="so_cccd"
                                    value="<?= htmlspecialchars(old('so_cccd') ?: ($user->so_cccd ?? '')) ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:border-transparent transition-all">
                            </div>

                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <a href="/" class="text-gray-600 hover:text-gray-800 font-medium transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Trở về trang chủ
                            </a>

                            <button type="submit"
                                class="bg-ocean-600 text-white px-8 py-3 rounded-xl font-semibold transition-all transform hover:scale-102 shadow-xs border border-gray-100">
                                <i class="fas fa-save mr-2"></i>
                                Cập nhật thông tin
                            </button>
                        </div>
                        <div id="profile-error"
                            style="color: #e53e3e; font-weight: 500; margin-top: 10px; display: none;"></div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const form = document.querySelector('form');
                                if (form) {
                                    form.addEventListener('submit', function (e) {
                                        const soDienThoai = form.querySelector('input[name="so_dien_thoai"]');
                                        const soCCCD = form.querySelector('input[name="so_cccd"]');
                                        let error = '';
                                        if (soDienThoai && soDienThoai.value.trim() !== '' && soDienThoai.value.trim().length === 0) {
                                            error = 'Số điện thoại không được để trống';
                                        }
                                        if (soCCCD && soCCCD.value.trim() !== '' && soCCCD.value.trim().length === 0) {
                                            error = 'Số CCCD không được để trống';
                                        }
                                        if (error) {
                                            e.preventDefault();
                                            const errorBox = document.getElementById('profile-error');
                                            if (errorBox) {
                                                errorBox.textContent = error;
                                                errorBox.style.display = 'block';
                                            }
                                        }
                                    });
                                }
                            });
                        </script>
                    </form>
                </div>
            </div>

            <!-- Account Info -->
            <div class="space-y-6">
                <!-- Account Status -->
                <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-shield-alt text-ocean-600 mr-2"></i>
                        Trạng thái tài khoản
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Trạng thái:</span>
                            <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">
                                Hoạt động
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Phân quyền:</span>
                            <span class="text-sm font-medium text-gray-800 capitalize">
                                <?= htmlspecialchars($user->phan_quyen ?? 'khach_hang') ?>
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Ngày tạo:</span>
                            <span class="text-sm text-gray-800">
                                <?= isset($user->ngay_tao) ? date('d/m/Y', strtotime($user->ngay_tao)) : 'N/A' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-cogs text-ocean-600 mr-2"></i>
                        Thao tác nhanh
                    </h3>
                    <div class="space-y-3">
                        <a href="/change-password"
                            class="flex items-center w-full p-3 text-gray-700 bg-gray-50 rounded-xl hover:bg-ocean-50 hover:text-ocean-600 transition-colors">
                            <i class="fas fa-key mr-3"></i>
                            Đổi mật khẩu
                        </a>
                        <a href="/tai-khoan/lich-su-dat-phong"
                            class="flex items-center w-full p-3 text-gray-700 bg-gray-50 rounded-xl hover:bg-ocean-50 hover:text-ocean-600 transition-colors">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            Lịch sử đặt phòng
                        </a>
                        <a href="/tai-khoan/lich-su-danh-gia"
                            class="flex items-center w-full p-3 text-gray-700 bg-gray-50 rounded-xl hover:bg-ocean-50 hover:text-ocean-600 transition-colors">
                            <i class="fas fa-star mr-3"></i>
                            Đánh giá của tôi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>