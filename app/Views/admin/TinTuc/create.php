<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tạo Tin tức mới</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/tintuc">Tin tức</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>

    <form action="/admin/tintuc/store" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Nội dung Tin tức</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tieu_de" class="form-label">Tiêu đề *</label>
                            <input type="text" class="form-control" id="tieu_de" name="tieu_de" 
                                   placeholder="Nhập tiêu đề tin tức..." required>
                        </div>

                        <div class="mb-3">
                            <label for="tom_tat" class="form-label">Tóm tắt</label>
                            <textarea class="form-control" id="tom_tat" name="tom_tat" rows="3" 
                                      placeholder="Tóm tắt ngắn gọn về nội dung tin tức..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="noi_dung" class="form-label">Nội dung *</label>
                            <textarea class="form-control" id="noi_dung" name="noi_dung" rows="15" 
                                      placeholder="Viết nội dung chi tiết của tin tức..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh đại diện</label>
                            <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" accept="image/*">
                            <div class="form-text">Chọn hình ảnh đại diện cho tin tức (JPG, PNG, GIF)</div>
                        </div>

                        <div class="mb-3">
                            <label for="hinh_anh_phu" class="form-label">Hình ảnh phụ</label>
                            <input type="file" class="form-control" id="hinh_anh_phu" name="hinh_anh_phu[]" multiple accept="image/*">
                            <div class="form-text">Chọn nhiều hình ảnh để chèn vào nội dung tin tức</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Thông tin xuất bản</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="danh_muc" class="form-label">Danh mục *</label>
                            <select class="form-select" id="danh_muc" name="danh_muc" required>
                                <option value="">-- Chọn danh mục --</option>
                                <option value="khuyenmai">Khuyến mãi</option>
                                <option value="sukien">Sự kiện</option>
                                <option value="tintong">Tin tổng hợp</option>
                                <option value="huongdan">Hướng dẫn</option>
                                <option value="review">Đánh giá</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="trang_thai" class="form-label">Trạng thái</label>
                            <select class="form-select" id="trang_thai" name="trang_thai">
                                <option value="draft">Bản nháp</option>
                                <option value="published">Xuất bản ngay</option>
                                <option value="scheduled">Lên lịch xuất bản</option>
                            </select>
                        </div>

                        <div class="mb-3" id="scheduled_date_group" style="display: none;">
                            <label for="ngay_xuat_ban" class="form-label">Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control" id="ngay_xuat_ban" name="ngay_xuat_ban">
                        </div>

                        <div class="mb-3">
                            <label for="tac_gia" class="form-label">Tác giả</label>
                            <input type="text" class="form-control" id="tac_gia" name="tac_gia" 
                                   value="Admin" placeholder="Tên tác giả">
                        </div>

                        <div class="mb-3">
                            <label for="tu_khoa" class="form-label">Từ khóa (SEO)</label>
                            <input type="text" class="form-control" id="tu_khoa" name="tu_khoa" 
                                   placeholder="khuyến mãi, khách sạn, du lịch">
                            <div class="form-text">Phân cách bằng dấu phẩy</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="noi_bat" name="noi_bat" value="1">
                                <label class="form-check-label" for="noi_bat">
                                    Tin nổi bật
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cho_phep_binh_luan" name="cho_phep_binh_luan" value="1" checked>
                                <label class="form-check-label" for="cho_phep_binh_luan">
                                    Cho phép bình luận
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Preview</h5>
                    </div>
                    <div class="card-body">
                        <div id="preview-card">
                            <h6 id="preview-title">Tiêu đề tin tức</h6>
                            <small class="text-muted">
                                <i class="fas fa-user"></i> <span id="preview-author">Admin</span> |
                                <i class="fas fa-calendar"></i> <span id="preview-date"><?= date('d/m/Y') ?></span>
                            </small>
                            <p id="preview-summary" class="mt-2">Tóm tắt sẽ hiển thị ở đây...</p>
                            <span id="preview-category" class="badge bg-secondary">Chưa chọn danh mục</span>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Lưu tin tức
                            </button>
                            <button type="button" class="btn btn-info" onclick="previewNews()">
                                <i class="fas fa-eye"></i> Xem trước
                            </button>
                            <a href="/admin/tintuc" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Show/hide scheduled date
document.getElementById('trang_thai').addEventListener('change', function() {
    const scheduledGroup = document.getElementById('scheduled_date_group');
    if (this.value === 'scheduled') {
        scheduledGroup.style.display = 'block';
        document.getElementById('ngay_xuat_ban').required = true;
    } else {
        scheduledGroup.style.display = 'none';
        document.getElementById('ngay_xuat_ban').required = false;
    }
});

// Live preview
function updatePreview() {
    const title = document.getElementById('tieu_de').value || 'Tiêu đề tin tức';
    const summary = document.getElementById('tom_tat').value || 'Tóm tắt sẽ hiển thị ở đây...';
    const author = document.getElementById('tac_gia').value || 'Admin';
    const category = document.getElementById('danh_muc').value;
    
    document.getElementById('preview-title').textContent = title;
    document.getElementById('preview-summary').textContent = summary;
    document.getElementById('preview-author').textContent = author;
    
    const categoryNames = {
        'khuyenmai': 'Khuyến mãi',
        'sukien': 'Sự kiện',
        'tintong': 'Tin tổng hợp',
        'huongdan': 'Hướng dẫn',
        'review': 'Đánh giá'
    };
    
    const categoryBadge = document.getElementById('preview-category');
    if (category) {
        categoryBadge.textContent = categoryNames[category];
        categoryBadge.className = 'badge bg-primary';
    } else {
        categoryBadge.textContent = 'Chưa chọn danh mục';
        categoryBadge.className = 'badge bg-secondary';
    }
}

document.getElementById('tieu_de').addEventListener('input', updatePreview);
document.getElementById('tom_tat').addEventListener('input', updatePreview);
document.getElementById('tac_gia').addEventListener('input', updatePreview);
document.getElementById('danh_muc').addEventListener('change', updatePreview);

function previewNews() {
    const title = document.getElementById('tieu_de').value;
    const content = document.getElementById('noi_dung').value;
    
    if (!title || !content) {
        alert('Vui lòng nhập tiêu đề và nội dung để xem trước!');
        return;
    }
    
    // Open preview in new window
    const previewWindow = window.open('', '_blank', 'width=800,height=600');
    previewWindow.document.write(`
        <html>
            <head>
                <title>Preview: ${title}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body>
                <div class="container mt-4">
                    <h1>${title}</h1>
                    <div class="mt-3" style="white-space: pre-wrap;">${content}</div>
                </div>
            </body>
        </html>
    `);
}

// Simple content editor enhancement
document.getElementById('noi_dung').addEventListener('keydown', function(e) {
    if (e.key === 'Tab') {
        e.preventDefault();
        const start = this.selectionStart;
        const end = this.selectionEnd;
        this.value = this.value.substring(0, start) + '\t' + this.value.substring(end);
        this.selectionStart = this.selectionEnd = start + 1;
    }
});
</script>
