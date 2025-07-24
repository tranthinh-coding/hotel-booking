<?php
// Chặn cập nhật nếu hóa đơn đã hủy
$title = 'Chỉnh sửa Hóa đơn #' . $hoaDon->ma_hoa_don . ' - Ocean Pearl Hotel Admin';
$pageTitle = 'Chỉnh sửa Hóa đơn #' . $hoaDon->ma_hoa_don;
$isDisabled = $hoaDon->trang_thai == 'da_huy' || $hoaDon->trang_thai == 'da_tra_phong';

// Lấy thông tin liên quan
$khachHang = $hoaDon->getKhachHang();
$nhanVien = $hoaDon->getNhanVien();
$phongs = $hoaDon->getPhongs();
$dichVus = $hoaDon->getDichVus();

$allPhongs = \HotelBooking\Models\Phong::all();
$allDichVus = \HotelBooking\Models\DichVu::all();

ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/hoa-don" class="hover:text-gray-700">Hóa đơn</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Chỉnh sửa #<?= $hoaDon->ma_hoa_don ?></span>
    </nav>

    <!-- Error Messages -->
    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>
                    <?php 
                    switch($_GET['error']) {
                        case 'invalid_dates':
                            echo 'Thời gian check-in phải trước check-out!';
                            break;
                        case 'room_conflict':
                            echo 'Khung giờ đã có người đặt trong thời gian này!';
                            break;
                        case 'update_failed':
                            echo 'Cập nhật hóa đơn thất bại!';
                            break;
                        default:
                            echo 'Có lỗi xảy ra!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Success Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>Cập nhật hóa đơn thành công!</span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Form -->
    <form method="POST" action="/admin/hoa-don/update?id=<?= $hoaDon->ma_hoa_don ?>" class="space-y-6">
        <input type="hidden" name="id" value="<?= $hoaDon->ma_hoa_don ?>">
        <div id="deletedServicesContainer"></div>
        <?php if ($isDisabled): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-ban mr-2"></i>
                <span>Hóa đơn này đã bị hủy. Bạn không thể chỉnh sửa thông tin!</span>
            </div>
        </div>
        <?php endif; ?>
        <!-- Basic Information -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin cơ bản</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="ma_khach_hang" class="block text-sm font-medium text-gray-700 mb-2">
                        Khách hàng <span class="text-red-500">*</span>
                    </label>
                    <select id="ma_khach_hang" name="ma_khach_hang" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>>
                        <?php foreach($khachHangs as $kh): ?>
                            <option value="<?= $kh->ma_tai_khoan ?>" <?= $kh->ma_tai_khoan == $hoaDon->ma_khach_hang ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kh->ho_ten) ?> - <?= htmlspecialchars($kh->mail) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="ma_nhan_vien" class="block text-sm font-medium text-gray-700 mb-2">
                        Nhân viên xử lý <span class="text-red-500">*</span>
                    </label>
                    <select id="ma_nhan_vien" name="ma_nhan_vien" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>>
                        <?php foreach($nhanViens as $nv): ?>
                            <option value="<?= $nv->ma_tai_khoan ?>" <?= $nv->ma_tai_khoan == $hoaDon->ma_nhan_vien ? 'selected' : '' ?>>
                                <?= htmlspecialchars($nv->ho_ten) ?> - <?= htmlspecialchars($nv->mail) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="trang_thai" class="block text-sm font-medium text-gray-700 mb-2">
                        Trạng thái <span class="text-red-500">*</span>
                    </label>
                    <select id="trang_thai" name="trang_thai" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>>
                        <option value="cho_xu_ly" <?= $hoaDon->trang_thai == 'cho_xu_ly' ? 'selected' : '' ?>>Chờ xử lý</option>
                        <option value="da_xac_nhan" <?= $hoaDon->trang_thai == 'da_xac_nhan' ? 'selected' : '' ?>>Đã xác nhận</option>
                        <option value="da_thanh_toan" <?= $hoaDon->trang_thai == 'da_thanh_toan' ? 'selected' : '' ?>>Đã thanh toán</option>
                        <option value="da_tra_phong" <?= $hoaDon->trang_thai == 'da_tra_phong' ? 'selected' : '' ?>>Đã trả phòng</option>
                        <option value="da_huy" <?= $hoaDon->trang_thai == 'da_huy' ? 'selected' : '' ?>>Đã hủy</option>
                    </select>
                </div>
            </div>
            <div class="mt-6">
                <label for="ghi_chu" class="block text-sm font-medium text-gray-700 mb-2">Ghi chú</label>
                <textarea id="ghi_chu" name="ghi_chu" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Ghi chú thêm về hóa đơn..." <?= $isDisabled ? 'disabled' : '' ?>><?= htmlspecialchars($hoaDon->ghi_chu ?? '') ?></textarea>
            </div>
        </div>

        <!-- Room Management -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Quản lý phòng & dịch vụ</h3>
                <!-- <button type="button" onclick="addRoom()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm phòng
                </button> -->
            </div>
            <div id="roomsContainer">
                <?php if (isNotEmpty($phongs)): ?>
                    <?php foreach ($phongs as $index => $hdPhong): ?>
                        <?php $phong = \HotelBooking\Models\Phong::find($hdPhong->ma_phong); ?>
                        <div class="room-item border border-gray-200 rounded-lg p-4 mb-4">
                            <input type="hidden" name="existing_rooms[<?= $index ?>][ma_hd_phong]" value="<?= $hdPhong->ma_hd_phong ?>">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-medium text-gray-900">
                                    Phòng <?= $phong ? htmlspecialchars($phong->ten_phong) : '#' . $hdPhong->ma_phong ?>
                                </h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phòng <span class="text-red-500">*</span></label>
                                    <select disabled name="existing_rooms[<?= $index ?>][ma_phong]" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>>
                                        <?php foreach($allPhongs as $p): ?>
                                            <option value="<?= $p->ma_phong ?>" <?= $p->ma_phong == $hdPhong->ma_phong ? 'selected' : '' ?> data-price="<?= $p->gia ?>">
                                                <?= htmlspecialchars($p->ten_phong) ?> - <?= number_format($p->gia, 0, ',', '.') ?>₫/giờ
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Check-in <span class="text-red-500">*</span></label>
                                    <input type="datetime-local" name="existing_rooms[<?= $index ?>][check_in]" 
                                           value="<?= date('Y-m-d\TH:i', strtotime($hdPhong->check_in)) ?>" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Check-out <span class="text-red-500">*</span></label>
                                    <input type="datetime-local" name="existing_rooms[<?= $index ?>][check_out]" 
                                           value="<?= date('Y-m-d\TH:i', strtotime($hdPhong->check_out)) ?>" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>>
                                </div>
                            </div>
                            <!-- Dịch vụ cho phòng này -->
                            <?php if (isNotEmpty($dichVus)): ?>
                            <div class="bg-slate-50 rounded-lg p-4 mb-2">
                                <h5 class="font-semibold text-gray-900 mb-2">Dịch vụ bổ sung cho phòng này</h5>
                                <div id="servicesContainer_<?= $index ?>">
                                    <?php foreach ($dichVus as $svcIndex => $hdDichVu): ?>
                                        <?php if ($hdDichVu->ma_hd_phong == $hdPhong->ma_hd_phong): ?>
                                            <?php $dichVu = \HotelBooking\Models\DichVu::find($hdDichVu->ma_dich_vu); ?>
                                            <div class="service-item border border-gray-200 rounded-lg p-2 mb-2">
                                                <input type="hidden" name="existing_services[<?= $svcIndex ?>][ma_hd_dich_vu]" value="<?= $hdDichVu->ma_hd_dich_vu ?>">
                                                <input type="hidden" name="existing_services[<?= $svcIndex ?>][ma_hd_phong]" value="<?= $hdPhong->ma_hd_phong ?>">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Dịch vụ</label>
                                                        <select disabled name="existing_services[<?= $svcIndex ?>][ma_dich_vu]"
                                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>
                                                                onchange="updateTotal()">
                                                            <?php foreach($allDichVus as $dv): ?>
                                                                <option value="<?= $dv->ma_dich_vu ?>" <?= $dv->ma_dich_vu == $hdDichVu->ma_dich_vu ? 'selected' : '' ?> data-price="<?= $dv->gia ?>">
                                                                    <?= htmlspecialchars($dv->ten_dich_vu) ?> - <?= number_format($dv->gia, 0, ',', '.') ?>₫
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng</label>
                                                        <input disabled type="number" name="existing_services[<?= $svcIndex ?>][so_luong]" min="1" 
                                                                value="<?= $hdDichVu->so_luong ?? 1 ?>"
                                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" <?= $isDisabled ? 'disabled' : '' ?>
                                                                onchange="updateTotal()">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Total Preview -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tổng kết</h3>
            <div class="text-sm text-gray-600 mb-4">
                <i class="fas fa-info-circle mr-2"></i>
                Tiền phòng được tính theo giờ thập phân (ví dụ: 2.5 giờ = 2 giờ 30 phút)
            </div>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>Tiền phòng:</span>
                    <span id="roomTotal"><?= number_format(0, 0, ',', '.') ?>₫</span>
                </div>
                <div class="flex justify-between">
                    <span>Tiền dịch vụ:</span>
                    <span id="serviceTotal"><?= number_format(0, 0, ',', '.') ?>₫</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between text-lg font-semibold">
                    <span>Tổng cộng:</span>
                    <span id="grandTotal"><?= number_format($hoaDon->tong_tien, 0, ',', '.') ?>₫</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="/admin/hoa-don/show?id=<?= $hoaDon->ma_hoa_don ?>" 
               class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Hủy
            </a>
            <?php if (!$isDisabled): ?>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-save mr-2"></i>Cập nhật hóa đơn
            </button>
            <?php endif; ?>
        </div>
    </form>
</div>

<script>
let roomIndex = <?= count($phongs) ?>;
let serviceIndex = <?= count($dichVus) ?>;

function updateTotal() {
    let roomTotal = 0;
    let serviceTotal = 0;

    // Calculate room total by hours (to match backend calculation)
    document.querySelectorAll('.room-item').forEach(item => {
        const select = item.querySelector('select[name*="[ma_phong]"]');
        const checkin = item.querySelector('input[name*="[check_in]"]');
        const checkout = item.querySelector('input[name*="[check_out]"]');
        // Nếu là phòng cũ (có input hidden ma_hd_phong) thì lấy giá từ option đã render (giá cũ)
        // Nếu là phòng mới thì lấy giá hiện tại
        if (select && select.value && checkin.value && checkout.value) {
            const price = parseFloat(select.options[select.selectedIndex].dataset.price || 0);
            const checkinDate = new Date(checkin.value);
            const checkoutDate = new Date(checkout.value);
            if (checkinDate < checkoutDate) {
                const timeDiffMs = checkoutDate.getTime() - checkinDate.getTime();
                const hoursExact = Math.max(1, timeDiffMs / (1000 * 60 * 60));
                roomTotal += Math.round(price * hoursExact);
            }
        }
    });

    // Calculate service total
    document.querySelectorAll('.service-item').forEach(item => {
        const select = item.querySelector('select[name*="[ma_dich_vu]"]');
        const quantity = item.querySelector('input[name*="[so_luong]"]');
        // Nếu là dịch vụ cũ (có input hidden ma_hd_dich_vu) thì lấy giá từ option đã render (giá cũ)
        // Nếu là dịch vụ mới thì lấy giá hiện tại
        if (select && select.value && quantity.value) {
            const price = parseFloat(select.options[select.selectedIndex].dataset.price || 0);
            const qty = parseInt(quantity.value || 0);
            serviceTotal += price * qty;
        }
    });

    document.getElementById('roomTotal').textContent = new Intl.NumberFormat('vi-VN').format(roomTotal) + '₫';
    document.getElementById('serviceTotal').textContent = new Intl.NumberFormat('vi-VN').format(serviceTotal) + '₫';
    document.getElementById('grandTotal').textContent = new Intl.NumberFormat('vi-VN').format(roomTotal + serviceTotal) + '₫';
}

document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
