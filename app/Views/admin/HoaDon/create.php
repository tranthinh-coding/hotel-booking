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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin Hóa đơn</h3>
                    <p class="text-sm text-gray-500 mt-1">Tạo hóa đơn mới cho khách hàng</p>
                </div>
                
                <div class="p-6">
                    <form action="/admin/hoa-don" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ma_khach_hang" class="block text-sm font-medium text-gray-700 mb-2">
                                    Khách hàng <span class="text-red-500">*</span>
                                </label>
                                <select id="ma_khach_hang" 
                                        name="ma_khach_hang" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                    <option value="">-- Chọn khách hàng --</option>
                                    <option value="1">Nguyễn Văn A (ID: 1)</option>
                                    <option value="2">Trần Thị B (ID: 2)</option>
                                    <option value="3">Lê Văn C (ID: 3)</option>
                                </select>
                                <p class="mt-1 text-sm text-gray-500">Chọn khách hàng từ danh sách</p>
                            </div>

                            <div>
                                <label for="ma_nhan_vien" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nhân viên <span class="text-red-500">*</span>
                                </label>
                                <select id="ma_nhan_vien" 
                                        name="ma_nhan_vien" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                    <option value="">-- Chọn nhân viên --</option>
                                    <option value="1">Admin (ID: 1)</option>
                                    <option value="2">Nhân viên A (ID: 2)</option>
                                    <option value="3">Nhân viên B (ID: 3)</option>
                                </select>
                                <p class="mt-1 text-sm text-gray-500">Nhân viên tạo hóa đơn</p>
                            </div>
                        </div>

                        <div>
                            <label for="thoi_gian_dat" class="block text-sm font-medium text-gray-700 mb-2">
                                Thời gian đặt <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" 
                                   id="thoi_gian_dat" 
                                   name="thoi_gian_dat" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   value="<?= date('Y-m-d\TH:i') ?>"
                                   required>
                            <p class="mt-1 text-sm text-gray-500">Thời gian khách hàng đặt phòng</p>
                        </div>

                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="/admin/hoa-don" 
                               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Quay lại
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Tạo hóa đơn
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-4">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-eye mr-2 text-blue-600"></i>Xem trước hóa đơn
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="text-center">
                            <div class="text-lg font-semibold text-gray-900">OCEAN PEARL HOTEL</div>
                            <div class="text-sm text-gray-500">HÓA ĐƠN ĐẶT PHÒNG</div>
                        </div>
                        
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Khách hàng:</span>
                                <span id="preview-khach-hang" class="font-medium">Chưa chọn</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nhân viên:</span>
                                <span id="preview-nhan-vien" class="font-medium">Chưa chọn</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Thời gian:</span>
                                <span id="preview-thoi-gian" class="font-medium"><?= date('d/m/Y H:i') ?></span>
                            </div>
                        </div>
                        
                        <div class="text-xs text-gray-500 pt-2 border-t">
                            <p><i class="fas fa-info-circle mr-1"></i>Preview sẽ cập nhật khi bạn chọn thông tin</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="mt-6 bg-yellow-50 rounded-xl border border-yellow-200">
                <div class="px-6 py-4">
                    <h4 class="text-sm font-semibold text-yellow-900 mb-3">
                        <i class="fas fa-info-circle mr-2"></i>Lưu ý
                    </h4>
                    <div class="space-y-2 text-sm text-yellow-800">
                        <div class="flex items-start space-x-2">
                            <span class="text-yellow-500">•</span>
                            <span>Hóa đơn sẽ được tạo với trạng thái mới</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-yellow-500">•</span>
                            <span>Có thể thêm phòng và dịch vụ sau khi tạo</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="text-yellow-500">•</span>
                            <span>Kiểm tra thông tin trước khi lưu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update preview
function updatePreview() {
    const khachHang = document.getElementById('ma_khach_hang');
    const nhanVien = document.getElementById('ma_nhan_vien');
    const thoiGian = document.getElementById('thoi_gian_dat');
    
    // Update customer
    const khachHangText = khachHang.selectedOptions[0]?.text || 'Chưa chọn';
    document.getElementById('preview-khach-hang').textContent = khachHangText;
    
    // Update staff
    const nhanVienText = nhanVien.selectedOptions[0]?.text || 'Chưa chọn';
    document.getElementById('preview-nhan-vien').textContent = nhanVienText;
    
    // Update time
    if (thoiGian.value) {
        const date = new Date(thoiGian.value);
        const formatted = date.toLocaleString('vi-VN', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        document.getElementById('preview-thoi-gian').textContent = formatted;
    }
}

// Add event listeners
document.getElementById('ma_khach_hang').addEventListener('change', updatePreview);
document.getElementById('ma_nhan_vien').addEventListener('change', updatePreview);
document.getElementById('thoi_gian_dat').addEventListener('change', updatePreview);

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const khachHang = document.getElementById('ma_khach_hang').value;
    const nhanVien = document.getElementById('ma_nhan_vien').value;
    const thoiGian = document.getElementById('thoi_gian_dat').value;
    
    if (!khachHang) {
        e.preventDefault();
        alert('Vui lòng chọn khách hàng!');
        document.getElementById('ma_khach_hang').focus();
        return;
    }
    
    if (!nhanVien) {
        e.preventDefault();
        alert('Vui lòng chọn nhân viên!');
        document.getElementById('ma_nhan_vien').focus();
        return;
    }
    
    if (!thoiGian) {
        e.preventDefault();
        alert('Vui lòng chọn thời gian đặt!');
        document.getElementById('thoi_gian_dat').focus();
        return;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang tạo...';
    submitBtn.disabled = true;
    
    // Re-enable if form submission fails
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});

// Initialize preview
updatePreview();
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/admin.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tạo Hóa đơn mới</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/hoadon">Hóa đơn</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin Hóa đơn</h5>
                </div>
                <div class="card-body">
                    <form action="/admin/hoadon/store" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="khach_hang_id" class="form-label">Khách hàng *</label>
                                    <select class="form-select" id="khach_hang_id" name="khach_hang_id" required>
                                        <option value="">-- Chọn khách hàng --</option>
                                        <option value="1">Nguyễn Văn A</option>
                                        <option value="2">Trần Thị B</option>
                                        <option value="3">Lê Văn C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ngay_tao" class="form-label">Ngày tạo *</label>
                                    <input type="date" class="form-control" id="ngay_tao" name="ngay_tao" 
                                           value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ngay_checkin" class="form-label">Ngày check-in *</label>
                                    <input type="date" class="form-control" id="ngay_checkin" name="ngay_checkin" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ngay_checkout" class="form-label">Ngày check-out *</label>
                                    <input type="date" class="form-control" id="ngay_checkout" name="ngay_checkout" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phong_id" class="form-label">Phòng *</label>
                            <select class="form-select" id="phong_id" name="phong_id" required>
                                <option value="">-- Chọn phòng --</option>
                                <option value="1">Phòng 101 - Deluxe (1,500,000 VNĐ/đêm)</option>
                                <option value="2">Phòng 102 - Standard (800,000 VNĐ/đêm)</option>
                                <option value="3">Phòng 201 - Suite (2,500,000 VNĐ/đêm)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="trang_thai" class="form-label">Trạng thái</label>
                            <select class="form-select" id="trang_thai" name="trang_thai">
                                <option value="pending">Chờ xử lý</option>
                                <option value="confirmed">Đã xác nhận</option>
                                <option value="paid">Đã thanh toán</option>
                                <option value="cancelled">Đã hủy</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="ghi_chu" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3" 
                                      placeholder="Ghi chú thêm về hóa đơn..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/admin/hoadon" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Tạo hóa đơn
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tóm tắt</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Số đêm:</label>
                        <p id="so_dem" class="fw-bold">0 đêm</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá phòng/đêm:</label>
                        <p id="gia_phong" class="fw-bold text-primary">0 VNĐ</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tổng tiền phòng:</label>
                        <p id="tong_tien_phong" class="fw-bold text-success">0 VNĐ</p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Tổng hóa đơn:</label>
                        <h4 id="tong_hoa_don" class="text-danger">0 VNĐ</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const phongPrices = {
    '1': 1500000,
    '2': 800000,
    '3': 2500000
};

function calculateTotal() {
    const checkin = document.getElementById('ngay_checkin').value;
    const checkout = document.getElementById('ngay_checkout').value;
    const phongId = document.getElementById('phong_id').value;
    
    if (checkin && checkout && phongId) {
        const startDate = new Date(checkin);
        const endDate = new Date(checkout);
        const timeDiff = endDate.getTime() - startDate.getTime();
        const soDem = Math.ceil(timeDiff / (1000 * 3600 * 24));
        
        if (soDem > 0) {
            const giaPhong = phongPrices[phongId];
            const tongTien = soDem * giaPhong;
            
            document.getElementById('so_dem').textContent = soDem + ' đêm';
            document.getElementById('gia_phong').textContent = giaPhong.toLocaleString('vi-VN') + ' VNĐ';
            document.getElementById('tong_tien_phong').textContent = tongTien.toLocaleString('vi-VN') + ' VNĐ';
            document.getElementById('tong_hoa_don').textContent = tongTien.toLocaleString('vi-VN') + ' VNĐ';
        }
    }
}

document.getElementById('ngay_checkin').addEventListener('change', calculateTotal);
document.getElementById('ngay_checkout').addEventListener('change', calculateTotal);
document.getElementById('phong_id').addEventListener('change', calculateTotal);

// Ensure checkout date is after checkin date
document.getElementById('ngay_checkin').addEventListener('change', function() {
    const checkinDate = this.value;
    const checkoutInput = document.getElementById('ngay_checkout');
    checkoutInput.min = checkinDate;
    
    if (checkoutInput.value && checkoutInput.value <= checkinDate) {
        checkoutInput.value = '';
    }
});
</script>
