<?php
$title = 'Chi tiết Tài khoản - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Tài khoản';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <div>
        <nav class="text-sm text-gray-500">
            <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="/admin/tai-khoan" class="hover:text-gray-700">Tài khoản</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Chi tiết</span>
        </nav>
    </div>

    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Chi tiết Tài khoản</h1>
            <p class="text-gray-600 mt-1">Thông tin chi tiết tài khoản người dùng</p>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/tai-khoan" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Quay lại
            </a>
            <a href="/admin/tai-khoan/edit?id=<?= $taiKhoan->ma_tai_khoan ?>" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i>Chỉnh sửa
            </a>
        </div>
    </div>

    <!-- Account Information Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Avatar and Basic Info -->
            <div class="space-y-6">
                <div class="text-center">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-blue-600 text-3xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($taiKhoan->ho_ten) ?></h2>
                    <p class="text-gray-600"><?= htmlspecialchars($taiKhoan->mail) ?></p>
                    <?php
                    $roleColors = [
                        'Quản lý' => 'bg-red-100 text-red-800',
                        'Lễ tân' => 'bg-blue-100 text-blue-800', 
                        'Khách hàng' => 'bg-green-100 text-green-800'
                    ];
                    $colorClass = $roleColors[$taiKhoan->phan_quyen] ?? 'bg-gray-100 text-gray-800';
                    ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2 <?= $colorClass ?>">
                        <?= htmlspecialchars($taiKhoan->phan_quyen) ?>
                    </span>
                </div>

                <!-- Contact Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Thông tin liên hệ</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-gray-400 w-5"></i>
                            <span class="ml-3 text-gray-700"><?= htmlspecialchars($taiKhoan->mail) ?></span>
                        </div>
                        <?php if (isNotEmpty($taiKhoan->sdt)): ?>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-gray-400 w-5"></i>
                            <span class="ml-3 text-gray-700"><?= htmlspecialchars($taiKhoan->sdt) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (isNotEmpty($taiKhoan->so_cccd)): ?>
                        <div class="flex items-center">
                            <i class="fas fa-id-card text-gray-400 w-5"></i>
                            <span class="ml-3 text-gray-700"><?= htmlspecialchars($taiKhoan->so_cccd) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Account Details -->
            <div class="space-y-6">
                <!-- Account Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Thông tin tài khoản</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mã tài khoản</label>
                                <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($taiKhoan->ma_tai_khoan) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Trạng thái</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-1">
                                    Hoạt động
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ngày tạo</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <?= date('d/m/Y H:i', strtotime($taiKhoan->ngay_tao ?? 'now')) ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cập nhật lần cuối</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    <?= date('d/m/Y H:i', strtotime($taiKhoan->ngay_tao ?? 'now')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Summary -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tóm tắt hoạt động</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">0</div>
                            <div class="text-sm text-gray-600">Đặt phòng</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">0</div>
                            <div class="text-sm text-gray-600">Giao dịch</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity (if applicable) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Hoạt động gần đây</h3>
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-history text-4xl mb-3"></i>
            <p>Chưa có hoạt động nào</p>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
