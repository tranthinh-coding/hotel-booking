<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý Hóa đơn</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Hóa đơn</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách Hóa đơn
            <div class="float-end">
                <a href="/admin/hoadon/create" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Thêm hóa đơn
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Tìm kiếm hóa đơn..." id="searchInput">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="confirmed">Đã xác nhận</option>
                        <option value="paid">Đã thanh toán</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="dateFilter">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Ngày tạo</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Phòng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#HD001</td>
                            <td>Nguyễn Văn A</td>
                            <td>15/12/2024</td>
                            <td class="text-success fw-bold">1,500,000 VNĐ</td>
                            <td><span class="badge bg-success">Đã thanh toán</span></td>
                            <td>Phòng 101 - Deluxe</td>
                            <td>
                                <a href="/admin/hoadon/show/1" class="btn btn-info btn-sm" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/admin/hoadon/edit/1" class="btn btn-warning btn-sm" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteInvoice(1)" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#HD002</td>
                            <td>Trần Thị B</td>
                            <td>14/12/2024</td>
                            <td class="text-success fw-bold">2,000,000 VNĐ</td>
                            <td><span class="badge bg-warning">Chờ xử lý</span></td>
                            <td>Phòng 205 - Suite</td>
                            <td>
                                <a href="/admin/hoadon/show/2" class="btn btn-info btn-sm" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/admin/hoadon/edit/2" class="btn btn-warning btn-sm" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteInvoice(2)" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                        <a class="page-link" href="#">3</a>
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
function deleteInvoice(id) {
    if (confirm('Bạn có chắc chắn muốn xóa hóa đơn này?')) {
        // Ajax delete request here
        console.log('Deleting invoice with ID: ' + id);
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    // Implement search logic
});

document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filter logic
});

document.getElementById('dateFilter').addEventListener('change', function() {
    // Implement date filter logic
});
</script>
