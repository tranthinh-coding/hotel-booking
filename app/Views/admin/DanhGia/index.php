<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý Đánh giá</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Đánh giá</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-star me-1"></i>
            Danh sách Đánh giá từ khách hàng
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Tìm kiếm đánh giá..." id="searchInput">
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="ratingFilter">
                        <option value="">Tất cả điểm</option>
                        <option value="5">5 sao</option>
                        <option value="4">4 sao</option>
                        <option value="3">3 sao</option>
                        <option value="2">2 sao</option>
                        <option value="1">1 sao</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="statusFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ duyệt</option>
                        <option value="approved">Đã duyệt</option>
                        <option value="rejected">Từ chối</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="typeFilter">
                        <option value="">Tất cả loại</option>
                        <option value="room">Phòng</option>
                        <option value="service">Dịch vụ</option>
                        <option value="general">Tổng thể</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="dateFilter">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <div class="row text-center">
                            <div class="col-md-2">
                                <h4 class="mb-0">4.6</h4>
                                <small>Điểm trung bình</small>
                            </div>
                            <div class="col-md-2">
                                <h4 class="mb-0">248</h4>
                                <small>Tổng đánh giá</small>
                            </div>
                            <div class="col-md-2">
                                <h4 class="mb-0">15</h4>
                                <small>Chờ duyệt</small>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">5★</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 68%"></div>
                                    </div>
                                    <span>168</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">4★</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-primary" style="width: 22%"></div>
                                    </div>
                                    <span>55</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">3★</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 8%"></div>
                                    </div>
                                    <span>20</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">2★</span>
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-danger" style="width: 2%"></div>
                                    </div>
                                    <span>5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <strong class="me-3">Nguyễn Văn A</strong>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                        <span class="badge bg-success ms-2">Đã duyệt</span>
                                        <small class="text-muted ms-3">15/12/2024 | Phòng Deluxe 201</small>
                                    </div>
                                    <p class="mb-2">Phòng rất sạch sẽ, view đẹp hướng biển. Nhân viên phục vụ nhiệt tình và chuyên nghiệp. Sẽ quay lại lần sau!</p>
                                    <div class="mb-2">
                                        <span class="badge bg-light text-dark me-1">Vệ sinh: 5/5</span>
                                        <span class="badge bg-light text-dark me-1">Dịch vụ: 5/5</span>
                                        <span class="badge bg-light text-dark me-1">Vị trí: 4/5</span>
                                        <span class="badge bg-light text-dark">Giá cả: 4/5</span>
                                    </div>
                                </div>
                                <div class="btn-group-vertical">
                                    <button class="btn btn-sm btn-success" onclick="approveReview(1)">
                                        <i class="fas fa-check"></i> Duyệt
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="rejectReview(1)">
                                        <i class="fas fa-times"></i> Từ chối
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="replyReview(1)">
                                        <i class="fas fa-reply"></i> Phản hồi
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <strong class="me-3">Trần Thị B</strong>
                                        <span class="text-warning">
                                            ★★★★☆
                                        </span>
                                        <span class="badge bg-warning text-dark ms-2">Chờ duyệt</span>
                                        <small class="text-muted ms-3">14/12/2024 | Dịch vụ Spa</small>
                                    </div>
                                    <p class="mb-2">Dịch vụ spa rất tuyệt vời, thư giãn hoàn toàn. Tuy nhiên thời gian chờ hơi lâu. Nhìn chung vẫn hài lòng.</p>
                                    <div class="mb-2">
                                        <span class="badge bg-light text-dark me-1">Chất lượng: 5/5</span>
                                        <span class="badge bg-light text-dark me-1">Thời gian: 3/5</span>
                                        <span class="badge bg-light text-dark">Giá cả: 4/5</span>
                                    </div>
                                </div>
                                <div class="btn-group-vertical">
                                    <button class="btn btn-sm btn-success" onclick="approveReview(2)">
                                        <i class="fas fa-check"></i> Duyệt
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="rejectReview(2)">
                                        <i class="fas fa-times"></i> Từ chối
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="replyReview(2)">
                                        <i class="fas fa-reply"></i> Phản hồi
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <strong class="me-3">Lê Văn C</strong>
                                        <span class="text-warning">
                                            ★★☆☆☆
                                        </span>
                                        <span class="badge bg-danger ms-2">Từ chối</span>
                                        <small class="text-muted ms-3">13/12/2024 | Phòng Standard 105</small>
                                    </div>
                                    <p class="mb-2">Phòng có mùi ẩm mốc, điều hòa không hoạt động tốt. Rất thất vọng với chất lượng dịch vụ.</p>
                                    <div class="mb-2">
                                        <span class="badge bg-light text-dark me-1">Vệ sinh: 2/5</span>
                                        <span class="badge bg-light text-dark me-1">Tiện nghi: 2/5</span>
                                        <span class="badge bg-light text-dark">Dịch vụ: 3/5</span>
                                    </div>
                                    <div class="alert alert-danger p-2 mt-2">
                                        <small><strong>Phản hồi:</strong> Chúng tôi xin lỗi về trải nghiệm không tốt. Đã kiểm tra và sửa chữa phòng 105. Mong quý khách cho cơ hội để cải thiện.</small>
                                    </div>
                                </div>
                                <div class="btn-group-vertical">
                                    <button class="btn btn-sm btn-success" onclick="approveReview(3)">
                                        <i class="fas fa-check"></i> Duyệt
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="rejectReview(3)">
                                        <i class="fas fa-times"></i> Từ chối
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="replyReview(3)">
                                        <i class="fas fa-reply"></i> Phản hồi
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <strong class="me-3">Phạm Thị D</strong>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                        <span class="badge bg-success ms-2">Đã duyệt</span>
                                        <small class="text-muted ms-3">12/12/2024 | Tổng thể</small>
                                    </div>
                                    <p class="mb-2">Lần đầu tiên tôi có trải nghiệm tuyệt vời như vậy! Từ nhận phòng đến check-out đều hoàn hảo. Đặc biệt là bữa sáng rất ngon và đa dạng.</p>
                                    <div class="mb-2">
                                        <span class="badge bg-light text-dark me-1">Tổng thể: 5/5</span>
                                        <span class="badge bg-light text-dark me-1">Ẩm thực: 5/5</span>
                                        <span class="badge bg-light text-dark">Staff: 5/5</span>
                                    </div>
                                    <div class="alert alert-success p-2 mt-2">
                                        <small><strong>Phản hồi:</strong> Cảm ơn quý khách đã dành thời gian đánh giá! Chúng tôi rất vui khi mang lại trải nghiệm tuyệt vời cho quý khách.</small>
                                    </div>
                                </div>
                                <div class="btn-group-vertical">
                                    <button class="btn btn-sm btn-success" onclick="approveReview(4)" disabled>
                                        <i class="fas fa-check"></i> Đã duyệt
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="rejectReview(4)">
                                        <i class="fas fa-times"></i> Từ chối
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="replyReview(4)">
                                        <i class="fas fa-reply"></i> Phản hồi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
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

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Phản hồi đánh giá</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="replyForm">
                    <input type="hidden" id="reviewId">
                    <div class="mb-3">
                        <label for="replyContent" class="form-label">Nội dung phản hồi</label>
                        <textarea class="form-control" id="replyContent" rows="4" 
                                  placeholder="Nhập phản hồi của bạn..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="submitReply()">Gửi phản hồi</button>
            </div>
        </div>
    </div>
</div>

<script>
function approveReview(id) {
    if (confirm('Bạn có chắc chắn muốn duyệt đánh giá này?')) {
        // Ajax request to approve review
        console.log('Approving review with ID: ' + id);
    }
}

function rejectReview(id) {
    if (confirm('Bạn có chắc chắn muốn từ chối đánh giá này?')) {
        // Ajax request to reject review
        console.log('Rejecting review with ID: ' + id);
    }
}

function replyReview(id) {
    document.getElementById('reviewId').value = id;
    document.getElementById('replyContent').value = '';
    new bootstrap.Modal(document.getElementById('replyModal')).show();
}

function submitReply() {
    const reviewId = document.getElementById('reviewId').value;
    const content = document.getElementById('replyContent').value;
    
    if (!content.trim()) {
        alert('Vui lòng nhập nội dung phản hồi!');
        return;
    }
    
    // Ajax request to submit reply
    console.log('Submitting reply for review ID: ' + reviewId);
    console.log('Reply content: ' + content);
    
    // Close modal
    bootstrap.Modal.getInstance(document.getElementById('replyModal')).hide();
}

// Search and filter functionality
document.getElementById('searchInput').addEventListener('input', function() {
    // Implement search logic
});

document.getElementById('ratingFilter').addEventListener('change', function() {
    // Implement rating filter logic
});

document.getElementById('statusFilter').addEventListener('change', function() {
    // Implement status filter logic
});

document.getElementById('typeFilter').addEventListener('change', function() {
    // Implement type filter logic
});

document.getElementById('dateFilter').addEventListener('change', function() {
    // Implement date filter logic
});
</script>
