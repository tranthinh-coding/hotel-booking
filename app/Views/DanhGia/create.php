<?php
$title = 'Viết đánh giá - Hotel Ocean';
ob_start();
?>

<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-full flex items-center justify-center">
                <i class="fas fa-star text-2xl text-white"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Viết đánh giá</h1>
                <p class="text-gray-600">Chia sẻ trải nghiệm của bạn với Hotel Ocean</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="/danh-gia" method="POST" class="space-y-8">
            <!-- Rating -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    Đánh giá của bạn
                </h3>
                
                <div class="text-center">
                    <label class="block text-sm font-medium text-gray-700 mb-4">
                        Bạn đánh giá dịch vụ của chúng tôi bao nhiêu sao?
                    </label>
                    
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <label for="rating_<?= $i ?>" class="cursor-pointer">
                                <input type="radio" 
                                       id="rating_<?= $i ?>" 
                                       name="diem_danh_gia" 
                                       value="<?= $i ?>" 
                                       class="hidden rating-input"
                                       <?= (old('diem_danh_gia') == $i) ? 'checked' : '' ?>
                                       required>
                                <i class="fas fa-star text-4xl rating-star text-gray-300 hover:text-yellow-400 transition-colors"></i>
                            </label>
                        <?php endfor; ?>
                    </div>
                    
                    <div id="rating-text" class="text-lg font-medium text-gray-600 min-h-[28px]"></div>
                </div>
            </div>

            <!-- Review Type -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-tag text-yellow-500 mr-2"></i>
                    Loại đánh giá
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" 
                               name="loai_danh_gia" 
                               value="tong_quat" 
                               class="hidden review-type-input"
                               <?= (old('loai_danh_gia') === 'tong_quat') ? 'checked' : '' ?>
                               required>
                        <div class="review-type-card p-6 border-2 border-gray-200 rounded-xl text-center transition-all hover:border-yellow-400">
                            <i class="fas fa-hotel text-3xl text-gray-400 mb-3"></i>
                            <h4 class="font-semibold text-gray-800">Tổng quát</h4>
                            <p class="text-sm text-gray-600 mt-2">Đánh giá chung về khách sạn</p>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input type="radio" 
                               name="loai_danh_gia" 
                               value="phong" 
                               class="hidden review-type-input"
                               <?= (old('loai_danh_gia') === 'phong') ? 'checked' : '' ?>>
                        <div class="review-type-card p-6 border-2 border-gray-200 rounded-xl text-center transition-all hover:border-yellow-400">
                            <i class="fas fa-bed text-3xl text-gray-400 mb-3"></i>
                            <h4 class="font-semibold text-gray-800">Phòng nghỉ</h4>
                            <p class="text-sm text-gray-600 mt-2">Đánh giá về phòng đã ở</p>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input type="radio" 
                               name="loai_danh_gia" 
                               value="dich_vu" 
                               class="hidden review-type-input"
                               <?= (old('loai_danh_gia') === 'dich_vu') ? 'checked' : '' ?>>
                        <div class="review-type-card p-6 border-2 border-gray-200 rounded-xl text-center transition-all hover:border-yellow-400">
                            <i class="fas fa-concierge-bell text-3xl text-gray-400 mb-3"></i>
                            <h4 class="font-semibold text-gray-800">Dịch vụ</h4>
                            <p class="text-sm text-gray-600 mt-2">Đánh giá dịch vụ đã sử dụng</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Specific Item Selection (shown when room or service is selected) -->
            <div id="specific-selection" class="hidden">
                <div id="room-selection" class="hidden">
                    <label for="phong_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-bed mr-1"></i> Chọn phòng
                    </label>
                    <select id="phong_id" 
                            name="phong_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        <option value="">Chọn phòng bạn đã ở</option>
                        <?php if (!empty($phongs)): ?>
                            <?php foreach ($phongs as $phong): ?>
                                <option value="<?= $phong->id ?>" <?= old('phong_id') == $phong->id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($phong->ten_phong) ?> - <?= htmlspecialchars($phong->so_phong) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div id="service-selection" class="hidden">
                    <label for="dich_vu_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-concierge-bell mr-1"></i> Chọn dịch vụ
                    </label>
                    <select id="dich_vu_id" 
                            name="dich_vu_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        <option value="">Chọn dịch vụ bạn đã sử dụng</option>
                        <?php if (!empty($dichVus)): ?>
                            <?php foreach ($dichVus as $dichVu): ?>
                                <option value="<?= $dichVu->id ?>" <?= old('dich_vu_id') == $dichVu->id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($dichVu->ten_dich_vu) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Review Content -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-comment text-yellow-500 mr-2"></i>
                    Nội dung đánh giá
                </h3>
                
                <div>
                    <label for="noi_dung" class="block text-sm font-medium text-gray-700 mb-2">
                        Chia sẻ chi tiết về trải nghiệm của bạn *
                    </label>
                    <textarea id="noi_dung" 
                              name="noi_dung" 
                              rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all"
                              required
                              placeholder="Hãy chia sẻ chi tiết về trải nghiệm của bạn. Điều gì làm bạn hài lòng? Có điều gì cần cải thiện không?"><?= htmlspecialchars(old('noi_dung') ?? '') ?></textarea>
                    <p class="text-sm text-gray-500 mt-2">Tối thiểu 50 ký tự. Đánh giá chi tiết sẽ giúp khách hàng khác và giúp chúng tôi cải thiện dịch vụ.</p>
                </div>
            </div>

            <!-- Additional Information -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">
                    <i class="fas fa-info-circle text-yellow-500 mr-2"></i>
                    Thông tin bổ sung
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="ho_ten" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-1"></i> Tên hiển thị
                        </label>
                        <input type="text" 
                               id="ho_ten" 
                               name="ho_ten" 
                               value="<?= htmlspecialchars(old('ho_ten') ?: (user()->ho_ten ?? '')) ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all"
                               placeholder="Tên sẽ hiển thị với đánh giá">
                    </div>

                    <div>
                        <label for="ngay_trai_nghiem" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-1"></i> Ngày trải nghiệm
                        </label>
                        <input type="date" 
                               id="ngay_trai_nghiem" 
                               name="ngay_trai_nghiem" 
                               value="<?= htmlspecialchars(old('ngay_trai_nghiem') ?? '') ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all"
                               max="<?= date('Y-m-d') ?>">
                    </div>
                </div>
            </div>

            <!-- Privacy Options -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h4 class="font-semibold text-gray-800 mb-4">
                    <i class="fas fa-shield-alt text-yellow-500 mr-2"></i>
                    Tùy chọn hiển thị
                </h4>
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="hien_thi_cong_khai" 
                               value="1" 
                               class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-500"
                               <?= old('hien_thi_cong_khai') ? 'checked' : '' ?>>
                        <span class="ml-2 text-sm text-gray-700">Hiển thị đánh giá này công khai trên website</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="cho_phep_tra_loi" 
                               value="1" 
                               class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-500"
                               <?= old('cho_phep_tra_loi') ? 'checked' : '' ?>>
                        <span class="ml-2 text-sm text-gray-700">Cho phép khách sạn trả lời đánh giá này</span>
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                <a href="/danh-gia" 
                   class="text-gray-600 hover:text-gray-800 font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Quay lại danh sách
                </a>
                
                <div class="space-x-4">
                    <button type="reset" 
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors">
                        <i class="fas fa-undo mr-2"></i>
                        Đặt lại
                    </button>
                    <button type="submit" 
                            class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-3 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-star mr-2"></i>
                        Gửi đánh giá
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Rating interactions
const ratingInputs = document.querySelectorAll('.rating-input');
const ratingStars = document.querySelectorAll('.rating-star');
const ratingText = document.getElementById('rating-text');

const ratingTexts = {
    1: '😞 Rất không hài lòng',
    2: '😐 Không hài lòng', 
    3: '🙂 Bình thường',
    4: '😊 Hài lòng',
    5: '🤩 Rất hài lòng'
};

ratingInputs.forEach((input, index) => {
    input.addEventListener('change', function() {
        updateRatingDisplay(parseInt(this.value));
    });
});

ratingStars.forEach((star, index) => {
    star.addEventListener('click', function() {
        const rating = index + 1;
        document.getElementById('rating_' + rating).checked = true;
        updateRatingDisplay(rating);
    });
    
    star.addEventListener('mouseenter', function() {
        const rating = index + 1;
        highlightStars(rating);
    });
});

document.querySelector('.flex.items-center.justify-center.space-x-2').addEventListener('mouseleave', function() {
    const checkedRating = document.querySelector('.rating-input:checked');
    if (checkedRating) {
        updateRatingDisplay(parseInt(checkedRating.value));
    } else {
        resetStars();
    }
});

function updateRatingDisplay(rating) {
    highlightStars(rating);
    ratingText.textContent = ratingTexts[rating] || '';
}

function highlightStars(rating) {
    ratingStars.forEach((star, index) => {
        if (index < rating) {
            star.classList.remove('text-gray-300');
            star.classList.add('text-yellow-400');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });
}

function resetStars() {
    ratingStars.forEach(star => {
        star.classList.remove('text-yellow-400');
        star.classList.add('text-gray-300');
    });
    ratingText.textContent = '';
}

// Review type interactions
const reviewTypeInputs = document.querySelectorAll('.review-type-input');
const reviewTypeCards = document.querySelectorAll('.review-type-card');
const specificSelection = document.getElementById('specific-selection');
const roomSelection = document.getElementById('room-selection');
const serviceSelection = document.getElementById('service-selection');

reviewTypeInputs.forEach((input, index) => {
    input.addEventListener('change', function() {
        // Update card styles
        reviewTypeCards.forEach((card, cardIndex) => {
            if (cardIndex === index) {
                card.classList.remove('border-gray-200');
                card.classList.add('border-yellow-400', 'bg-yellow-50');
                card.querySelector('i').classList.remove('text-gray-400');
                card.querySelector('i').classList.add('text-yellow-500');
            } else {
                card.classList.remove('border-yellow-400', 'bg-yellow-50');
                card.classList.add('border-gray-200');
                card.querySelector('i').classList.remove('text-yellow-500');
                card.querySelector('i').classList.add('text-gray-400');
            }
        });
        
        // Show/hide specific selections
        if (this.value === 'phong') {
            specificSelection.classList.remove('hidden');
            roomSelection.classList.remove('hidden');
            serviceSelection.classList.add('hidden');
            document.getElementById('phong_id').required = true;
            document.getElementById('dich_vu_id').required = false;
        } else if (this.value === 'dich_vu') {
            specificSelection.classList.remove('hidden');
            serviceSelection.classList.remove('hidden');
            roomSelection.classList.add('hidden');
            document.getElementById('dich_vu_id').required = true;
            document.getElementById('phong_id').required = false;
        } else {
            specificSelection.classList.add('hidden');
            roomSelection.classList.add('hidden');
            serviceSelection.classList.add('hidden');
            document.getElementById('phong_id').required = false;
            document.getElementById('dich_vu_id').required = false;
        }
    });
});

// Initialize selected review type on page load
const checkedReviewType = document.querySelector('.review-type-input:checked');
if (checkedReviewType) {
    checkedReviewType.dispatchEvent(new Event('change'));
}

// Initialize selected rating on page load
const checkedRating = document.querySelector('.rating-input:checked');
if (checkedRating) {
    updateRatingDisplay(parseInt(checkedRating.value));
}

// Character counter for review content
const noiDungTextarea = document.getElementById('noi_dung');
noiDungTextarea.addEventListener('input', function() {
    const length = this.value.length;
    const minLength = 50;
    
    if (length < minLength) {
        this.style.borderColor = '#ef4444';
    } else {
        this.style.borderColor = '#d1d5db';
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const noiDung = document.getElementById('noi_dung').value;
    if (noiDung.length < 50) {
        e.preventDefault();
        alert('Nội dung đánh giá phải có ít nhất 50 ký tự');
        document.getElementById('noi_dung').focus();
        return false;
    }
    
    const rating = document.querySelector('.rating-input:checked');
    if (!rating) {
        e.preventDefault();
        alert('Vui lòng chọn số sao đánh giá');
        return false;
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
