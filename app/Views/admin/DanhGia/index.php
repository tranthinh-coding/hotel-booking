<?php 
ob_start(); 
$title = 'Quản lý Đánh giá';
?>

<!-- Page Header -->
<div class="mb-8">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Quản lý Đánh giá</h1>
            <nav class="text-sm text-gray-600 mt-2">
                <a href="/admin/dashboard" class="hover:text-blue-600">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-gray-400">Đánh giá</span>
            </nav>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-100 text-yellow-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Điểm trung bình</dt>
                    <dd class="text-2xl font-bold text-yellow-600">4.6/5</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Tổng đánh giá</dt>
                    <dd class="text-2xl font-bold text-blue-600">248</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-orange-100 text-orange-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Chờ duyệt</dt>
                    <dd class="text-2xl font-bold text-orange-600">15</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Đã duyệt</dt>
                    <dd class="text-2xl font-bold text-green-600">233</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Rating Distribution -->
<div class="bg-white rounded-xl shadow-lg p-6 mb-8">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Phân phối đánh giá</h3>
    <div class="space-y-3">
        <div class="flex items-center">
            <span class="text-sm font-medium text-gray-700 w-8">5★</span>
            <div class="flex-1 mx-3">
                <div class="bg-gray-200 rounded-full h-3">
                    <div class="bg-yellow-500 h-3 rounded-full" style="width: 68%"></div>
                </div>
            </div>
            <span class="text-sm text-gray-600">168 (68%)</span>
        </div>
        <div class="flex items-center">
            <span class="text-sm font-medium text-gray-700 w-8">4★</span>
            <div class="flex-1 mx-3">
                <div class="bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-500 h-3 rounded-full" style="width: 22%"></div>
                </div>
            </div>
            <span class="text-sm text-gray-600">55 (22%)</span>
        </div>
        <div class="flex items-center">
            <span class="text-sm font-medium text-gray-700 w-8">3★</span>
            <div class="flex-1 mx-3">
                <div class="bg-gray-200 rounded-full h-3">
                    <div class="bg-yellow-400 h-3 rounded-full" style="width: 8%"></div>
                </div>
            </div>
            <span class="text-sm text-gray-600">20 (8%)</span>
        </div>
        <div class="flex items-center">
            <span class="text-sm font-medium text-gray-700 w-8">2★</span>
            <div class="flex-1 mx-3">
                <div class="bg-gray-200 rounded-full h-3">
                    <div class="bg-red-500 h-3 rounded-full" style="width: 2%"></div>
                </div>
            </div>
            <span class="text-sm text-gray-600">5 (2%)</span>
        </div>
        <div class="flex items-center">
            <span class="text-sm font-medium text-gray-700 w-8">1★</span>
            <div class="flex-1 mx-3">
                <div class="bg-gray-200 rounded-full h-3">
                    <div class="bg-red-600 h-3 rounded-full" style="width: 0%"></div>
                </div>
            </div>
            <span class="text-sm text-gray-600">0 (0%)</span>
        </div>
    </div>
</div>

<!-- Search and Filters -->
<div class="bg-white rounded-xl shadow-lg p-6 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
            <input type="text" 
                   id="searchInput" 
                   placeholder="Tìm kiếm đánh giá..." 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Điểm số</label>
            <select id="ratingFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Tất cả điểm</option>
                <option value="5">5 sao</option>
                <option value="4">4 sao</option>
                <option value="3">3 sao</option>
                <option value="2">2 sao</option>
                <option value="1">1 sao</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
            <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Tất cả trạng thái</option>
                <option value="pending">Chờ duyệt</option>
                <option value="approved">Đã duyệt</option>
                <option value="rejected">Từ chối</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Loại đánh giá</label>
            <select id="typeFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Tất cả loại</option>
                <option value="room">Phòng</option>
                <option value="service">Dịch vụ</option>
                <option value="general">Tổng thể</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ngày đánh giá</label>
            <input type="date" 
                   id="dateFilter" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
    </div>
</div>

<!-- Reviews List -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">

    <div class="p-6">
        <div class="space-y-6" id="reviewsList">
            <!-- Review Item 1 -->
            <div class="border-b border-gray-200 pb-6 last:border-b-0">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-600 font-medium">A</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">Nguyễn Văn A</h4>
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        <span>★★★★★</span>
                                    </div>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Đã duyệt
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">15/12/2024 | Phòng Deluxe 201</p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-3">Phòng rất sạch sẽ, view đẹp hướng biển. Nhân viên phục vụ nhiệt tình và chuyên nghiệp. Sẽ quay lại lần sau!</p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Vệ sinh: 5/5
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Dịch vụ: 5/5
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Vị trí: 4/5
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Giá cả: 4/5
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2 ml-4">
                        <button onclick="approveReview(1)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Duyệt
                        </button>
                        <button onclick="rejectReview(1)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Từ chối
                        </button>
                        <button onclick="replyReview(1)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                            Phản hồi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Review Item 2 -->
            <div class="border-b border-gray-200 pb-6 last:border-b-0">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                    <span class="text-purple-600 font-medium">B</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-900">Trần Thị B</h4>
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        <span>★★★★☆</span>
                                    </div>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Chờ duyệt
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">14/12/2024 | Dịch vụ Spa</p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-3">Dịch vụ spa rất tuyệt vời, thư giãn hoàn toàn. Tuy nhiên thời gian chờ hơi lâu. Nhìn chung vẫn hài lòng.</p>
                        <div class="flex flex-wrap gap-2 mb-3">
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
