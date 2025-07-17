<?php
$title = 'Đặt phòng - Ocean Pearl Hotel';
ob_start();
?>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        background-attachment: fixed;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.012);
    }

    .form-input {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
    }

    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
        outline: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        transition: all 0.3s ease;
        border: none;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        transition: all 0.3s ease;
        border: none;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
    }

    .room-item,
    .service-item {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.3s ease;
        animation: slideInUp 0.5s ease-out;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .room-item:hover,
    .service-item:hover {
        border-color: #3b82f6;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.08);
    }

    .progress-step {
        transition: all 0.3s ease;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .progress-step.active {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
    }

    .progress-line {
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        flex: 1;
        margin: 0 20px;
    }

    .progress-line.active {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .total-card {
        background: rgba(255, 255, 255, 0.95);
        color: #1e293b;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        position: sticky;
        top: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.012);
    }

    .section-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.012);
        transition: all 0.3s ease;
    }

    .section-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .calculating {
        animation: pulse 1s infinite;
    }

    .icon-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>

<!-- Header với Progress Steps -->
<div class="gradient-bg py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Progress Steps -->
        <div class="flex items-center justify-center mb-12">
            <div class="progress-step active">
                <i class="fas fa-user text-lg"></i>
            </div>
            <div class="progress-line active"></div>
            <div class="progress-step">
                <i class="fas fa-bed text-lg"></i>
            </div>
            <div class="progress-line"></div>
            <div class="progress-step">
                <i class="fas fa-concierge-bell text-lg"></i>
            </div>
            <div class="progress-line"></div>
            <div class="progress-step">
                <i class="fas fa-credit-card text-lg"></i>
            </div>
        </div>

        <!-- Page Title -->
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Đặt phòng tại Ocean Pearl
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                Trải nghiệm dịch vụ đẳng cấp với quy trình đặt phòng đơn giản và nhanh chóng
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-20 bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        <?php if (flash_get('success')): ?>
            <div class="glass-effect border-green-200 text-green-800 px-6 py-4 rounded-xl mb-8 flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3 text-lg"></i>
                <div><?= flash_get('success') ?></div>
            </div>
        <?php endif; ?>

        <?php if (flash_get('error')): ?>
            <div class="glass-effect border-red-200 text-red-800 px-6 py-4 rounded-xl mb-8 flex items-center">
                <i class="fas fa-exclamation-circle text-red-600 mr-3 text-lg"></i>
                <div><?= flash_get('error') ?></div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-8">
                <form method="POST" action="/booking/process" id="bookingForm" class="space-y-8">
                    <!-- Customer Information -->
                    <div class="section-card p-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                            <i class="fas fa-user icon-gradient mr-3 text-xl"></i>
                            Thông tin khách hàng
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ho_ten" class="block text-sm font-semibold text-slate-700 mb-3">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="ho_ten" name="ho_ten" required
                                    class="form-input w-full px-4 py-3" placeholder="Nhập họ và tên"
                                    value="<?= htmlspecialchars(old('ho_ten') ?? '') ?>">
                            </div>

                            <div>
                                <label for="so_dien_thoai" class="block text-sm font-semibold text-slate-700 mb-3">
                                    Số điện thoại <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="so_dien_thoai" name="so_dien_thoai" required
                                    class="form-input w-full px-4 py-3" placeholder="Nhập số điện thoại"
                                    value="<?= htmlspecialchars(old('so_dien_thoai') ?? '') ?>">
                            </div>

                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-3">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required class="form-input w-full px-4 py-3"
                                    placeholder="Nhập địa chỉ email"
                                    value="<?= htmlspecialchars(old('email') ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Room Selection -->
                    <div class="section-card p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-slate-800 flex items-center">
                                <i class="fas fa-bed icon-gradient mr-3 text-xl"></i>
                                Chọn phòng
                            </h3>
                            <button type="button" onclick="addRoom()"
                                class="btn-secondary text-white px-6 py-3 rounded-xl font-semibold">
                                <i class="fas fa-plus mr-2"></i>Thêm phòng
                            </button>
                        </div>

                        <div id="roomsContainer">
                            <div class="room-item p-6 mb-6" data-room-index="0">
                                <div class="flex justify-between items-center mb-6">
                                    <h4 class="text-lg font-semibold text-slate-800">Phòng 1</h4>
                                    <button type="button" onclick="removeRoom(this)"
                                        class="text-red-500 hover:text-red-700 text-lg">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-3">
                                            Chọn phòng <span class="text-red-500">*</span>
                                        </label>
                                        <select name="phongs[0][ma_phong]" required onchange="updateRoomPrice(this)"
                                            class="form-input w-full px-4 py-3">
                                            <option value="">-- Chọn phòng --</option>
                                            <?php if ($phong): ?>
                                                <option value="<?= $phong->ma_phong ?>" data-price="<?= $phong->gia ?>"
                                                    selected>
                                                    <?= htmlspecialchars($phong->ten_phong) ?> -
                                                    <?= number_format($phong->gia) ?>₫/giờ
                                                </option>
                                            <?php endif; ?>
                                            <?php if (isset($phongs) && $phongs): ?>
                                                <?php foreach ($phongs as $room): ?>
                                                    <?php if (!$phong || $room->ma_phong != $phong->ma_phong): ?>
                                                        <option value="<?= $room->ma_phong ?>" data-price="<?= $room->gia ?>">
                                                            <?= htmlspecialchars($room->ten_phong) ?> -
                                                            <?= number_format($room->gia) ?>₫/giờ
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-3">
                                            Check-in <span class="text-red-500">*</span>
                                        </label>
                                        <input type="datetime-local" name="phongs[0][check_in]" required
                                            onchange="calculateTotal()" min="<?= date('Y-m-d\TH:i') ?>"
                                            value="<?= htmlspecialchars($bookingData['ngay_nhan_phong'] ?? '') ?>"
                                            class="form-input w-full px-4 py-3">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-3">
                                            Check-out <span class="text-red-500">*</span>
                                        </label>
                                        <input type="datetime-local" name="phongs[0][check_out]" required
                                            onchange="calculateTotal()"
                                            value="<?= htmlspecialchars($bookingData['ngay_tra_phong'] ?? '') ?>"
                                            class="form-input w-full px-4 py-3">
                                    </div>
                                </div>

                                <!-- Services for this room -->
                                <div class="border-t border-slate-200 pt-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h5 class="text-lg font-semibold text-slate-800">Dịch vụ cho phòng này</h5>
                                        <button type="button" onclick="addRoomService(this)"
                                            class="btn-primary text-white px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-plus mr-2"></i>Thêm dịch vụ
                                        </button>
                                    </div>
                                    <div class="room-services-container">
                                        <!-- Room services will be added here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- General Services -->
                    <!-- <div class="section-card p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-slate-800 flex items-center">
                                <i class="fas fa-concierge-bell icon-gradient mr-3 text-xl"></i>
                                Dịch vụ chung
                            </h3>
                            <button type="button" onclick="addGeneralService()"
                                class="btn-primary text-white px-6 py-3 rounded-xl font-semibold">
                                <i class="fas fa-plus mr-2"></i>Thêm dịch vụ
                            </button>
                        </div>

                        <div id="generalServicesContainer">
                            <p class="text-slate-600 text-center py-8">Chưa có dịch vụ chung nào được chọn</p>
                        </div>
                    </div> -->

                    <!-- Special Requests -->
                    <div class="section-card p-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                            <i class="fas fa-comment-alt icon-gradient mr-3 text-xl"></i>
                            Yêu cầu đặc biệt
                        </h3>

                        <textarea id="ghi_chu" name="ghi_chu" rows="4" class="form-input w-full px-4 py-3"
                            placeholder="Nhập các yêu cầu đặc biệt (nếu có)..."><?= htmlspecialchars(old('ghi_chu') ?? '') ?></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="btn-primary text-white px-12 py-4 rounded-xl text-lg font-semibold">
                            <i class="fas fa-credit-card mr-3"></i>
                            Xác nhận đặt phòng
                        </button>
                    </div>
                </form>
            </div>

            <!-- Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="total-card p-8">
                    <h3 class="text-2xl font-bold mb-6 flex items-center text-slate-800">
                        <i class="fas fa-calculator mr-3"></i>
                        Tổng kết đặt phòng
                    </h3>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Tiền phòng:</span>
                            <span class="font-bold text-xl text-slate-800" id="roomTotal">0₫</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600">Tiền dịch vụ:</span>
                            <span class="font-bold text-xl text-slate-800" id="serviceTotal">0₫</span>
                        </div>
                        <hr class="border-slate-200 my-4">
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-slate-800">Tổng cộng:</span>
                            <span class="text-3xl font-bold text-blue-600" id="grandTotal">0₫</span>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-slate-50 border border-slate-200 rounded-xl">
                        <h4 class="font-semibold mb-3 flex items-center text-slate-800">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Cam kết của chúng tôi
                        </h4>
                        <ul class="space-y-2 text-sm text-slate-600">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Miễn phí hủy phòng trong 24h
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Thanh toán bảo mật 100%
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Hỗ trợ 24/7
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['debug'])): ?>
    <div style="background: #000; color: #0f0; padding: 20px; font-family: monospace; white-space: pre;">
        === DEBUG INFO ===

        Rooms data:
        <?= print_r($phongs ?? [], true) ?>

        Services data:
        <?= print_r($dichVus ?? [], true) ?>

        Rooms Array for JS:
        <?= print_r($phongsArray ?? [], true) ?>

        Services Array for JS:
        <?= print_r($dichVusArray ?? [], true) ?>

        JSON Rooms:
        <?= json_encode($phongsArray ?? [], JSON_PRETTY_PRINT) ?>

        JSON Services:
        <?= json_encode($dichVusArray ?? [], JSON_PRETTY_PRINT) ?>
    </div>
<?php endif; ?>

<script>
    let roomIndex = 1;
    let generalServiceIndex = 0;

    // Data from server
    const phongs = <?= json_encode($phongsArray ?? [], JSON_NUMERIC_CHECK) ?>;
    const dichVus = <?= json_encode($dichVusArray ?? [], JSON_NUMERIC_CHECK) ?>;

    console.log('Phongs data:', phongs);
    console.log('DichVus data:', dichVus);

    // Generate room options HTML
    function generateRoomOptions() {
        let options = '<option value="">-- Chọn phòng --</option>';
        phongs.forEach(room => {
            const price = parseFloat(room.gia) || 0;
            options += `<option value="${room.ma_phong}" data-price="${price}">
                        ${room.ten_phong} - ${formatCurrency(price)}/giờ
                    </option>`;
        });
        return options;
    }

    // Generate service options HTML
    function generateServiceOptions() {
        let options = '<option value="">-- Chọn dịch vụ --</option>';
        dichVus.forEach(service => {
            const price = parseFloat(service.gia) || 0;
            options += `<option value="${service.ma_dich_vu}" data-price="${price}">
                        ${service.ten_dich_vu} - ${formatCurrency(price)}
                    </option>`;
        });
        return options;
    }

    // Add new room
    function addRoom() {
        const container = document.getElementById('roomsContainer');
        const minDateTime = new Date().toISOString().slice(0, 16);
        const roomHtml = `
        <div class="room-item p-6 mb-6" data-room-index="${roomIndex}">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-lg font-semibold text-slate-800">Phòng ${roomIndex + 1}</h4>
                <button type="button" onclick="removeRoom(this)" class="text-red-500 hover:text-red-700 text-lg">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        Chọn phòng <span class="text-red-500">*</span>
                    </label>
                    <select name="phongs[${roomIndex}][ma_phong]" required onchange="updateRoomPrice(this)"
                            class="form-input w-full px-4 py-3">
                        ${generateRoomOptions()}
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        Check-in <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" 
                           name="phongs[${roomIndex}][check_in]" 
                           required
                           onchange="calculateTotal()"
                           min="${minDateTime}"
                           class="form-input w-full px-4 py-3">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                        Check-out <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" 
                           name="phongs[${roomIndex}][check_out]" 
                           required
                           onchange="calculateTotal()"
                           class="form-input w-full px-4 py-3">
                </div>
            </div>
            
            <div class="border-t border-slate-200 pt-6">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-lg font-semibold text-slate-800">Dịch vụ cho phòng này</h5>
                    <button type="button" onclick="addRoomService(this)" class="btn-primary text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-plus mr-2"></i>Thêm dịch vụ
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
        updateProgressSteps();
    }

    // Remove room
    function removeRoom(button) {
        const roomItem = button.closest('.room-item');
        const container = document.getElementById('roomsContainer');

        if (container.children.length > 1) {
            roomItem.style.animation = 'slideInUp 0.3s ease-out reverse';
            setTimeout(() => {
                roomItem.remove();
                updateRoomNumbers();
                calculateTotal();
            }, 300);
        } else {
            alert('Phải có ít nhất một phòng!');
        }
    }

    // Update room numbers after removal
    function updateRoomNumbers() {
        const rooms = document.querySelectorAll('.room-item');
        rooms.forEach((room, index) => {
            const title = room.querySelector('h4');
            title.textContent = `Phòng ${index + 1}`;
            room.setAttribute('data-room-index', index);

            // Update input names
            const inputs = room.querySelectorAll('select, input');
            inputs.forEach(input => {
                if (input.name && input.name.includes('phongs[')) {
                    const newName = input.name.replace(/phongs\[\d+\]/, `phongs[${index}]`);
                    input.name = newName;
                }
            });
        });
    }

    // Add room service
    function addRoomService(button) {
        const roomItem = button.closest('.room-item');
        const roomIndex = roomItem.getAttribute('data-room-index');
        const container = roomItem.querySelector('.room-services-container');
        const serviceIndex = container.children.length;

        const serviceHtml = `
        <div class="service-item p-4 mb-4 border border-slate-200 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h6 class="font-medium text-slate-700">Dịch vụ ${serviceIndex + 1}</h6>
                <button type="button" onclick="removeService(this)" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Dịch vụ</label>
                    <select name="phongs[${roomIndex}][dich_vu][${serviceIndex}][ma_dich_vu]" onchange="updateServicePrice(this)"
                            class="form-input w-full px-3 py-2">
                        ${generateServiceOptions()}
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Số lượng</label>
                    <input type="number" name="phongs[${roomIndex}][dich_vu][${serviceIndex}][so_luong]" 
                           value="1" min="1" onchange="calculateTotal()"
                           class="form-input w-full px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Thành tiền</label>
                    <input type="text" readonly class="form-input w-full px-3 py-2 bg-slate-100 service-subtotal"
                           value="0₫">
                </div>
            </div>
        </div>
    `;
        container.insertAdjacentHTML('beforeend', serviceHtml);
    }

    // Add general service
    function addGeneralService() {
        const container = document.getElementById('generalServicesContainer');

        // Remove empty message if exists
        const emptyMessage = container.querySelector('p');
        if (emptyMessage) {
            emptyMessage.remove();
        }

        const serviceHtml = `
        <div class="service-item p-6 mb-6 border border-slate-200 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-lg font-semibold text-slate-800">Dịch vụ chung ${generalServiceIndex + 1}</h5>
                <button type="button" onclick="removeService(this)" class="text-red-500 hover:text-red-700 text-lg">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Dịch vụ</label>
                    <select name="dich_vu_chung[${generalServiceIndex}][ma_dich_vu]" onchange="updateServicePrice(this)"
                            class="form-input w-full px-4 py-3">
                        ${generateServiceOptions()}
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Số lượng</label>
                    <input type="number" name="dich_vu_chung[${generalServiceIndex}][so_luong]" 
                           value="1" min="1" onchange="calculateTotal()"
                           class="form-input w-full px-4 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Thành tiền</label>
                    <input type="text" readonly class="form-input w-full px-4 py-3 bg-slate-100 service-subtotal"
                           value="0₫">
                </div>
            </div>
        </div>
    `;
        container.insertAdjacentHTML('beforeend', serviceHtml);
        generalServiceIndex++;
    }

    // Remove service
    function removeService(button) {
        const serviceItem = button.closest('.service-item');
        serviceItem.style.animation = 'slideInUp 0.3s ease-out reverse';
        setTimeout(() => {
            serviceItem.remove();
            calculateTotal();

            // Check if general services container is empty
            const generalContainer = document.getElementById('generalServicesContainer');
            if (generalContainer.children.length === 0) {
                generalContainer.innerHTML = '<p class="text-slate-600 text-center py-8">Chưa có dịch vụ chung nào được chọn</p>';
            }
        }, 300);
    }

    // Update room price when room selection changes
    function updateRoomPrice(select) {
        console.log('Room selection changed:', select.value);
        calculateTotal();
    }

    // Update service price when service selection changes
    function updateServicePrice(select) {
        console.log('Service selection changed:', select.value);
        const serviceItem = select.closest('.service-item');
        const quantityInput = serviceItem.querySelector('input[name*="so_luong"]');
        const subtotalInput = serviceItem.querySelector('.service-subtotal');

        const priceAttr = select.selectedOptions[0]?.dataset.price;
        const price = priceAttr ? parseFloat(priceAttr) : 0;
        const quantity = parseInt(quantityInput.value) || 1;
        const subtotal = isNaN(price) ? 0 : price * quantity;

        console.log('Service price calculation:', { price, quantity, subtotal });

        subtotalInput.value = formatCurrency(subtotal);
        calculateTotal();
    }

    // Calculate total price
    function calculateTotal() {
        let roomTotal = 0;
        let serviceTotal = 0;

        // Calculate room costs
        document.querySelectorAll('.room-item').forEach(room => {
            const roomSelect = room.querySelector('select[name*="ma_phong"]');
            const checkinInput = room.querySelector('input[name*="check_in"]');
            const checkoutInput = room.querySelector('input[name*="check_out"]');

            if (roomSelect && roomSelect.value && checkinInput && checkinInput.value && checkoutInput && checkoutInput.value) {
                const priceAttr = roomSelect.selectedOptions[0]?.dataset.price;
                const price = priceAttr ? parseFloat(priceAttr) : 0;

                if (!isNaN(price) && price > 0) {
                    const checkin = new Date(checkinInput.value);
                    const checkout = new Date(checkoutInput.value);

                    if (checkin && checkout && !isNaN(checkin.getTime()) && !isNaN(checkout.getTime())) {
                        const timeDiff = checkout.getTime() - checkin.getTime();
                        const hoursExact = Math.max(1, timeDiff / (1000 * 60 * 60)); // Giờ chính xác thập phân
                        const hours = Math.max(1, Math.ceil(timeDiff / (1000 * 60 * 60))); // Giờ hiển thị

                        if (!isNaN(hoursExact) && hoursExact > 0) {
                            roomTotal += Math.round(price * hoursExact); // Tính theo giờ chính xác và làm tròn
                        }
                    }
                }
            }
        });

        // Calculate service costs
        document.querySelectorAll('.service-item').forEach(service => {
            const serviceSelect = service.querySelector('select[name*="ma_dich_vu"]');
            const quantityInput = service.querySelector('input[name*="so_luong"]');

            if (serviceSelect && serviceSelect.value) {
                const priceAttr = serviceSelect.selectedOptions[0]?.dataset.price;
                const price = priceAttr ? parseFloat(priceAttr) : 0;
                const quantity = parseInt(quantityInput.value) || 1;

                if (!isNaN(price) && price > 0 && !isNaN(quantity) && quantity > 0) {
                    serviceTotal += price * quantity;
                }
            }
        });

        const grandTotal = roomTotal + serviceTotal;

        // Update display with safe values
        const roomTotalEl = document.getElementById('roomTotal');
        const serviceTotalEl = document.getElementById('serviceTotal');
        const grandTotalEl = document.getElementById('grandTotal');

        if (roomTotalEl) roomTotalEl.textContent = formatCurrency(isNaN(roomTotal) ? 0 : roomTotal);
        if (serviceTotalEl) serviceTotalEl.textContent = formatCurrency(isNaN(serviceTotal) ? 0 : serviceTotal);
        if (grandTotalEl) {
            grandTotalEl.textContent = formatCurrency(isNaN(grandTotal) ? 0 : grandTotal);

            // Add calculating animation
            grandTotalEl.classList.add('calculating');
            setTimeout(() => {
                grandTotalEl.classList.remove('calculating');
            }, 1000);
        }
    }

    // Format currency - safer version
    function formatCurrency(amount) {
        if (isNaN(amount) || amount === null || amount === undefined) {
            amount = 0;
        }

        try {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(Math.round(amount));
        } catch (error) {
            // Fallback formatting
            return Math.round(amount).toLocaleString('vi-VN') + '₫';
        }
    }

    // Update progress steps
    function updateProgressSteps() {
        const steps = document.querySelectorAll('.progress-step');
        const lines = document.querySelectorAll('.progress-line');

        // Simple progress animation
        steps.forEach((step, index) => {
            if (index <= 1) { // Customer info and rooms are active
                step.classList.add('active');
            }
        });

        lines.forEach((line, index) => {
            if (index === 0) {
                line.classList.add('active');
            }
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function () {
        calculateTotal();
        updateProgressSteps();
    });
</script>

<?php
$content = ob_get_clean();
include 'app/Views/layouts/app.php';
?>