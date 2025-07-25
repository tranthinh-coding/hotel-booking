<?php
$title = 'Chi tiết phòng - Ocean Pearl Hotel';
ob_start();

$danhSachHinhAnh = array_merge(
    [
        getFileUrl($phong->anh_bia)
    ],
    array_map(fn($hinhAnh) => $hinhAnh->getImageUrl(), $hinhAnhPhong)
);
?>

<!-- Modern clean CSS -->
<style>
    .room-card {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgb(238 238 238)
    }

    .glass-effect {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .gradient-bg {
        background: linear-gradient(135deg,
                rgba(56, 189, 248, 0.05) 0%,
                rgba(14, 165, 233, 0.05) 50%,
                rgba(6, 182, 212, 0.05) 100%);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        border: none;
        box-shadow: 0 4px 14px rgba(14, 165, 233, 0.2);
        transition: all 0.12s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
        background: linear-gradient(135deg, #0284c7 0%, #0891b2 100%);
    }

    .form-input {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.2s ease;
        background: rgba(255, 255, 255, 0.8);
    }

    .form-input:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 1);
    }

    .amenity-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        margin-right: 12px;
    }

    .price-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.5);
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        transition: all 0.12s ease;
    }

    .stat-card:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }
</style>

<!-- Hero Section with Breadcrumb -->
<div class="gradient-bg py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                <?= htmlspecialchars($phong->ten_phong ?? '') ?>
            </h1>
            <div class="flex items-center justify-center space-x-4 text-slate-600">
                <span
                    class="px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full text-sm font-medium border border-slate-200">
                    <i class="fas fa-tag mr-2 text-blue-500"></i>
                    <?= htmlspecialchars($loaiPhong->ten ?? 'Loại phòng') ?>
                </span>
                <span class="px-4 py-2 bg-blue-50 rounded-full text-sm font-semibold text-blue-700">
                    <?= number_format($phong->gia ?? 0) ?>₫/giờ
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Thông tin phòng chính -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Hình ảnh -->
                <div class="room-card rounded-3xl overflow-hidden">
                    <!-- Ảnh bìa -->
                    <div class="relative">
                        <img id="main-image" src="<?= getFileUrl($phong->anh_bia) ?>"
                            alt="<?= htmlspecialchars($phong->ten_phong ?? '') ?>"
                            class="w-full h-96 object-cover transition-all duration-300">

                        <!-- Nút chuyển ảnh -->
                        <button id="prev-image" type="button"
                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 text-white rounded-full p-2 hover:bg-black/70 z-10"
                            style="display:none">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button id="next-image" type="button"
                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 text-white rounded-full p-2 hover:bg-black/70 z-10"
                            style="display:none">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-6">
                            <h2 class="text-2xl font-bold text-white mb-2">
                                <?= htmlspecialchars($phong->ten_phong ?? '') ?>
                            </h2>
                        </div>
                    </div>
                    <!-- Ảnh phòng -->
                    <?php if (count($danhSachHinhAnh) > 0): ?>
                        <div class="p-6 bg-slate-50">
                            <h4 class="font-semibold text-slate-800 mb-4">Hình ảnh phòng (<?= count($danhSachHinhAnh) ?>
                                ảnh)
                            </h4>
                            <div class="grid grid-cols-4 md:grid-cols-6 gap-3">
                                <?php foreach ($danhSachHinhAnh as $index => $hinhAnh): ?>
                                    <div class="relative cursor-pointer group">
                                        <img src="<?= $hinhAnh ?>" alt="Hình ảnh phòng <?= $index + 1 ?>"
                                            class="thumbnail w-full h-20 object-cover rounded-lg border-2 border-transparent group-hover:border-blue-500 transition-all duration-200 <?= $index === 0 ? 'border-blue-500' : '' ?>"
                                            onclick="showImage(<?= $index ?>)">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Room Description -->

                <div class="room-card rounded-3xl p-8 mb-8">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Mô tả phòng</h3>
                    <?php if (isNotEmpty($phong->mo_ta)): ?>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            <?= nl2br(htmlspecialchars($phong->mo_ta)) ?>
                        </p>
                    <?php else: ?>
                        <p class="text-slate-600 leading-relaxed mb-6">
                            Phòng được thiết kế hiện đại với đầy đủ tiện nghi cao cấp, mang đến trải nghiệm nghỉ dưỡng tuyệt
                            vời cho quý khách.
                            Không gian rộng rãi, thoáng mát với view đẹp, đảm bảo sự thoải mái và riêng tư tuyệt đối.
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Room Reviews -->
                <div class="room-card rounded-3xl p-8 mb-8">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Đánh giá phòng</h3>
                    <?php if (!empty($danhGias)): ?>
                        <?php foreach ($danhGias as $danhGia): ?>
                            <div class="border-b border-slate-200 py-4">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="font-bold text-blue-700 mr-2"><?= htmlspecialchars($danhGia->tai_khoan ?? 'Ẩn danh') ?></span>
                                    <span class="text-yellow-500">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i
                                                class="fas fa-star<?= $i <= ($danhGia->diem_danh_gia ?? $danhGia->diem ?? 0) ? '' : '-o' ?>"></i>
                                        <?php endfor; ?>
                                    </span>
                                    <span class="ml-4 text-xs text-slate-500">
                                        <?= !empty($danhGia->ngay_gui) ? date('d/m/Y H:i', strtotime($danhGia->ngay_gui)) : '' ?>
                                    </span>
                                </div>
                                <div class="text-slate-700">
                                    <?= nl2br(htmlspecialchars($danhGia->noi_dung ?? $danhGia->nhan_xet ?? '')) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-slate-500">Chưa có đánh giá nào cho phòng này.</div>
                    <?php endif; ?>
                    <?php if (isset($canReview) && $canReview): ?>
                        <div class="mt-8">
                            <a href="/phong/danhgia?phong_id=<?= $phong->ma_phong ?>"
                                class="btn-primary px-6 py-3 rounded-lg text-white font-semibold">Viết đánh giá</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Amenities -->
                <div class="room-card rounded-3xl p-8">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Tiện nghi phòng</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-wifi"></i>
                            </div>
                            <span class="text-slate-700 font-medium">WiFi miễn phí tốc độ cao</span>
                        </div>
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-snowflake"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Điều hòa không khí</span>
                        </div>
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-tv"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Smart TV 55 inch</span>
                        </div>
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-bath"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Phòng tắm riêng sang trọng</span>
                        </div>
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-coffee"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Minibar & máy pha cà phê</span>
                        </div>
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Két an toàn điện tử</span>
                        </div>
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Dịch vụ phòng 24/7</span>
                        </div>
                        <div class="flex items-center">
                            <div class="amenity-icon">
                                <i class="fas fa-wind"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Ban công riêng với view đẹp</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Booking Form -->
            <div class="lg:col-span-1">
                <!-- Booking Form -->
                <div class="room-card rounded-3xl p-8 sticky top-8">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-slate-800 mb-2">Đặt phòng ngay</h3>
                        <p class="text-slate-600">Hoàn tất đặt phòng chỉ trong vài phút</p>
                    </div>

                    <form action="/booking/checkout" method="GET" class="space-y-6">
                        <input type="hidden" name="phong_id" value="<?= $phong->ma_phong ?? '' ?>">

                        <!-- Check-in -->
                        <div>
                            <label for="ngay_nhan_phong" class="block text-sm font-semibold text-slate-700 mb-3">
                                <i class="fas fa-calendar-plus mr-2 text-blue-500"></i>
                                Thời gian nhận phòng
                            </label>
                            <input type="datetime-local" id="ngay_nhan_phong" name="ngay_nhan_phong"
                                class="form-input w-full px-4 py-3" required min="<?= date('Y-m-d\TH:i') ?>">
                        </div>

                        <!-- Check-out -->
                        <div>
                            <label for="ngay_tra_phong" class="block text-sm font-semibold text-slate-700 mb-3">
                                <i class="fas fa-calendar-minus mr-2 text-blue-500"></i>
                                Thời gian trả phòng
                            </label>
                            <input type="datetime-local" id="ngay_tra_phong" name="ngay_tra_phong"
                                class="form-input w-full px-4 py-3" required>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="price-card">
                            <h4 class="font-semibold text-slate-800 mb-4">Chi tiết giá</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600">Giá phòng/giờ:</span>
                                    <span
                                        class="font-semibold text-slate-800"><?= number_format($phong->gia ?? 0) ?>₫</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600">Thời gian thuê:</span>
                                    <span class="font-semibold text-slate-800" id="rental-hours">-</span>
                                </div>
                                <div class="border-t border-slate-200 pt-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-slate-800">Tổng tiền:</span>
                                        <span class="text-xl font-bold text-blue-600" id="total-price">0₫</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Book Button -->
                        <?php if (auth_check()): ?>
                            <button type="submit"
                                class="btn-primary w-full text-white py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105">
                                <i class="fas fa-credit-card mr-2"></i>
                                Tiến hành đặt phòng
                            </button>
                        <?php else: ?>
                            <a href="/login"
                                class="btn-primary block w-full text-white py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 text-center">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Đăng nhập để đặt phòng
                            </a>
                        <?php endif; ?>

                        <!-- Safety notice -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                            <div class="flex items-start">
                                <i class="fas fa-shield-check text-green-500 mt-1 mr-3"></i>
                                <div>
                                    <h5 class="font-semibold text-green-800 mb-1">Đặt phòng an toàn</h5>
                                    <p class="text-sm text-green-700">
                                        Miễn phí hủy phòng trong 24h. Thanh toán bảo mật 100%.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
    // Hình ảnh phòng
    const imageUrls = [
        <?=
            implode(", ", array_map(fn($url) => "'" . $url . "'", $danhSachHinhAnh));
        ?>
    ];
    let currentImageIndex = 0;
    let autoChangeTimer = null;

    function showImage(index) {
        const mainImage = document.getElementById('main-image');
        const thumbnails = document.querySelectorAll('.thumbnail');

        currentImageIndex = index;
        mainImage.src = imageUrls[index];
        console.log('Showing image:', mainImage.src, imageUrls);
        thumbnails.forEach((thumb, i) => {
            thumb.classList.remove('border-blue-500');
            thumb.classList.add('border-transparent');
            if (i == currentImageIndex) {
                thumb.classList.remove('border-transparent');
                thumb.classList.add('border-blue-500');
            }
        });
        resetAutoChange();
    }

    function nextImage() {
        const newIndex = (currentImageIndex + 1) % imageUrls.length;
        showImage(newIndex);
    }

    function prevImage() {
        const newIndex = (currentImageIndex - 1 + imageUrls.length) % imageUrls.length;
        showImage(newIndex);
    }

    function resetAutoChange() {
        if (autoChangeTimer) clearTimeout(autoChangeTimer);
        autoChangeTimer = setTimeout(() => {
            nextImage();
        }, 5000);
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Hiển thị nút nếu có nhiều ảnh
        if (imageUrls.length > 1) {
            document.getElementById('prev-image').style.display = '';
            document.getElementById('next-image').style.display = '';
        }
        document.getElementById('prev-image').addEventListener('click', prevImage);
        document.getElementById('next-image').addEventListener('click', nextImage);
        showImage(0);

        const checkinInput = document.getElementById('ngay_nhan_phong');
        const checkoutInput = document.getElementById('ngay_tra_phong');
        const hourlyRate = <?= $phong->gia ?? 0 ?>;
        const rentalHoursEl = document.getElementById('rental-hours');
        const totalPriceEl = document.getElementById('total-price');

        // Set minimum time to current time
        const now = new Date();
        const currentDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
        checkinInput.min = currentDateTime;

        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN').format(amount) + '₫';
        }

        function calculatePrice() {
            const checkin = new Date(checkinInput.value);
            const checkout = new Date(checkoutInput.value);

            if (checkinInput.value && checkoutInput.value && checkout > checkin) {
                const diffMs = checkout - checkin;
                const hours = Math.ceil(diffMs / (1000 * 60 * 60));
                const minHours = Math.max(hours, 2); // Minimum 2 hours

                rentalHoursEl.textContent = minHours + ' giờ';

                const total = minHours * hourlyRate;
                totalPriceEl.textContent = formatCurrency(total);

                return true;
            } else {
                rentalHoursEl.textContent = '-';
                totalPriceEl.textContent = '0₫';
                return false;
            }
        }

        // Update minimum checkout time when checkin changes
        checkinInput.addEventListener('change', function () {
            if (this.value) {
                const minCheckout = new Date(this.value);
                minCheckout.setHours(minCheckout.getHours() + 2);
                const minCheckoutStr = new Date(minCheckout.getTime() - minCheckout.getTimezoneOffset() * 60000)
                    .toISOString().slice(0, 16);
                checkoutInput.min = minCheckoutStr;

                // Auto-set checkout if not set
                if (!checkoutInput.value) {
                    checkoutInput.value = minCheckoutStr;
                }
            }
            calculatePrice();
        });

        checkoutInput.addEventListener('change', calculatePrice);

        // Form validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!calculatePrice()) {
                    e.preventDefault();
                    alert('Vui lòng chọn thời gian nhận và trả phòng hợp lệ!');
                    return false;
                }

                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);
                const now = new Date();

                if (checkin < now) {
                    e.preventDefault();
                    alert('Thời gian nhận phòng phải sau thời điểm hiện tại!');
                    return false;
                }

                if (checkout <= checkin) {
                    e.preventDefault();
                    alert('Thời gian trả phòng phải sau thời gian nhận phòng!');
                    return false;
                }

                // Show loading
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang xử lý...';
                    submitBtn.disabled = true;
                }
            });
        }

        // Smooth scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards for animation
        document.querySelectorAll('.room-card, .stat-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>