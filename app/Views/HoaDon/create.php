<?php $title = 'Tạo hóa đơn mới'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/hoa-don" class="hover:text-cyan-600 transition-colors">Hóa đơn</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Tạo hóa đơn mới</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Tạo hóa đơn mới</h1>
        <p class="text-slate-600">Tạo hóa đơn cho đơn đặt phòng và dịch vụ</p>
    </div>

    <form id="createInvoiceForm" class="space-y-6">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Thông tin khách hàng</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ten_khach_hang" class="block text-sm font-medium text-slate-700 mb-2">
                                    Họ tên khách hàng <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="ten_khach_hang" name="ten_khach_hang" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="Nhập họ tên khách hàng"
                                       required>
                            </div>
                            <div>
                                <label for="email_khach_hang" class="block text-sm font-medium text-slate-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email_khach_hang" name="email_khach_hang" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="email@example.com"
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="sdt_khach_hang" class="block text-sm font-medium text-slate-700 mb-2">
                                    Số điện thoại <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="sdt_khach_hang" name="sdt_khach_hang" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="0123456789"
                                       required>
                            </div>
                            <div>
                                <label for="cccd" class="block text-sm font-medium text-slate-700 mb-2">
                                    CCCD/CMND
                                </label>
                                <input type="text" id="cccd" name="cccd" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="Số CCCD/CMND">
                            </div>
                        </div>

                        <div>
                            <label for="dia_chi_khach_hang" class="block text-sm font-medium text-slate-700 mb-2">
                                Địa chỉ
                            </label>
                            <textarea id="dia_chi_khach_hang" name="dia_chi_khach_hang" rows="2" 
                                      class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none transition-all"
                                      placeholder="Địa chỉ liên hệ"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Thông tin đặt phòng</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ngay_nhan_phong" class="block text-sm font-medium text-slate-700 mb-2">
                                    Ngày nhận phòng <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="ngay_nhan_phong" name="ngay_nhan_phong" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                            <div>
                                <label for="ngay_tra_phong" class="block text-sm font-medium text-slate-700 mb-2">
                                    Ngày trả phòng <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="ngay_tra_phong" name="ngay_tra_phong" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="so_dem" class="block text-sm font-medium text-slate-700 mb-2">
                                    Số đêm
                                </label>
                                <input type="number" id="so_dem" name="so_dem" min="1" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       readonly>
                            </div>
                            <div>
                                <label for="so_khach" class="block text-sm font-medium text-slate-700 mb-2">
                                    Số khách <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="so_khach" name="so_khach" min="1" max="10" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       value="2" required>
                            </div>
                            <div>
                                <label for="so_phong" class="block text-sm font-medium text-slate-700 mb-2">
                                    Số phòng <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="so_phong" name="so_phong" min="1" max="5" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       value="1" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Items -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-slate-800">Chi tiết hóa đơn</h2>
                            <button type="button" id="addItemBtn" 
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-1 rounded-lg text-sm transition-colors">
                                + Thêm dịch vụ
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="invoice-items" class="space-y-4">
                            <!-- Room Item -->
                            <div class="invoice-item bg-slate-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Phòng/Dịch vụ</label>
                                        <select class="item-service w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                                            <option value="">Chọn phòng/dịch vụ</option>
                                            <option value="phong-standard" data-price="1200000">Phòng Standard - 1,200,000₫/đêm</option>
                                            <option value="phong-deluxe" data-price="1500000">Phòng Deluxe - 1,500,000₫/đêm</option>
                                            <option value="phong-premium" data-price="2000000">Phòng Premium - 2,000,000₫/đêm</option>
                                            <option value="phong-vip" data-price="3500000">Phòng VIP - 3,500,000₫/đêm</option>
                                            <option value="spa-massage" data-price="500000">Spa Massage - 500,000₫</option>
                                            <option value="buffet-sang" data-price="200000">Buffet sáng - 200,000₫</option>
                                            <option value="tiec-cuoi" data-price="15000000">Tiệc cưới - 15,000,000₫</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Số lượng</label>
                                        <input type="number" class="item-quantity w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" 
                                               min="1" value="1">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Đơn giá</label>
                                        <input type="text" class="item-price w-full px-3 py-2 border border-slate-300 rounded-lg bg-slate-100" 
                                               readonly placeholder="0₫">
                                    </div>
                                    <div class="flex items-end justify-between">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-slate-700 mb-1">Thành tiền</label>
                                            <input type="text" class="item-total w-full px-3 py-2 border border-slate-300 rounded-lg bg-slate-100" 
                                                   readonly placeholder="0₫">
                                        </div>
                                        <button type="button" class="remove-item ml-2 bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                                            ×
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Thông tin thanh toán</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="phuong_thuc_thanh_toan" class="block text-sm font-medium text-slate-700 mb-2">
                                    Phương thức thanh toán <span class="text-red-500">*</span>
                                </label>
                                <select id="phuong_thuc_thanh_toan" name="phuong_thuc_thanh_toan" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="">Chọn phương thức</option>
                                    <option value="tien_mat">Tiền mặt</option>
                                    <option value="the_tin_dung">Thẻ tín dụng</option>
                                    <option value="the_ghi_no">Thẻ ghi nợ</option>
                                    <option value="chuyen_khoan">Chuyển khoản</option>
                                    <option value="vi_dien_tu">Ví điện tử</option>
                                </select>
                            </div>
                            <div>
                                <label for="trang_thai" class="block text-sm font-medium text-slate-700 mb-2">
                                    Trạng thái <span class="text-red-500">*</span>
                                </label>
                                <select id="trang_thai" name="trang_thai" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="cho_thanh_toan">Chờ thanh toán</option>
                                    <option value="da_thanh_toan">Đã thanh toán</option>
                                    <option value="da_huy">Đã hủy</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ma_giam_gia" class="block text-sm font-medium text-slate-700 mb-2">
                                    Mã giảm giá
                                </label>
                                <div class="flex">
                                    <input type="text" id="ma_giam_gia" name="ma_giam_gia" 
                                           class="flex-1 px-3 py-2 border border-slate-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                           placeholder="Nhập mã giảm giá">
                                    <button type="button" id="checkDiscountBtn" 
                                            class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-r-lg transition-colors">
                                        Áp dụng
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label for="ghi_chu" class="block text-sm font-medium text-slate-700 mb-2">
                                    Ghi chú
                                </label>
                                <input type="text" id="ghi_chu" name="ghi_chu" 
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       placeholder="Ghi chú thêm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="/hoa-don" 
                       class="px-6 py-2 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors text-center">
                        Hủy bỏ
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        Tạo hóa đơn
                    </button>
                </div>
            </div>

            <!-- Sidebar - Summary -->
            <div class="space-y-6">
                <!-- Invoice Summary -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-800">Tóm tắt hóa đơn</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Tạm tính:</span>
                                <span id="subtotal" class="text-slate-800">0₫</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Thuế VAT (10%):</span>
                                <span id="tax" class="text-slate-800">0₫</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Phí dịch vụ (5%):</span>
                                <span id="service-fee" class="text-slate-800">0₫</span>
                            </div>
                            <div class="flex justify-between items-center text-green-600" id="discount-row" style="display: none;">
                                <span>Giảm giá:</span>
                                <span id="discount">0₫</span>
                            </div>
                            <hr class="border-slate-200">
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span class="text-slate-800">Tổng cộng:</span>
                                <span id="total" class="text-cyan-600">0₫</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Add Services -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-800">Dịch vụ thông dụng</h3>
                    </div>
                    <div class="p-6 space-y-2">
                        <button type="button" class="quick-add w-full text-left p-2 rounded-lg border border-slate-200 hover:border-cyan-300 hover:bg-cyan-50 transition-colors" 
                                data-service="spa-massage" data-price="500000">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium">Spa Massage</span>
                                <span class="text-sm text-cyan-600">500,000₫</span>
                            </div>
                        </button>
                        <button type="button" class="quick-add w-full text-left p-2 rounded-lg border border-slate-200 hover:border-cyan-300 hover:bg-cyan-50 transition-colors" 
                                data-service="buffet-sang" data-price="200000">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium">Buffet sáng</span>
                                <span class="text-sm text-cyan-600">200,000₫</span>
                            </div>
                        </button>
                        <button type="button" class="quick-add w-full text-left p-2 rounded-lg border border-slate-200 hover:border-cyan-300 hover:bg-cyan-50 transition-colors" 
                                data-service="phong-deluxe" data-price="1500000">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium">Phòng Deluxe</span>
                                <span class="text-sm text-cyan-600">1,500,000₫</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl border border-yellow-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">💡 Mẹo</h3>
                    <ul class="text-sm text-slate-600 space-y-2">
                        <li>• Kiểm tra thông tin khách hàng kỹ lưỡng</li>
                        <li>• Xác nhận ngày nhận/trả phòng</li>
                        <li>• Áp dụng mã giảm giá nếu có</li>
                        <li>• Chọn phương thức thanh toán phù hợp</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calculate nights automatically
    const checkinInput = document.getElementById('ngay_nhan_phong');
    const checkoutInput = document.getElementById('ngay_tra_phong');
    const nightsInput = document.getElementById('so_dem');

    function calculateNights() {
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        
        if (checkin && checkout && checkout > checkin) {
            const timeDiff = checkout.getTime() - checkin.getTime();
            const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            nightsInput.value = nights;
            updateTotals();
        }
    }

    checkinInput.addEventListener('change', calculateNights);
    checkoutInput.addEventListener('change', calculateNights);

    // Set default dates
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    checkinInput.value = tomorrow.toISOString().split('T')[0];
    
    const dayAfter = new Date();
    dayAfter.setDate(dayAfter.getDate() + 3);
    checkoutInput.value = dayAfter.toISOString().split('T')[0];
    
    calculateNights();

    // Invoice items management
    let itemCounter = 0;

    function addInvoiceItem(service = '', price = '', quantity = 1) {
        const itemsContainer = document.getElementById('invoice-items');
        const newItem = document.createElement('div');
        newItem.className = 'invoice-item bg-slate-50 rounded-lg p-4';
        newItem.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phòng/Dịch vụ</label>
                    <select class="item-service w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                        <option value="">Chọn phòng/dịch vụ</option>
                        <option value="phong-standard" data-price="1200000" ${service === 'phong-standard' ? 'selected' : ''}>Phòng Standard - 1,200,000₫/đêm</option>
                        <option value="phong-deluxe" data-price="1500000" ${service === 'phong-deluxe' ? 'selected' : ''}>Phòng Deluxe - 1,500,000₫/đêm</option>
                        <option value="phong-premium" data-price="2000000" ${service === 'phong-premium' ? 'selected' : ''}>Phòng Premium - 2,000,000₫/đêm</option>
                        <option value="phong-vip" data-price="3500000" ${service === 'phong-vip' ? 'selected' : ''}>Phòng VIP - 3,500,000₫/đêm</option>
                        <option value="spa-massage" data-price="500000" ${service === 'spa-massage' ? 'selected' : ''}>Spa Massage - 500,000₫</option>
                        <option value="buffet-sang" data-price="200000" ${service === 'buffet-sang' ? 'selected' : ''}>Buffet sáng - 200,000₫</option>
                        <option value="tiec-cuoi" data-price="15000000" ${service === 'tiec-cuoi' ? 'selected' : ''}>Tiệc cưới - 15,000,000₫</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Số lượng</label>
                    <input type="number" class="item-quantity w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all" 
                           min="1" value="${quantity}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Đơn giá</label>
                    <input type="text" class="item-price w-full px-3 py-2 border border-slate-300 rounded-lg bg-slate-100" 
                           readonly placeholder="0₫" value="${price ? formatMoney(price) : ''}">
                </div>
                <div class="flex items-end justify-between">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Thành tiền</label>
                        <input type="text" class="item-total w-full px-3 py-2 border border-slate-300 rounded-lg bg-slate-100" 
                               readonly placeholder="0₫">
                    </div>
                    <button type="button" class="remove-item ml-2 bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                        ×
                    </button>
                </div>
            </div>
        `;
        
        itemsContainer.appendChild(newItem);
        bindItemEvents(newItem);
        if (service && price) {
            updateItemTotal(newItem);
        }
        updateTotals();
    }

    function bindItemEvents(item) {
        const serviceSelect = item.querySelector('.item-service');
        const quantityInput = item.querySelector('.item-quantity');
        const priceInput = item.querySelector('.item-price');
        const removeBtn = item.querySelector('.remove-item');

        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            priceInput.value = price ? formatMoney(price) : '';
            updateItemTotal(item);
        });

        quantityInput.addEventListener('input', function() {
            updateItemTotal(item);
        });

        removeBtn.addEventListener('click', function() {
            if (document.querySelectorAll('.invoice-item').length > 1) {
                item.remove();
                updateTotals();
            } else {
                alert('Phải có ít nhất một dịch vụ trong hóa đơn!');
            }
        });
    }

    function updateItemTotal(item) {
        const serviceSelect = item.querySelector('.item-service');
        const quantityInput = item.querySelector('.item-quantity');
        const totalInput = item.querySelector('.item-total');
        
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const quantity = parseFloat(quantityInput.value) || 0;
        
        // For room services, multiply by number of nights
        let finalQuantity = quantity;
        if (serviceSelect.value.includes('phong-')) {
            const nights = parseFloat(nightsInput.value) || 1;
            finalQuantity = quantity * nights;
        }
        
        const total = price * finalQuantity;
        totalInput.value = formatMoney(total);
        
        updateTotals();
    }

    function updateTotals() {
        let subtotal = 0;
        
        document.querySelectorAll('.invoice-item').forEach(item => {
            const totalInput = item.querySelector('.item-total');
            const total = parseFloat(totalInput.value.replace(/[₫,]/g, '')) || 0;
            subtotal += total;
        });
        
        const tax = subtotal * 0.1;
        const serviceFee = subtotal * 0.05;
        const discount = parseFloat(document.getElementById('discount').textContent.replace(/[₫,-]/g, '')) || 0;
        const grandTotal = subtotal + tax + serviceFee - discount;
        
        document.getElementById('subtotal').textContent = formatMoney(subtotal);
        document.getElementById('tax').textContent = formatMoney(tax);
        document.getElementById('service-fee').textContent = formatMoney(serviceFee);
        document.getElementById('total').textContent = formatMoney(grandTotal);
    }

    function formatMoney(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0
        }).format(amount).replace('₫', '₫');
    }

    // Add item button
    document.getElementById('addItemBtn').addEventListener('click', function() {
        addInvoiceItem();
    });

    // Quick add buttons
    document.querySelectorAll('.quick-add').forEach(btn => {
        btn.addEventListener('click', function() {
            const service = this.getAttribute('data-service');
            const price = this.getAttribute('data-price');
            addInvoiceItem(service, price, 1);
        });
    });

    // Discount code
    document.getElementById('checkDiscountBtn').addEventListener('click', function() {
        const code = document.getElementById('ma_giam_gia').value;
        const discountRow = document.getElementById('discount-row');
        const discountSpan = document.getElementById('discount');
        
        if (code) {
            // Simulate discount validation
            let discountAmount = 0;
            switch(code.toUpperCase()) {
                case 'SUMMER20': discountAmount = 200000; break;
                case 'STUDENT': discountAmount = 150000; break;
                case 'VIP': discountAmount = 500000; break;
                default: 
                    alert('Mã giảm giá không hợp lệ!');
                    return;
            }
            
            discountSpan.textContent = '-' + formatMoney(discountAmount);
            discountRow.style.display = 'flex';
            updateTotals();
            alert('Áp dụng mã giảm giá thành công!');
        }
    });

    // Phone number formatting
    document.getElementById('sdt_khach_hang').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 10) value = value.slice(0, 10);
        this.value = value;
    });

    // Form submission
    document.getElementById('createInvoiceForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validation
        const requiredFields = ['ten_khach_hang', 'email_khach_hang', 'sdt_khach_hang', 'ngay_nhan_phong', 'ngay_tra_phong', 'so_khach', 'so_phong', 'phuong_thuc_thanh_toan', 'trang_thai'];
        
        for (let field of requiredFields) {
            if (!document.getElementById(field).value.trim()) {
                alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
                return;
            }
        }
        
        // Check if at least one service is selected
        const selectedServices = document.querySelectorAll('.item-service');
        let hasService = false;
        selectedServices.forEach(select => {
            if (select.value) hasService = true;
        });
        
        if (!hasService) {
            alert('Vui lòng chọn ít nhất một dịch vụ!');
            return;
        }
        
        // Success animation
        const button = this.querySelector('button[type="submit"]');
        button.innerHTML = '<span class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang tạo hóa đơn...</span>';
        button.disabled = true;
        
        setTimeout(() => {
            alert('Tạo hóa đơn thành công!');
            window.location.href = '/hoa-don';
        }, 2000);
    });

    // Initialize first item events
    bindItemEvents(document.querySelector('.invoice-item'));

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
