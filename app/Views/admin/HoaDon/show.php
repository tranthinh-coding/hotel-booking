<?php
$title = 'Chi tiết Hóa đơn #' . $hoaDon->ma_hoa_don . ' - Ocean Pearl Hotel Admin';
$pageTitle = 'Chi tiết Hóa đơn #' . $hoaDon->ma_hoa_don;

// Lấy thông tin liên quan
$khachHang = $hoaDon->getKhachHang();
$nhanVien = $hoaDon->getNhanVien();
$phongs = $hoaDon->getPhongs();
$dichVus = $hoaDon->getDichVus();

ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/hoa-don" class="hover:text-gray-700">Hóa đơn</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Chi tiết #<?= $hoaDon->ma_hoa_don ?></span>
    </nav>

    <!-- Action Buttons -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Chi tiết Hóa đơn #<?= $hoaDon->ma_hoa_don ?></h1>
        <div class="flex space-x-3">
            <a href="/admin/hoa-don/edit?id=<?= $hoaDon->ma_hoa_don ?>" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>Chỉnh sửa
            </a>
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
                        <span class="font-semibold">#<?= $hoaDon->ma_hoa_don ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Thời gian tạo:</span>
                        <span><?= date('d/m/Y H:i', strtotime($hoaDon->thoi_gian_dat)) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Trạng thái:</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            <?php
                            switch($hoaDon->trang_thai) {
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
                                default:
                                    echo 'bg-gray-100 text-gray-800';
                            }
                            ?>">
                            <?php
                            switch($hoaDon->trang_thai) {
                                case 'cho_xu_ly':
                                    echo 'Chờ xử lý';
                                    break;
                                case 'da_xac_nhan':
                                    echo 'Đã xác nhận';
                                    break;
                                case 'da_thanh_toan':
                                    echo 'Đã thanh toán';
                                    break;
                                case 'da_huy':
                                    echo 'Đã hủy';
                                    break;
                                default:
                                    echo ucfirst(str_replace('_', ' ', $hoaDon->trang_thai));
                            }
                            ?>
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tổng tiền:</span>
                        <span class="text-xl font-bold text-blue-600">
                            <?= number_format($hoaDon->tong_tien, 0, ',', '.') ?>₫
                        </span>
                    </div>
                    <?php if (!empty($hoaDon->ghi_chu)): ?>
                    <div class="pt-3 border-t">
                        <span class="text-gray-600 block mb-2">Ghi chú:</span>
                        <p class="text-gray-800"><?= htmlspecialchars($hoaDon->ghi_chu) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin khách hàng</h3>
                <?php if ($khachHang): ?>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Họ tên:</span>
                        <span class="font-medium"><?= htmlspecialchars($khachHang->ho_ten) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span><?= htmlspecialchars($khachHang->mail) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Số điện thoại:</span>
                        <span><?= htmlspecialchars($khachHang->sdt ?? 'Chưa cập nhật') ?></span>
                    </div>
                </div>
                <?php else: ?>
                <p class="text-gray-500">Không tìm thấy thông tin khách hàng</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Staff Info -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Nhân viên xử lý</h3>
                <?php if ($nhanVien): ?>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Họ tên:</span>
                        <span class="font-medium"><?= htmlspecialchars($nhanVien->ho_ten) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span><?= htmlspecialchars($nhanVien->mail) ?></span>
                    </div>
                </div>
                <?php else: ?>
                <p class="text-gray-500">Không tìm thấy thông tin nhân viên</p>
                <?php endif; ?>
            </div>

            <!-- Room Details -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Chi tiết phòng đặt</h3>
                <?php if (!empty($phongs)): ?>
                <div class="space-y-4">
                    <?php foreach ($phongs as $hdPhong): ?>
                        <?php $phong = \HotelBooking\Models\Phong::find($hdPhong->ma_phong); ?>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="font-medium text-gray-900">
                                    <?= $phong ? htmlspecialchars($phong->ten_phong) : 'Phòng #' . $hdPhong->ma_phong ?>
                                </h4>
                                <span class="text-blue-600 font-semibold">
                                    <?= number_format($hdPhong->gia ?? ($phong->gia ?? 0), 0, ',', '.') ?>₫/giờ
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Check-in:</span>
                                    <div class="font-medium"><?= date('d/m/Y H:i', strtotime($hdPhong->check_in)) ?></div>
                                </div>
                                <div>
                                    <span class="text-gray-600">Check-out:</span>
                                    <div class="font-medium"><?= date('d/m/Y H:i', strtotime($hdPhong->check_out)) ?></div>
                                </div>
                            </div>
                            <?php 
                            $soGio = ceil((strtotime($hdPhong->check_out) - strtotime($hdPhong->check_in)) / 3600);
                            $tongTienPhong = ($hdPhong->gia ?? ($phong->gia ?? 0)) * $soGio;
                            ?>
                            <div class="mt-3 pt-3 border-t flex justify-between">
                                <span class="text-gray-600"><?= number_format($soGio, 0) ?> giờ</span>
                                <span class="font-semibold"><?= number_format($tongTienPhong, 0, ',', '.') ?>₫</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-gray-500">Không có phòng nào được đặt</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Services -->
    <?php if (!empty($dichVus)): ?>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Dịch vụ bổ sung</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-900">Dịch vụ</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-900">Đơn giá</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-900">Số lượng</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-900">Thành tiền</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-900">Thời gian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($dichVus as $hdDichVu): ?>
                        <?php $dichVu = \HotelBooking\Models\DichVu::find($hdDichVu->ma_dich_vu); ?>
                        <tr>
                            <td class="px-4 py-3">
                                <?= $dichVu ? htmlspecialchars($dichVu->ten_dich_vu) : 'Dịch vụ #' . $hdDichVu->ma_dich_vu ?>
                            </td>
                            <td class="px-4 py-3">
                                <?= number_format($hdDichVu->gia ?? ($dichVu->gia ?? 0), 0, ',', '.') ?>₫
                            </td>
                            <td class="px-4 py-3">
                                <?= $hdDichVu->so_luong ?? 1 ?>
                            </td>
                            <td class="px-4 py-3 font-semibold">
                                <?= number_format(($hdDichVu->gia ?? ($dichVu->gia ?? 0)) * ($hdDichVu->so_luong ?? 1), 0, ',', '.') ?>₫
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                <?= $hdDichVu->thoi_gian ? date('d/m/Y H:i', strtotime($hdDichVu->thoi_gian)) : 'N/A' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- Total Summary -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tổng kết</h3>
        <div class="space-y-2">
            <?php
            $tongTienPhong = 0;
            foreach ($phongs as $hdPhong) {
                $phong = \HotelBooking\Models\Phong::find($hdPhong->ma_phong);
                $soNgay = (strtotime($hdPhong->check_out) - strtotime($hdPhong->check_in)) / (60 * 60 * 24);
                $tongTienPhong += ($hdPhong->gia ?? ($phong->gia ?? 0)) * $soNgay;
            }
            
            $tongTienDichVu = 0;
            foreach ($dichVus as $hdDichVu) {
                $dichVu = \HotelBooking\Models\DichVu::find($hdDichVu->ma_dich_vu);
                $tongTienDichVu += ($hdDichVu->gia ?? ($dichVu->gia ?? 0)) * ($hdDichVu->so_luong ?? 1);
            }
            ?>
            <div class="flex justify-between">
                <span>Tiền phòng:</span>
                <span><?= number_format($tongTienPhong, 0, ',', '.') ?>₫</span>
            </div>
            <div class="flex justify-between">
                <span>Tiền dịch vụ:</span>
                <span><?= number_format($tongTienDichVu, 0, ',', '.') ?>₫</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between text-lg font-semibold">
                <span>Tổng cộng:</span>
                <span class="text-blue-600"><?= number_format($hoaDon->tong_tien, 0, ',', '.') ?>₫</span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
