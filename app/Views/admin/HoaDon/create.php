<?php include_once '../layouts/admin.php'; ?>

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
