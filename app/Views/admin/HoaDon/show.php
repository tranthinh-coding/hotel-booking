<?php

use HotelBooking\Enums\TrangThaiHoaDon;

$title = 'Chi tiết Hóa đơn #' . $hoaDon['ma_hoa_don'] . ' - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Hóa đơn #' . $hoaDon['ma_hoa_don'];
$isDisabled = $hoaDon['trang_thai'] == 'da_huy';
// Data is already optimized and included in $hoaDon array from getInvoiceDetails()
// No need to call separate methods since everything is in the array
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/hoa-don" class="hover:text-gray-700">Hóa đơn</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Chi tiết #<?= $hoaDon['ma_hoa_don'] ?></span>
    </nav>

    <!-- Action Buttons -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Chi tiết Hóa đơn #<?= $hoaDon['ma_hoa_don'] ?></h1>
        <div class="flex space-x-3">
            <?php if (!$isDisabled): ?>
                <a href="/admin/hoa-don/edit?id=<?= $hoaDon['ma_hoa_don'] ?>"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                </a>
            <?php endif; ?>
            <a href="/admin/hoa-don"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Quay lại
            </a>
        </div>
    </div>

    <!-- Invoice Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Column -->
        <div class="space-y-6">
            <!-- Invoice Details -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin hóa đơn</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Mã hóa đơn:</span>
                        <span class="font-semibold">#<?= $hoaDon['ma_hoa_don'] ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Thời gian tạo:</span>
                        <span><?= $hoaDon['thoi_gian_dat'] ? date('d/m/Y H:i', strtotime($hoaDon['thoi_gian_dat'])) : 'N/A' ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium                        
                        <?php
                        switch ($hoaDon['trang_thai']) {
                            case 'cho_xu_ly':
                                echo 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'da_xac_nhan':
                                echo 'bg-blue-100 text-blue-800';
                                break;
                            case 'da_thanh_toan':
                                echo 'bg-green-100 text-green-800';
                                break;
                            case 'da_huy':
                                echo 'bg-red-100 text-red-800';
                                break;
                            case 'da_tra_phong':
                                echo 'bg-purple-100 text-purple-800';
                                break;
                            default:
                                echo 'bg-gray-100 text-gray-800';
                        }
                        ?>">
                            <?= TrangThaiHoaDon::getLabel($hoaDon['trang_thai']); ?>
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tổng tiền:</span>
                        <span class="text-xl font-bold text-blue-600">
                            <?= number_format($hoaDon['tong_tien'], 0, ',', '.') ?>₫
                        </span>
                    </div>
                    <?php if (isNotEmpty($hoaDon['ghi_chu'])): ?>
                        <div class="pt-3 border-t">
                            <span class="text-gray-600 block mb-2">Ghi chú:</span>
                            <p class="text-gray-800"><?= htmlspecialchars($hoaDon['ghi_chu']) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Staff Info -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Nhân viên xử lý</h3>
                <?php if (isNotEmpty($hoaDon['ten_nhan_vien'])): ?>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Họ tên:</span>
                            <span class="font-medium"><?= htmlspecialchars($hoaDon['ten_nhan_vien']) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span><?= htmlspecialchars($hoaDon['email_nhan_vien'] ?? 'Chưa cập nhật') ?></span>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Không tìm thấy thông tin nhân viên</p>
                <?php endif; ?>
            </div>

            <!-- Customer Info -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin khách hàng</h3>
                <?php if (isNotEmpty($hoaDon['ten_khach_hang'])): ?>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Họ tên:</span>
                            <span class="font-medium"><?= htmlspecialchars($hoaDon['ten_khach_hang']) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span><?= htmlspecialchars($hoaDon['email_khach_hang'] ?? 'Chưa cập nhật') ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Số điện thoại:</span>
                            <span><?= htmlspecialchars($hoaDon['sdt_khach_hang'] ?? 'Chưa cập nhật') ?></span>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Không tìm thấy thông tin khách hàng</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Room Details -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Chi tiết phòng đặt</h3>
        <?php if (isNotEmpty($hoaDon['rooms_data'])): ?>
            <div class="space-y-4">
                <?php foreach ($hoaDon['rooms_data'] as $room): ?>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-medium text-gray-900">
                                <?= htmlspecialchars($room['ten_phong']) ?>
                            </h4>
                            <span class="text-blue-600 font-semibold">
                                <?= number_format($room['gia_hien_tai'], 0, ',', '.') ?>₫/giờ
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Check-in:</span>
                                <div class="font-medium"><?= date('d/m/Y H:i', strtotime($room['check_in'])) ?></div>
                            </div>
                            <div>
                                <span class="text-gray-600">Check-out:</span>
                                <div class="font-medium"><?= date('d/m/Y H:i', strtotime($room['check_out'])) ?></div>
                            </div>
                        </div>
                        <?php
                        $checkInTime = strtotime($room['check_in']);
                        $checkOutTime = strtotime($room['check_out']);
                        $timeDiffSeconds = $checkOutTime - $checkInTime;
                        $soGioChinhXac = max(1, $timeDiffSeconds / 3600); // Giờ thập phân chính xác
                        $soGioDisplay = max(1, ceil($timeDiffSeconds / 3600)); // Giờ hiển thị (làm tròn lên)
                        $tongTienPhong = round($room['gia_hien_tai'] * $soGioChinhXac); // Tính theo giờ chính xác và làm tròn
                        ?>
                        <div class="mt-3 pt-3 border-t flex justify-between">
                            <div class="text-gray-600">
                                <div><?= number_format($soGioDisplay, 0) ?> giờ</div>
                                <?php if ($soGioDisplay != round($soGioChinhXac, 1)): ?>
                                    <small class="text-xs text-gray-500">(Chính xác: <?= number_format($soGioChinhXac, 1) ?>
                                        giờ)</small>
                                <?php endif; ?>
                            </div>
                            <span class="font-semibold"><?= number_format($tongTienPhong, 0, ',', '.') ?>₫</span>
                        </div>
                        <!-- Dịch vụ bổ sung cho phòng này -->
                        <?php
                        if (isNotEmpty($hoaDon['services_data'])) {
                            $servicesForRoom = array_filter($hoaDon['services_data'], function ($sv) use ($room) {
                                return isset($sv['ma_hd_phong']) && isset($room['ma_hd_phong']) && $sv['ma_hd_phong'] == $room['ma_hd_phong'];
                            });
                            if (!empty($servicesForRoom)) {
                                ?>
                                <div class="mt-4">
                                    <h5 class="font-semibold text-gray-900 mb-2">Dịch vụ bổ sung</h5>
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Dịch vụ</th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Đơn giá</th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Số lượng</th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Thành tiền
                                                    </th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-900">Thời gian</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                <?php foreach ($servicesForRoom as $hdDichVu): ?>
                                                    <tr>
                                                        <td class="px-4 py-2">
                                                            <?= htmlspecialchars($hdDichVu['ten_dich_vu']) ?>
                                                        </td>
                                                        <td class="px-4 py-2">
                                                            <?= number_format($hdDichVu['gia_hien_tai'], 0, ',', '.') ?>₫
                                                        </td>
                                                        <td class="px-4 py-2">
                                                            <?= $hdDichVu['so_luong'] ?? 1 ?>
                                                        </td>
                                                        <td class="px-4 py-2 font-semibold">
                                                            <?= number_format($hdDichVu['gia_hien_tai'] * ($hdDichVu['so_luong'] ?? 1), 0, ',', '.') ?>₫
                                                        </td>
                                                        <td class="px-4 py-2 text-sm text-gray-600">
                                                            <?= $hdDichVu['thoi_gian'] ? date('d/m/Y H:i', strtotime($hdDichVu['thoi_gian'])) : 'N/A' ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Không có phòng nào được đặt</p>
        <?php endif; ?>
    </div>

    <!-- Total Summary -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tổng kết</h3>
        <div class="space-y-2">
            <?php
            $tongTienPhong = 0;
            if (isNotEmpty($hoaDon['rooms_data'])) {
                foreach ($hoaDon['rooms_data'] as $hdPhong) {
                    $checkInTime = strtotime($hdPhong['check_in']);
                    $checkOutTime = strtotime($hdPhong['check_out']);
                    $timeDiffSeconds = $checkOutTime - $checkInTime;
                    $soGioChinhXac = max(1, $timeDiffSeconds / 3600); // Tính theo giờ thập phân chính xác
                    $tongTienPhong += round($hdPhong['gia_hien_tai'] * $soGioChinhXac); // Làm tròn để khớp với backend
                }
            }

            $tongTienDichVu = 0;
            if (isNotEmpty($hoaDon['services_data'])) {
                foreach ($hoaDon['services_data'] as $hdDichVu) {
                    $tongTienDichVu += $hdDichVu['gia_hien_tai'] * ($hdDichVu['so_luong'] ?? 1);
                }
            }

            $tongTienTinhToan = $tongTienPhong + $tongTienDichVu;
            $chenhLech = abs($tongTienTinhToan - $hoaDon['tong_tien']);
            ?>
            <div class="flex justify-between">
                <span>Tiền phòng:</span>
                <span><?= number_format($tongTienPhong, 0, ',', '.') ?>₫</span>
            </div>
            <div class="flex justify-between">
                <span>Tiền dịch vụ:</span>
                <span><?= number_format($tongTienDichVu, 0, ',', '.') ?>₫</span>
            </div>
            <div class="flex justify-between">
                <span>Tổng tính toán:</span>
                <span><?= number_format($tongTienTinhToan, 0, ',', '.') ?>₫</span>
            </div>
            <?php if ($chenhLech > 1): // Chỉ hiển thị nếu chênh lệch lớn hơn 1đ ?>
                <div class="flex justify-between text-sm text-orange-600">
                    <span>Chênh lệch:</span>
                    <span><?= number_format($chenhLech, 0, ',', '.') ?>₫</span>
                </div>
            <?php endif; ?>
            <hr class="my-2">
            <div class="flex justify-between text-lg font-semibold">
                <span>Tổng cộng (DB):</span>
                <span class="text-blue-600"><?= number_format($hoaDon['tong_tien'], 0, ',', '.') ?>₫</span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>