<?php
$title = 'Tạo Hóa đơn mới - Ocean Pearl Hotel Admin';
$pageTitle = 'Tạo Hóa đơn mới';
ob_start();
?>

<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500">
        <a href="/admin/dashboard" class="hover:text-gray-700">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="/admin/hoa-don" class="hover:text-gray-700">Hóa đơn</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Tạo mới</span>
    </nav>

    <!-- Error Messages -->
    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>
                    <?php 
                    switch($_GET['error']) {
                        case 'missing_customer':
                            echo 'Vui lòng chọn khách hàng!';
                            break;
                        case 'missing_room':
                            echo 'Vui lòng chọn ít nhất một phòng!';
                            break;
                        case 'create_failed':
                            echo 'Tạo hóa đơn thất bại!';
                            break;
                        case 'invalid_dates':
                            $room = $_GET['room'] ?? '';
                            echo 'Thời gian check-in phải trước check-out' . ($room ? " (Phòng $room)" : '') . '!';
                            break;
                        case 'room_conflict':
                            $room = $_GET['room'] ?? '';
                            echo 'Phòng đã có người đặt trong thời gian này' . ($room ? " (Phòng $room)" : '') . '!';
                            break;
                        case 'internal_conflict':
                            $room = $_GET['room'] ?? '';
                            echo 'Thời gian đặt phòng bị xung đột với phòng khác trong cùng hóa đơn' . ($room ? " (Phòng $room)" : '') . '!';
                            break;
                        default:
                            echo 'Có lỗi xảy ra!';
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Form -->
    <form method="POST" action="/admin/hoa-don/store" class="space-y-6">
        <!-- Customer Selection -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin khách hàng</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="ma_khach_hang" class="block text-sm font-medium text-gray-700 mb-2">
                        Khách hàng <span class="text-red-500">*</span>
                    </label>
                    <select id="ma_khach_hang" name="ma_khach_hang" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Chọn khách hàng --</option>
                        <?php if (isNotEmpty($khachHangs)): ?>
                            <?php foreach($khachHangs as $khachHang): ?>
                                <option value="<?= $khachHang->ma_tai_khoan ?>">
                                    <?= htmlspecialchars($khachHang->ho_ten) ?> - <?= htmlspecialchars($khachHang->mail) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label for="ghi_chu" class="block text-sm font-medium text-gray-700 mb-2">Ghi chú</label>
                    <textarea id="ghi_chu" name="ghi_chu" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Ghi chú thêm về hóa đơn..."></textarea>
                </div>
            </div>
        </div>

        <!-- Room Selection -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Chọn phòng</h3>
                <button type="button" onclick="addRoom()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm phòng
                </button>
            </div>
            
            <div id="roomsContainer">
                <div class="room-item border border-gray-200 rounded-lg p-4 mb-4" data-room-index="0">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-medium text-gray-900">Phòng 1</h4>
                        <button type="button" onclick="removeRoom(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phòng <span class="text-red-500">*</span></label>
                            <select name="phongs[0][ma_phong]" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Chọn phòng --</option>
                                <?php if (isNotEmpty($phongs)): ?>
                                    <?php foreach($phongs as $phong): ?>
                                        <option value="<?= $phong->ma_phong ?>" data-price="<?= $phong->gia ?>">
                                            <?= htmlspecialchars($phong->ten_phong) ?> - <?= number_format($phong->gia, 0, ',', '.') ?>₫/giờ
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-in <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="phongs[0][check_in]" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-out <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="phongs[0][check_out]" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <!-- Services for this room -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between items-center mb-3">
                            <h5 class="font-medium text-gray-800">Dịch vụ cho phòng này</h5>
                            <button type="button" onclick="addRoomService(this)" class="bg-indigo-500 text-white px-3 py-1 text-sm rounded hover:bg-indigo-600 transition-colors">
                                <i class="fas fa-plus mr-1"></i>Thêm dịch vụ
                            </button>
                        </div>
                        <div class="room-services-container">
                            <!-- Room services will be added here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Selection (General Services for Invoice) -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Dịch vụ chung cho hóa đơn</h3>
                <button type="button" onclick="addGeneralService()" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm dịch vụ chung
                </button>
            </div>
            
            <div id="generalServicesContainer">
                <!-- General services will be added here -->
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
                    <span id="roomTotal">0₫</span>
                </div>
                <div class="flex justify-between">
                    <span>Tiền dịch vụ:</span>
                    <span id="serviceTotal">0₫</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between text-lg font-semibold">
                    <span>Tổng cộng:</span>
                    <span id="grandTotal">0₫</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="/admin/hoa-don" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Hủy
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-save mr-2"></i>Tạo hóa đơn
            </button>
        </div>
    </form>
</div>

<script>
let roomIndex = 1;
let generalServiceIndex = 0;

function addRoom() {
    const container = document.getElementById('roomsContainer');
    const roomHtml = `
        <div class="room-item border border-gray-200 rounded-lg p-4 mb-4" data-room-index="${roomIndex}">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-medium text-gray-900">Phòng ${roomIndex + 1}</h4>
                <button type="button" onclick="removeRoom(this)" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phòng <span class="text-red-500">*</span></label>
                    <select name="phongs[${roomIndex}][ma_phong]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Chọn phòng --</option>
                        <?php if (isNotEmpty($phongs)): ?>
                            <?php foreach($phongs as $phong): ?>
                                <option value="<?= $phong->ma_phong ?>" data-price="<?= $phong->gia ?>">
                                    <?= htmlspecialchars($phong->ten_phong) ?> - <?= number_format($phong->gia, 0, ',', '.') ?>₫/giờ
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Check-in <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="phongs[${roomIndex}][check_in]" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Check-out <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="phongs[${roomIndex}][check_out]" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            
            <!-- Services for this room -->
            <div class="border-t pt-4">
                <div class="flex justify-between items-center mb-3">
                    <h5 class="font-medium text-gray-800">Dịch vụ cho phòng này</h5>
                    <button type="button" onclick="addRoomService(this)" class="bg-indigo-500 text-white px-3 py-1 text-sm rounded hover:bg-indigo-600 transition-colors">
                        <i class="fas fa-plus mr-1"></i>Thêm dịch vụ
                    </button>
                </div>
                <div class="room-services-container">
                    <!-- Room services will be added here -->
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', roomHtml);
    roomIndex++;
    updateTotal();
}

function removeRoom(button) {
    const roomItem = button.closest('.room-item');
    if (document.querySelectorAll('.room-item').length > 1) {
        roomItem.remove();
        updateTotal();
    } else {
        alert('Phải có ít nhất một phòng!');
    }
}

function addRoomService(button) {
    const roomItem = button.closest('.room-item');
    const roomIndex = roomItem.getAttribute('data-room-index');
    const serviceContainer = roomItem.querySelector('.room-services-container');
    const serviceCount = serviceContainer.children.length;
    
    const serviceHtml = `
        <div class="room-service-item border border-gray-100 rounded p-3 mb-2 bg-gray-50">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-700">Dịch vụ ${serviceCount + 1}</span>
                <button type="button" onclick="removeRoomService(this)" class="text-red-500 hover:text-red-700 text-sm">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <select name="phongs[${roomIndex}][dich_vus][${serviceCount}][ma_dich_vu]"
                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            onchange="updateTotal()">
                        <option value="">-- Chọn dịch vụ --</option>
                        <?php if (isNotEmpty($dichVus)): ?>
                            <?php foreach($dichVus as $dichVu): ?>
                                <option value="<?= $dichVu->ma_dich_vu ?>" data-price="<?= $dichVu->gia ?>">
                                    <?= htmlspecialchars($dichVu->ten_dich_vu) ?> - <?= number_format($dichVu->gia, 0, ',', '.') ?>₫
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <input type="number" name="phongs[${roomIndex}][dich_vus][${serviceCount}][so_luong]" min="1" value="1"
                           class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Số lượng" onchange="updateTotal()">
                </div>
            </div>
        </div>
    `;
    serviceContainer.insertAdjacentHTML('beforeend', serviceHtml);
    updateTotal();
}

function removeRoomService(button) {
    button.closest('.room-service-item').remove();
    updateTotal();
}

function addGeneralService() {
    const container = document.getElementById('generalServicesContainer');
    const serviceHtml = `
        <div class="general-service-item border border-gray-200 rounded-lg p-4 mb-4">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-medium text-gray-900">Dịch vụ chung ${generalServiceIndex + 1}</h4>
                <button type="button" onclick="removeGeneralService(this)" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dịch vụ</label>
                    <select name="dich_vus_chung[${generalServiceIndex}][ma_dich_vu]"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            onchange="updateTotal()">
                        <option value="">-- Chọn dịch vụ --</option>
                        <?php if (isNotEmpty($dichVus)): ?>
                            <?php foreach($dichVus as $dichVu): ?>
                                <option value="<?= $dichVu->ma_dich_vu ?>" data-price="<?= $dichVu->gia ?>">
                                    <?= htmlspecialchars($dichVu->ten_dich_vu) ?> - <?= number_format($dichVu->gia, 0, ',', '.') ?>₫
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Số lượng</label>
                    <input type="number" name="dich_vus_chung[${generalServiceIndex}][so_luong]" min="1" value="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           onchange="updateTotal()">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', serviceHtml);
    generalServiceIndex++;
}

function removeGeneralService(button) {
    button.closest('.general-service-item').remove();
    updateTotal();
}

function updateTotal() {
    let roomTotal = 0;
    let serviceTotal = 0;

    // Calculate room total
    document.querySelectorAll('.room-item').forEach(item => {
        const select = item.querySelector('select[name*="[ma_phong]"]');
        const checkin = item.querySelector('input[name*="[check_in]"]');
        const checkout = item.querySelector('input[name*="[check_out]"]');
        
        if (select.value && checkin.value && checkout.value) {
            const price = parseFloat(select.options[select.selectedIndex].dataset.price || 0);
            const checkinDate = new Date(checkin.value);
            const checkoutDate = new Date(checkout.value);
            
            if (checkinDate < checkoutDate) {
                // Calculate exact hours (decimal) like backend
                const timeDiffMs = checkoutDate.getTime() - checkinDate.getTime();
                const hoursExact = Math.max(1, timeDiffMs / (1000 * 60 * 60));
                
                // Round the total amount (like backend does)
                roomTotal += Math.round(price * hoursExact);
            }
        }
        
        // Calculate room services
        item.querySelectorAll('.room-service-item').forEach(serviceItem => {
            const serviceSelect = serviceItem.querySelector('select[name*="[ma_dich_vu]"]');
            const serviceQuantity = serviceItem.querySelector('input[name*="[so_luong]"]');
            
            if (serviceSelect.value && serviceQuantity.value) {
                const servicePrice = parseFloat(serviceSelect.options[serviceSelect.selectedIndex].dataset.price || 0);
                const serviceQty = parseInt(serviceQuantity.value || 0);
                serviceTotal += servicePrice * serviceQty;
            }
        });
    });

    // Calculate general services
    document.querySelectorAll('.general-service-item').forEach(item => {
        const select = item.querySelector('select[name*="[ma_dich_vu]"]');
        const quantity = item.querySelector('input[name*="[so_luong]"]');
        
        if (select.value && quantity.value) {
            const price = parseFloat(select.options[select.selectedIndex].dataset.price || 0);
            const qty = parseInt(quantity.value || 0);
            serviceTotal += price * qty;
        }
    });

    // Update display
    document.getElementById('roomTotal').textContent = new Intl.NumberFormat('vi-VN').format(roomTotal) + '₫';
    document.getElementById('serviceTotal').textContent = new Intl.NumberFormat('vi-VN').format(serviceTotal) + '₫';
    document.getElementById('grandTotal').textContent = new Intl.NumberFormat('vi-VN').format(roomTotal + serviceTotal) + '₫';
}

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to existing elements
    document.addEventListener('change', updateTotal);
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>
