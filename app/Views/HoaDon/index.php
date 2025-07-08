<?php
$title = 'Quản lý hóa đơn - Hotel Ocean';
ob_start();
?>

<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Quản lý hóa đơn</h1>
                <p class="text-gray-600">Theo dõi và quản lý tất cả hóa đơn đặt phòng</p>
            </div>
            <?php if (auth_can_crud()): ?>
            <div class="flex items-center space-x-4">
                <a href="/hoa-don/create" 
                   class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Tạo hóa đơn
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filters and Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
        <!-- Filter Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-filter text-green-600 mr-2"></i>
                    Bộ lọc
                </h3>
                
                <form method="GET" class="space-y-4">
                    <div>
                        <label for="filter_status" class="block text-sm font-medium text-gray-700 mb-2">
                            Trạng thái
                        </label>
                        <select id="filter_status" 
                                name="status" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Tất cả</option>
                            <option value="pending" <?= ($_GET['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                            <option value="confirmed" <?= ($_GET['status'] ?? '') === 'confirmed' ? 'selected' : '' ?>>Đã xác nhận</option>
                            <option value="paid" <?= ($_GET['status'] ?? '') === 'paid' ? 'selected' : '' ?>>Đã thanh toán</option>
                            <option value="cancelled" <?= ($_GET['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                        </select>
                    </div>

                    <div>
                        <label for="filter_payment" class="block text-sm font-medium text-gray-700 mb-2">
                            Thanh toán
                        </label>
                        <select id="filter_payment" 
                                name="payment_status" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Tất cả</option>
                            <option value="unpaid" <?= ($_GET['payment_status'] ?? '') === 'unpaid' ? 'selected' : '' ?>>Chưa thanh toán</option>
                            <option value="partial" <?= ($_GET['payment_status'] ?? '') === 'partial' ? 'selected' : '' ?>>Thanh toán một phần</option>
                            <option value="paid" <?= ($_GET['payment_status'] ?? '') === 'paid' ? 'selected' : '' ?>>Đã thanh toán</option>
                        </select>
                    </div>

                    <div>
                        <label for="filter_date_from" class="block text-sm font-medium text-gray-700 mb-2">
                            Từ ngày
                        </label>
                        <input type="date" 
                               id="filter_date_from" 
                               name="date_from" 
                               value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div>
                        <label for="filter_date_to" class="block text-sm font-medium text-gray-700 mb-2">
                            Đến ngày
                        </label>
                        <input type="date" 
                               id="filter_date_to" 
                               name="date_to" 
                               value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <button type="submit" 
                            class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-search mr-2"></i>
                        Lọc
                    </button>
                </form>
            </div>
        </div>

        <!-- Statistics -->
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-file-invoice text-xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800"><?= number_format($totalInvoices ?? count($hoaDons ?? [])) ?></h3>
                    <p class="text-gray-600 text-sm">Tổng hóa đơn</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-money-bill-wave text-xl text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800"><?= number_format($totalRevenue ?? 0) ?>đ</h3>
                    <p class="text-gray-600 text-sm">Tổng doanh thu</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-clock text-xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800"><?= number_format($pendingInvoices ?? 0) ?></h3>
                    <p class="text-gray-600 text-sm">Chờ xử lý</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-calendar text-xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $thisMonthInvoices ?? 0 ?></h3>
                    <p class="text-gray-600 text-sm">Tháng này</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Hóa đơn
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Khách hàng
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thời gian
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tổng tiền
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trạng thái
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thanh toán
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($hoaDons) && is_array($hoaDons)): ?>
                        <?php foreach ($hoaDons as $hoaDon): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            #HD<?= str_pad($hoaDon->id ?? 0, 6, '0', STR_PAD_LEFT) ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?= isset($hoaDon->ngay_tao) ? date('d/m/Y H:i', strtotime($hoaDon->ngay_tao)) : 'N/A' ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-white text-sm"></i>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($hoaDon->ten_khach_hang ?? 'N/A') ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?= htmlspecialchars($hoaDon->email ?? 'N/A') ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <i class="fas fa-calendar-check mr-1 text-gray-400"></i>
                                        <?= isset($hoaDon->ngay_nhan_phong) ? date('d/m/Y', strtotime($hoaDon->ngay_nhan_phong)) : 'N/A' ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-calendar-times mr-1 text-gray-400"></i>
                                        <?= isset($hoaDon->ngay_tra_phong) ? date('d/m/Y', strtotime($hoaDon->ngay_tra_phong)) : 'N/A' ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        <?= number_format($hoaDon->tong_tien ?? 0) ?>đ
                                    </div>
                                    <?php if (!empty($hoaDon->giam_gia) && $hoaDon->giam_gia > 0): ?>
                                        <div class="text-sm text-green-600">
                                            <i class="fas fa-tag mr-1"></i>
                                            Giảm <?= number_format($hoaDon->giam_gia) ?>đ
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php
                                        $status = $hoaDon->trang_thai ?? 'pending';
                                        switch ($status) {
                                            case 'confirmed':
                                                echo 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'paid':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'cancelled':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                echo 'bg-yellow-100 text-yellow-800';
                                        }
                                        ?>">
                                        <?php
                                        switch ($status) {
                                            case 'confirmed':
                                                echo 'Đã xác nhận';
                                                break;
                                            case 'paid':
                                                echo 'Đã thanh toán';
                                                break;
                                            case 'cancelled':
                                                echo 'Đã hủy';
                                                break;
                                            default:
                                                echo 'Chờ xử lý';
                                        }
                                        ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?php
                                        $paymentStatus = $hoaDon->trang_thai_thanh_toan ?? 'unpaid';
                                        switch ($paymentStatus) {
                                            case 'paid':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'partial':
                                                echo 'bg-yellow-100 text-yellow-800';
                                                break;
                                            default:
                                                echo 'bg-red-100 text-red-800';
                                        }
                                        ?>">
                                        <?php
                                        switch ($paymentStatus) {
                                            case 'paid':
                                                echo 'Đã thanh toán';
                                                break;
                                            case 'partial':
                                                echo 'Một phần';
                                                break;
                                            default:
                                                echo 'Chưa thanh toán';
                                        }
                                        ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="/hoa-don/<?= $hoaDon->id ?>" 
                                           class="text-green-600 hover:text-green-700 p-2 rounded-lg hover:bg-green-50" 
                                           title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (auth_can_crud()): ?>
                                        <a href="/hoa-don/<?= $hoaDon->id ?>/edit" 
                                           class="text-blue-600 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50"
                                           title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php endif; ?>
                                        <a href="/hoa-don/<?= $hoaDon->id ?>/print" 
                                           class="text-purple-600 hover:text-purple-700 p-2 rounded-lg hover:bg-purple-50"
                                           title="In hóa đơn">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <?php if (auth_can_crud() && ($hoaDon->trang_thai ?? '') !== 'paid'): ?>
                                            <button onclick="deleteInvoice(<?= $hoaDon->id ?>)" 
                                                    class="text-red-600 hover:text-red-700 p-2 rounded-lg hover:bg-red-50"
                                                    title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-file-invoice text-4xl mb-4"></i>
                                    <p class="text-lg">Không có hóa đơn nào</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if (!empty($pagination)): ?>
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-2">
                <?php if ($pagination['current_page'] > 1): ?>
                    <a href="?page=<?= $pagination['current_page'] - 1 ?>" 
                       class="px-3 py-2 text-gray-600 bg-white rounded-lg border hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <a href="?page=<?= $i ?>" 
                       class="px-3 py-2 <?= $i === $pagination['current_page'] ? 'bg-green-500 text-white' : 'text-gray-600 bg-white hover:bg-gray-50' ?> rounded-lg border">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <a href="?page=<?= $pagination['current_page'] + 1 ?>" 
                       class="px-3 py-2 text-gray-600 bg-white rounded-lg border hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    <?php endif; ?>
</div>

<script>
function deleteInvoice(id) {
    if (confirm('Bạn có chắc chắn muốn xóa hóa đơn này? Thao tác này không thể hoàn tác!')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/hoa-don/' + id;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Auto-submit filters on change
document.querySelectorAll('select[name="status"], select[name="payment_status"]').forEach(select => {
    select.addEventListener('change', function() {
        this.form.submit();
    });
});

// Date range validation
document.getElementById('filter_date_to').addEventListener('change', function() {
    const dateFrom = document.getElementById('filter_date_from').value;
    const dateTo = this.value;
    
    if (dateFrom && dateTo && dateTo < dateFrom) {
        alert('Ngày kết thúc phải sau ngày bắt đầu');
        this.value = '';
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
