<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tạo Loại phòng mới</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/loaiphong">Loại phòng</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin Loại phòng</h5>
                </div>
                <div class="card-body">
                    <form action="/admin/loaiphong/store" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="ten_loai" class="form-label">Tên loại phòng *</label>
                            <input type="text" class="form-control" id="ten_loai" name="ten_loai" 
                                   placeholder="VD: Phòng Standard, Deluxe, Suite..." required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gia_phong" class="form-label">Giá phòng/đêm (VNĐ) *</label>
                                    <input type="number" class="form-control" id="gia_phong" name="gia_phong" 
                                           placeholder="800000" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dien_tich" class="form-label">Diện tích (m²)</label>
                                    <input type="number" class="form-control" id="dien_tich" name="dien_tich" 
                                           placeholder="25" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="suc_chua" class="form-label">Sức chứa (người)</label>
                                    <input type="number" class="form-control" id="suc_chua" name="suc_chua" 
                                           placeholder="2" min="1" max="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trang_thai" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="trang_thai" name="trang_thai">
                                        <option value="active" selected>Hoạt động</option>
                                        <option value="inactive">Không hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="mo_ta" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="mo_ta" name="mo_ta" rows="4" 
                                      placeholder="Mô tả chi tiết về loại phòng..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tien_nghi" class="form-label">Tiện nghi</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wifi" name="tien_nghi[]" value="wifi">
                                        <label class="form-check-label" for="wifi">Wi-Fi miễn phí</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dieu_hoa" name="tien_nghi[]" value="dieu_hoa">
                                        <label class="form-check-label" for="dieu_hoa">Điều hòa</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tv" name="tien_nghi[]" value="tv">
                                        <label class="form-check-label" for="tv">TV màn hình phẳng</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="minibar" name="tien_nghi[]" value="minibar">
                                        <label class="form-check-label" for="minibar">Minibar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ban_cong" name="tien_nghi[]" value="ban_cong">
                                        <label class="form-check-label" for="ban_cong">Ban công</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="bep_nho" name="tien_nghi[]" value="bep_nho">
                                        <label class="form-check-label" for="bep_nho">Bếp nhỏ</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="phong_tam_rieng" name="tien_nghi[]" value="phong_tam_rieng">
                                        <label class="form-check-label" for="phong_tam_rieng">Phòng tắm riêng</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="may_say_toc" name="tien_nghi[]" value="may_say_toc">
                                        <label class="form-check-label" for="may_say_toc">Máy sấy tóc</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="room_service" name="tien_nghi[]" value="room_service">
                                        <label class="form-check-label" for="room_service">Room service 24/7</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="hinh_anh" name="hinh_anh[]" multiple accept="image/*">
                            <div class="form-text">Chọn nhiều hình ảnh để tạo gallery cho loại phòng</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/admin/loaiphong" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Tạo loại phòng
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
                            <h6 id="preview-ten" class="card-title">Tên loại phòng</h6>
                            <p id="preview-gia" class="text-success fw-bold">0 VNĐ/đêm</p>
                            <p id="preview-thongtin" class="text-muted">Diện tích: 0m² | Sức chứa: 0 người</p>
                            <p id="preview-mota" class="card-text">Mô tả sẽ hiển thị ở đây...</p>
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
                        <li><i class="fas fa-info-circle text-info"></i> Tên loại phòng nên ngắn gọn và dễ nhớ</li>
                        <li><i class="fas fa-info-circle text-info"></i> Giá phòng tính theo VNĐ/đêm</li>
                        <li><i class="fas fa-info-circle text-info"></i> Chọn tiện nghi phù hợp với loại phòng</li>
                        <li><i class="fas fa-info-circle text-info"></i> Hình ảnh nên có chất lượng cao</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview
function updatePreview() {
    const ten = document.getElementById('ten_loai').value || 'Tên loại phòng';
    const gia = document.getElementById('gia_phong').value || 0;
    const dienTich = document.getElementById('dien_tich').value || 0;
    const sucChua = document.getElementById('suc_chua').value || 0;
    const moTa = document.getElementById('mo_ta').value || 'Mô tả sẽ hiển thị ở đây...';
    
    document.getElementById('preview-ten').textContent = ten;
    document.getElementById('preview-gia').textContent = parseInt(gia).toLocaleString('vi-VN') + ' VNĐ/đêm';
    document.getElementById('preview-thongtin').textContent = `Diện tích: ${dienTich}m² | Sức chứa: ${sucChua} người`;
    document.getElementById('preview-mota').textContent = moTa;
}

document.getElementById('ten_loai').addEventListener('input', updatePreview);
document.getElementById('gia_phong').addEventListener('input', updatePreview);
document.getElementById('dien_tich').addEventListener('input', updatePreview);
document.getElementById('suc_chua').addEventListener('input', updatePreview);
document.getElementById('mo_ta').addEventListener('input', updatePreview);

// Format price input
document.getElementById('gia_phong').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
