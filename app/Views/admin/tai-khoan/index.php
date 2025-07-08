<?php $title = 'Quản lý tài khoản - Admin'; ?>

<div class="flex-1 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản lý tài khoản</h1>
                    <p class="text-gray-600">Quản lý danh sách tài khoản trong hệ thống</p>
                </div>
                <a href="/admin/tai-khoan/create" class="btn-ocean text-white px-6 py-3 rounded-lg font-medium gentle-hover">
                    <i class="fas fa-plus mr-2"></i>Thêm tài khoản mới
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 soft-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Tổng tài khoản</p>
                        <p class="text-2xl font-bold text-gray-900"><?= count($taiKhoans ?? []) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 soft-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-user-shield text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Quản lý</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?= count(array_filter($taiKhoans ?? [], fn($tk) => $tk->phan_quyen === 'Quản lý')) ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 soft-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <i class="fas fa-user-tie text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Lễ tân</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?= count(array_filter($taiKhoans ?? [], fn($tk) => $tk->phan_quyen === 'Lễ tân')) ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 soft-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <i class="fas fa-user text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Khách hàng</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?= count(array_filter($taiKhoans ?? [], fn($tk) => $tk->phan_quyen === 'Khách hàng')) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl soft-shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách tài khoản</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Họ tên</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số điện thoại</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phân quyền</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($taiKhoans)): ?>
                            <?php foreach ($taiKhoans as $taiKhoan): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($taiKhoan->ma_tai_khoan) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($taiKhoan->ho_ten) ?>&background=0d9488&color=fff&size=40" 
                                                 alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?= htmlspecialchars($taiKhoan->ho_ten) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($taiKhoan->mail) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($taiKhoan->sdt) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php 
                                        $badgeClass = match($taiKhoan->phan_quyen) {
                                            'Quản lý' => 'bg-red-100 text-red-800',
                                            'Lễ tân' => 'bg-yellow-100 text-yellow-800',
                                            default => 'bg-blue-100 text-blue-800'
                                        };
                                        ?>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full <?= $badgeClass ?>">
                                            <?= htmlspecialchars($taiKhoan->phan_quyen) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="/admin/tai-khoan/<?= $taiKhoan->ma_tai_khoan ?>/edit" 
                                               class="text-ocean-600 hover:text-ocean-900 gentle-hover">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="/admin/tai-khoan/<?= $taiKhoan->ma_tai_khoan ?>" 
                                                  class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="text-red-600 hover:text-red-900 gentle-hover">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg">Chưa có tài khoản nào trong hệ thống</p>
                                    <p class="text-sm">Bấm "Thêm tài khoản mới" để tạo tài khoản đầu tiên</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
