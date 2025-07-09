<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tạo Dịch vụ mới</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/dichvu">Dịch vụ</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin Dịch vụ</h5>
                </div>
                <div class="card-body">
                    <form action="/admin/dichvu/store" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="ten_dich_vu" class="form-label">Tên dịch vụ *</label>
                            <input type="text" class="form-control" id="ten_dich_vu" name="ten_dich_vu" 
                                   placeholder="VD: Nhà hàng cao cấp, Spa & Massage..." required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="danh_muc" class="form-label">Danh mục *</label>
                                    <select class="form-select" id="danh_muc" name="danh_muc" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        <option value="ansung">Ăn uống</option>
                                        <option value="giaitat">Giải trí</option>
                                        <option value="thetao">Thể thao</option>
                                        <option value="spa">Spa & Wellness</option>
                                        <option value="khac">Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trang_thai" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="trang_thai" name="trang_thai">
                                        <option value="active" selected>Hoạt động</option>
                                        <option value="inactive">Tạm dừng</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gia_dich_vu" class="form-label">Giá dịch vụ (VNĐ)</label>
                                    <input type="number" class="form-control" id="gia_dich_vu" name="gia_dich_vu" 
                                           placeholder="0" min="0">
                                    <div class="form-text">Để trống hoặc 0 nếu miễn phí</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="don_vi_tinh" class="form-label">Đơn vị tính</label>
                                    <select class="form-select" id="don_vi_tinh" name="don_vi_tinh">
                                        <option value="lan">Lần</option>
                                        <option value="gio">Giờ</option>
                                        <option value="ngay">Ngày</option>
                                        <option value="nguoi">Người</option>
                                        <option value="chuyen">Chuyến</option>
                                        <option value="buoi">Buổi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="thoi_gian_mo_cua" class="form-label">Thời gian mở cửa</label>
                                    <input type="time" class="form-control" id="thoi_gian_mo_cua" name="thoi_gian_mo_cua">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="thoi_gian_dong_cua" class="form-label">Thời gian đóng cửa</label>
                                    <input type="time" class="form-control" id="thoi_gian_dong_cua" name="thoi_gian_dong_cua">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="mo_ta_ngan" class="form-label">Mô tả ngắn</label>
                            <textarea class="form-control" id="mo_ta_ngan" name="mo_ta_ngan" rows="3" 
                                      placeholder="Mô tả ngắn gọn về dịch vụ..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="mo_ta_chi_tiet" class="form-label">Mô tả chi tiết</label>
                            <textarea class="form-control" id="mo_ta_chi_tiet" name="mo_ta_chi_tiet" rows="6" 
                                      placeholder="Mô tả chi tiết về dịch vụ, bao gồm quy trình, lưu ý..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="dieu_kien_su_dung" class="form-label">Điều kiện sử dụng</label>
                            <textarea class="form-control" id="dieu_kien_su_dung" name="dieu_kien_su_dung" rows="3" 
                                      placeholder="Các điều kiện, quy định khi sử dụng dịch vụ..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="hinh_anh" name="hinh_anh[]" multiple accept="image/*">
                            <div class="form-text">Chọn nhiều hình ảnh để tạo gallery cho dịch vụ</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tùy chọn dịch vụ</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="yeu_cau_dat_truoc" name="yeu_cau_dat_truoc" value="1">
                                        <label class="form-check-label" for="yeu_cau_dat_truoc">
                                            Yêu cầu đặt trước
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="co_san_24_7" name="co_san_24_7" value="1">
                                        <label class="form-check-label" for="co_san_24_7">
                                            Có sẵn 24/7
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="chi_danh_cho_khach_luu_tru" name="chi_danh_cho_khach_luu_tru" value="1">
                                        <label class="form-check-label" for="chi_danh_cho_khach_luu_tru">
                                            Chỉ dành cho khách lưu trú
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="co_phi_huy_bo" name="co_phi_huy_bo" value="1">
                                        <label class="form-check-label" for="co_phi_huy_bo">
                                            Có phí hủy bỏ
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="bao_gom_trong_gia_phong" name="bao_gom_trong_gia_phong" value="1">
                                        <label class="form-check-label" for="bao_gom_trong_gia_phong">
                                            Bao gồm trong giá phòng
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="noi_bat" name="noi_bat" value="1">
                                        <label class="form-check-label" for="noi_bat">
                                            Dịch vụ nổi bật
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/admin/dichvu" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Tạo dịch vụ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Preview</h5>
                </div>
                <div class="card-body">
                    <div id="preview-card" class="card">
                        <div class="card-body">
                            <h6 id="preview-ten" class="card-title">Tên dịch vụ</h6>
                            <p id="preview-gia" class="text-success fw-bold">Miễn phí</p>
                            <p id="preview-mota" class="card-text">Mô tả sẽ hiển thị ở đây...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span id="preview-danh-muc" class="badge bg-secondary">Chưa chọn</span>
                                <small id="preview-gio" class="text-muted">
                                    <i class="fas fa-clock"></i> Chưa cập nhật
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thống kê dịch vụ</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary">0</h4>
                            <small class="text-muted">Lượt đặt hôm nay</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">0</h4>
                            <small class="text-muted">Doanh thu hôm nay</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Hướng dẫn</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-info-circle text-info"></i> Tên dịch vụ nên ngắn gọn và mô tả rõ</li>
                        <li><i class="fas fa-info-circle text-info"></i> Chọn danh mục phù hợp để dễ tìm kiếm</li>
                        <li><i class="fas fa-info-circle text-info"></i> Cập nhật giờ hoạt động chính xác</li>
                        <li><i class="fas fa-info-circle text-info"></i> Hình ảnh nên có chất lượng cao</li>
                        <li><i class="fas fa-info-circle text-info"></i> Mô tả chi tiết giúp khách hiểu rõ dịch vụ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview
function updatePreview() {
    const ten = document.getElementById('ten_dich_vu').value || 'Tên dịch vụ';
    const gia = document.getElementById('gia_dich_vu').value || 0;
    const donVi = document.getElementById('don_vi_tinh').value;
    const moTa = document.getElementById('mo_ta_ngan').value || 'Mô tả sẽ hiển thị ở đây...';
    const danhMuc = document.getElementById('danh_muc').value;
    const gioMo = document.getElementById('thoi_gian_mo_cua').value;
    const gioDong = document.getElementById('thoi_gian_dong_cua').value;
    
    document.getElementById('preview-ten').textContent = ten;
    
    // Update price
    if (parseInt(gia) > 0) {
        document.getElementById('preview-gia').textContent = parseInt(gia).toLocaleString('vi-VN') + ' VNĐ/' + donVi;
    } else {
        document.getElementById('preview-gia').textContent = 'Miễn phí';
    }
    
    document.getElementById('preview-mota').textContent = moTa;
    
    // Update category
    const categoryNames = {
        'ansung': 'Ăn uống',
        'giaitat': 'Giải trí',
        'thetao': 'Thể thao',
        'spa': 'Spa & Wellness',
        'khac': 'Khác'
    };
    
    const categoryBadge = document.getElementById('preview-danh-muc');
    if (danhMuc) {
        categoryBadge.textContent = categoryNames[danhMuc];
        categoryBadge.className = 'badge bg-primary';
    } else {
        categoryBadge.textContent = 'Chưa chọn';
        categoryBadge.className = 'badge bg-secondary';
    }
    
    // Update time
    const timeElement = document.getElementById('preview-gio');
    if (gioMo && gioDong) {
        timeElement.innerHTML = `<i class="fas fa-clock"></i> ${gioMo} - ${gioDong}`;
    } else if (document.getElementById('co_san_24_7').checked) {
        timeElement.innerHTML = `<i class="fas fa-clock"></i> 24/7`;
    } else {
        timeElement.innerHTML = `<i class="fas fa-clock"></i> Chưa cập nhật`;
    }
}

document.getElementById('ten_dich_vu').addEventListener('input', updatePreview);
document.getElementById('gia_dich_vu').addEventListener('input', updatePreview);
document.getElementById('don_vi_tinh').addEventListener('change', updatePreview);
document.getElementById('mo_ta_ngan').addEventListener('input', updatePreview);
document.getElementById('danh_muc').addEventListener('change', updatePreview);
document.getElementById('thoi_gian_mo_cua').addEventListener('change', updatePreview);
document.getElementById('thoi_gian_dong_cua').addEventListener('change', updatePreview);
document.getElementById('co_san_24_7').addEventListener('change', updatePreview);

// Auto-update time when 24/7 is checked
document.getElementById('co_san_24_7').addEventListener('change', function() {
    const moaCuaInput = document.getElementById('thoi_gian_mo_cua');
    const dongCuaInput = document.getElementById('thoi_gian_dong_cua');
    
    if (this.checked) {
        moaCuaInput.disabled = true;
        dongCuaInput.disabled = true;
        moaCuaInput.value = '';
        dongCuaInput.value = '';
    } else {
        moaCuaInput.disabled = false;
        dongCuaInput.disabled = false;
    }
    updatePreview();
});

// Format price input
document.getElementById('gia_dich_vu').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
