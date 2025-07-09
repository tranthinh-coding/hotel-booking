<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý Loại phòng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Loại phòng</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-bed me-1"></i>
            Danh sách Loại phòng
            <div class="float-end">
                <a href="/admin/loaiphong/create" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Thêm loại phòng
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Tìm kiếm loại phòng..." id="searchInput">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Không hoạt động</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="priceFilter">
                        <option value="">Tất cả giá</option>
                        <option value="under_1m">Dưới 1 triệu</option>
                        <option value="1m_to_2m">1-2 triệu</option>
                        <option value="over_2m">Trên 2 triệu</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/007bff/ffffff?text=Standard+Room" 
                             class="card-img-top" alt="Standard Room">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Phòng Standard</h5>
                            <p class="card-text">Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản, phù hợp cho khách du lịch một mình hoặc cặp đôi.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold fs-5">800,000 VNĐ/đêm</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <small class="text-muted">Diện tích: 25m² | Sức chứa: 2 người</small>
                                <div class="mt-2">
                                    <a href="/admin/loaiphong/show/1" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/loaiphong/edit/1" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRoomType(1)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/28a745/ffffff?text=Deluxe+Room" 
                             class="card-img-top" alt="Deluxe Room">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Phòng Deluxe</h5>
                            <p class="card-text">Phòng cao cấp với view đẹp và không gian rộng rãi, thiết kế hiện đại và sang trọng.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold fs-5">1,500,000 VNĐ/đêm</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <small class="text-muted">Diện tích: 35m² | Sức chứa: 3 người</small>
                                <div class="mt-2">
                                    <a href="/admin/loaiphong/show/2" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/loaiphong/edit/2" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRoomType(2)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/400x250/dc3545/ffffff?text=Suite+Room" 
                             class="card-img-top" alt="Suite Room">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Phòng Suite</h5>
                            <p class="card-text">Phòng hạng sang với không gian sống riêng biệt, phòng tắm đôi và ban công view thành phố.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-success fw-bold fs-5">2,500,000 VNĐ/đêm</span>
                                    <span class="badge bg-success">Hoạt động</span>
                                </div>
                                <small class="text-muted">Diện tích: 50m² | Sức chứa: 4 người</small>
                                <div class="mt-2">
                                    <a href="/admin/loaiphong/show/3" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    <a href="/admin/loaiphong/edit/3" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRoomType(3)">
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
function deleteRoomType(id) {
    if (confirm('Bạn có chắc chắn muốn xóa loại phòng này? Hành động này không thể hoàn tác.')) {
        // Ajax delete request here
        console.log('Deleting room type with ID: ' + id);
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    // Implement search logic
});

document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filter logic
});

document.getElementById('priceFilter').addEventListener('change', function() {
    // Implement price filter logic
});
</script>
