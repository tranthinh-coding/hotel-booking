<?php $title = 'Chỉnh sửa đánh giá'; ?>
<?php include_once __DIR__ . '/../layouts/app.php'; ?>

<?php ob_start(); ?>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-slate-600">
            <li><a href="/" class="hover:text-cyan-600 transition-colors">Trang chủ</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="/danh-gia" class="hover:text-cyan-600 transition-colors">Đánh giá</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-slate-800 font-medium">Chỉnh sửa đánh giá</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Chỉnh sửa đánh giá</h1>
        <p class="text-slate-600">Cập nhật thông tin đánh giá từ khách hàng</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="xl:col-span-2">
            <form id="editReviewForm" class="space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Thông tin cơ bản</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="ten_khach_hang" class="block text-sm font-medium text-slate-700 mb-2">
                                    Tên khách hàng <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="ten_khach_hang" name="ten_khach_hang" 
                                       value="<?= htmlspecialchars($danhGia['ten_khach_hang'] ?? 'Nguyễn Văn A') ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" 
                                       value="<?= htmlspecialchars($danhGia['email'] ?? 'nguyenvana@example.com') ?>"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                       required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="phong_id" class="block text-sm font-medium text-slate-700 mb-2">
                                    Phòng <span class="text-red-500">*</span>
                                </label>
                                <select id="phong_id" name="phong_id" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all"
                                        required>
                                    <option value="1" <?= ($danhGia['phong_id'] ?? 1) == 1 ? 'selected' : '' ?>>Phòng Deluxe - P001</option>
                                    <option value="2" <?= ($danhGia['phong_id'] ?? 1) == 2 ? 'selected' : '' ?>>Phòng Premium - P002</option>
                                    <option value="3" <?= ($danhGia['phong_id'] ?? 1) == 3 ? 'selected' : '' ?>>Phòng VIP - P003</option>
                                </select>
                            </div>
                            <div>
                                <label for="trang_thai" class="block text-sm font-medium text-slate-700 mb-2">
                                    Trạng thái
                                </label>
                                <select id="trang_thai" name="trang_thai" 
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                                    <option value="1" <?= ($danhGia['trang_thai'] ?? 1) == 1 ? 'selected' : '' ?>>Đã duyệt</option>
                                    <option value="0" <?= ($danhGia['trang_thai'] ?? 1) == 0 ? 'selected' : '' ?>>Chờ duyệt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Đánh giá chi tiết</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="so_sao" class="block text-sm font-medium text-slate-700 mb-2">
                                        Đánh giá tổng thể <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex items-center space-x-2">
                                        <div class="star-rating" data-rating="<?= $danhGia['so_sao'] ?? 5 ?>">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span class="star cursor-pointer text-2xl text-slate-300 hover:text-yellow-400 transition-colors" data-value="<?= $i ?>">★</span>
                                            <?php endfor; ?>
                                        </div>
                                        <input type="hidden" id="so_sao" name="so_sao" value="<?= $danhGia['so_sao'] ?? 5 ?>" required>
                                        <span class="ml-2 text-sm text-slate-600">(<span id="rating-value"><?= $danhGia['so_sao'] ?? 5 ?></span>/5)</span>
                                    </div>
                                </div>

                                <div>
                                    <label for="sach_se" class="block text-sm font-medium text-slate-700 mb-2">
                                        Sạch sẽ
                                    </label>
                                    <input type="range" id="sach_se" name="sach_se" min="1" max="5" 
                                           value="<?= $danhGia['sach_se'] ?? 5 ?>"
                                           class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer slider">
                                    <div class="flex justify-between text-xs text-slate-500 mt-1">
                                        <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                                    </div>
                                </div>

                                <div>
                                    <label for="tien_nghi" class="block text-sm font-medium text-slate-700 mb-2">
                                        Tiện nghi
                                    </label>
                                    <input type="range" id="tien_nghi" name="tien_nghi" min="1" max="5" 
                                           value="<?= $danhGia['tien_nghi'] ?? 4 ?>"
                                           class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer slider">
                                    <div class="flex justify-between text-xs text-slate-500 mt-1">
                                        <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="dich_vu" class="block text-sm font-medium text-slate-700 mb-2">
                                        Dịch vụ
                                    </label>
                                    <input type="range" id="dich_vu" name="dich_vu" min="1" max="5" 
                                           value="<?= $danhGia['dich_vu'] ?? 5 ?>"
                                           class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer slider">
                                    <div class="flex justify-between text-xs text-slate-500 mt-1">
                                        <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                                    </div>
                                </div>

                                <div>
                                    <label for="vi_tri" class="block text-sm font-medium text-slate-700 mb-2">
                                        Vị trí
                                    </label>
                                    <input type="range" id="vi_tri" name="vi_tri" min="1" max="5" 
                                           value="<?= $danhGia['vi_tri'] ?? 4 ?>"
                                           class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer slider">
                                    <div class="flex justify-between text-xs text-slate-500 mt-1">
                                        <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                                    </div>
                                </div>

                                <div>
                                    <label for="gia_ca" class="block text-sm font-medium text-slate-700 mb-2">
                                        Giá cả
                                    </label>
                                    <input type="range" id="gia_ca" name="gia_ca" min="1" max="5" 
                                           value="<?= $danhGia['gia_ca'] ?? 4 ?>"
                                           class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer slider">
                                    <div class="flex justify-between text-xs text-slate-500 mt-1">
                                        <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Nội dung đánh giá</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="noi_dung" class="block text-sm font-medium text-slate-700 mb-2">
                                Nội dung đánh giá <span class="text-red-500">*</span>
                            </label>
                            <textarea id="noi_dung" name="noi_dung" rows="4" 
                                      class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none transition-all"
                                      placeholder="Nhập nội dung đánh giá từ khách hàng..."
                                      required><?= htmlspecialchars($danhGia['noi_dung'] ?? 'Phòng rất sạch sẽ, thoải mái. Nhân viên phục vụ rất tận tình. Tôi sẽ quay lại lần sau.') ?></textarea>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs text-slate-500">Tối thiểu 10 ký tự</span>
                                <span class="text-xs text-slate-500"><span id="char-count">0</span>/500</span>
                            </div>
                        </div>

                        <div>
                            <label for="phan_hoi" class="block text-sm font-medium text-slate-700 mb-2">
                                Phản hồi từ khách sạn
                            </label>
                            <textarea id="phan_hoi" name="phan_hoi" rows="3" 
                                      class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none transition-all"
                                      placeholder="Nhập phản hồi từ khách sạn (tùy chọn)..."><?= htmlspecialchars($danhGia['phan_hoi'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="/danh-gia/show/<?= $danhGia['id'] ?? 1 ?>" 
                       class="px-6 py-2 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors text-center">
                        Hủy bỏ
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg">
                        Cập nhật đánh giá
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800">Thống kê nhanh</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Đánh giá TB</span>
                        <span class="text-lg font-bold text-green-600">4.2/5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Tổng đánh giá</span>
                        <span class="text-lg font-bold text-slate-800">142</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Đã duyệt</span>
                        <span class="text-lg font-bold text-cyan-600">138</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Chờ duyệt</span>
                        <span class="text-lg font-bold text-yellow-600">4</span>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-200 p-6">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-slate-800 mb-2">Hướng dẫn</h4>
                        <ul class="text-sm text-slate-600 space-y-1">
                            <li>• Kiểm tra thông tin khách hàng</li>
                            <li>• Xác nhận tính chính xác của đánh giá</li>
                            <li>• Phản hồi một cách chuyên nghiệp</li>
                            <li>• Cập nhật trạng thái phù hợp</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.slider::-webkit-slider-thumb {
    appearance: none;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: linear-gradient(135deg, #06b6d4, #3b82f6);
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.slider::-moz-range-thumb {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: linear-gradient(135deg, #06b6d4, #3b82f6);
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Star rating functionality
    const starRating = document.querySelector('.star-rating');
    const stars = starRating.querySelectorAll('.star');
    const ratingInput = document.getElementById('so_sao');
    const ratingValue = document.getElementById('rating-value');
    
    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-slate-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-slate-300');
            }
        });
        ratingInput.value = rating;
        ratingValue.textContent = rating;
    }
    
    // Initialize stars
    updateStars(parseInt(ratingInput.value));
    
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            updateStars(index + 1);
        });
        
        star.addEventListener('mouseenter', () => {
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.remove('text-slate-300');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-slate-300');
                }
            });
        });
    });
    
    starRating.addEventListener('mouseleave', () => {
        updateStars(parseInt(ratingInput.value));
    });

    // Character counter
    const noiDungTextarea = document.getElementById('noi_dung');
    const charCount = document.getElementById('char-count');
    
    function updateCharCount() {
        const count = noiDungTextarea.value.length;
        charCount.textContent = count;
        charCount.parentElement.classList.toggle('text-red-500', count > 500);
    }
    
    noiDungTextarea.addEventListener('input', updateCharCount);
    updateCharCount();

    // Form validation
    const form = document.getElementById('editReviewForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const tenKhachHang = document.getElementById('ten_khach_hang').value.trim();
        const email = document.getElementById('email').value.trim();
        const noiDung = document.getElementById('noi_dung').value.trim();
        
        if (!tenKhachHang || !email || !noiDung) {
            alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
            return;
        }
        
        if (noiDung.length < 10) {
            alert('Nội dung đánh giá phải có ít nhất 10 ký tự!');
            return;
        }
        
        if (noiDung.length > 500) {
            alert('Nội dung đánh giá không được vượt quá 500 ký tự!');
            return;
        }
        
        // Success animation
        const button = form.querySelector('button[type="submit"]');
        button.innerHTML = '<span class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Đang cập nhật...</span>';
        button.disabled = true;
        
        setTimeout(() => {
            alert('Cập nhật đánh giá thành công!');
            window.location.href = '/danh-gia';
        }, 2000);
    });

    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Animation on load
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php echo $content; ?>
