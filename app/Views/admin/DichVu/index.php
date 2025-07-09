<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý Dịch vụ</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Dịch vụ</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-concierge-bell me-1"></i>
            Danh sách Dịch vụ
            <div class="float-end">
                <a href="/admin/dichvu/create" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Thêm dịch vụ
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Tìm kiếm dịch vụ..." id="searchInput">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">Tất cả danh mục</option>
                        <option value="ansung">Ăn uống</option>
                        <option value="giaitat">Giải trí</option>
                        <option value="thetao">Thể thao</option>
                        <option value="spa">Spa & Wellness</option>
                        <option value="khac">Khác</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Tạm dừng</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="priceFilter">
                        <option value="">Tất cả giá</option>
                        <option value="free">Miễn phí</option>
                        <option value="paid">Có phí</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/007bff/ffffff?text=Restaurant" 
                             class="card-img-top" alt="Restaurant Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Nhà hàng cao cấp</h5>
                            <p class="card-text">Thưởng thức các món ăn tinh tế từ đầu bếp 5 sao với view tuyệt đẹp hướng biển.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">500,000 VNĐ/người</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">Ăn uống</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 6:00 - 23:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/1" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/1" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(1)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/28a745/ffffff?text=Spa" 
                             class="card-img-top" alt="Spa Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Spa & Massage</h5>
                            <p class="card-text">Dịch vụ spa thư giãn với các liệu pháp massage truyền thống và hiện đại.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">800,000 VNĐ/90 phút</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-info">Spa & Wellness</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 9:00 - 21:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/2" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/2" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(2)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/ffc107/ffffff?text=Pool" 
                             class="card-img-top" alt="Pool Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Hồ bơi vô cực</h5>
                            <p class="card-text">Hồ bơi ngoài trời với view 360 độ, mở cửa 24/7 cho khách lưu trú.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">Miễn phí</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-warning text-dark">Thể thao</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 24/7
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/3" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/3" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(3)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/6f42c1/ffffff?text=Gym" 
                             class="card-img-top" alt="Gym Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Phòng gym hiện đại</h5>
                            <p class="card-text">Phòng tập gym với trang thiết bị hiện đại và huấn luyện viên cá nhân.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">200,000 VNĐ/ngày</span>
                                    <span class="badge bg-warning text-dark">Tạm dừng</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-warning text-dark">Thể thao</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 6:00 - 22:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/4" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/4" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(4)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/e83e8c/ffffff?text=Transfer" 
                             class="card-img-top" alt="Transfer Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Đưa đón sân bay</h5>
                            <p class="card-text">Dịch vụ đưa đón sân bay 24/7 với xe sang trọng và tài xế chuyên nghiệp.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">1,000,000 VNĐ/chuyến</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary">Khác</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 24/7
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/5" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/5" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(5)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/20c997/ffffff?text=Karaoke" 
                             class="card-img-top" alt="Karaoke Service">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Karaoke VIP</h5>
                            <p class="card-text">Phòng karaoke VIP với âm thanh chất lượng cao và hệ thống đèn hiện đại.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold">300,000 VNĐ/giờ</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success">Giải trí</span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> 19:00 - 02:00
                                    </small>
                                </div>
                                <div class="btn-group w-100" role="group">
                                    <a href="/admin/dichvu/show/6" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/dichvu/edit/6" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteService(6)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Trước</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Sau</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
function deleteService(id) {
    if (confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')) {
        // Ajax delete request here
        console.log('Deleting service with ID: ' + id);
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    // Implement search logic
});

document.getElementById('categoryFilter').addEventListener('change', function() {
    // Implement category filter logic
});

document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filter logic
});

document.getElementById('priceFilter').addEventListener('change', function() {
    // Implement price filter logic
});
</script>
