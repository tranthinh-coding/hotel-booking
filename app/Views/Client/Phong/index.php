<?php 
$title = 'Danh sách phòng - Ocean Pearl Hotel';
ob_start(); 
?>

<!-- External Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Custom Styles -->
<style>
    /* Reset & Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 25%, #bae6fd 50%, #7dd3fc 75%, #38bdf8 100%);
        min-height: 100vh;
        color: #1e293b;
    }

    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Hero Section */
    .hero-section {
        text-align: center;
        padding: 60px 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 249, 255, 0.8));
        border-radius: 24px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(56, 189, 248, 0.2);
        box-shadow: 0 20px 40px rgba(56, 189, 248, 0.1);
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        border: 1px solid rgba(14, 165, 233, 0.3);
        padding: 8px 20px;
        border-radius: 50px;
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0c4a6e, #0369a1, #0284c7);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 16px;
        line-height: 1.1;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: #475569;
        max-width: 600px;
        margin: 0 auto 32px;
        line-height: 1.6;
        font-weight: 500;
    }

    /* Search Section */
    .search-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(14, 165, 233, 0.2);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 48px;
        box-shadow: 0 25px 50px rgba(14, 165, 233, 0.15);
    }

    .search-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .search-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0c4a6e;
        margin-bottom: 8px;
    }

    .search-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }

    .input-field {
        width: 100%;
        padding: 14px 18px;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        color: #1e293b;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .input-field:focus {
        outline: none;
        border-color: #0ea5e9;
        background: white;
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        transform: translateY(-1px);
    }

    .search-button {
        width: 100%;
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        color: white;
        border: none;
        padding: 16px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 24px;
        box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
    }

    .search-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(14, 165, 233, 0.4);
        background: linear-gradient(135deg, #0284c7, #0369a1);
    }

    /* Room Cards */
    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 32px;
        margin-bottom: 48px;
    }

    .room-card {
        background: white;
        border: 1px solid rgba(14, 165, 233, 0.1);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        position: relative;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(14, 165, 233, 0.15);
        border-color: rgba(14, 165, 233, 0.3);
    }

    .room-image {
        height: 240px;
        background: linear-gradient(135deg, #0ea5e9, #0284c7, #0369a1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        position: relative;
        overflow: hidden;
    }

    .room-content {
        padding: 28px;
    }

    .room-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0c4a6e;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .book-button {
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .book-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
        background: linear-gradient(135deg, #0284c7, #0369a1);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 20px;
        border: 2px dashed rgba(14, 165, 233, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-container {
            padding: 16px;
        }
        .hero-title {
            font-size: 2.5rem;
        }
        .search-grid {
            grid-template-columns: 1fr;
        }
        .rooms-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="main-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-crown"></i>
                Ocean Pearl Hotel
            </div>
            <h1 class="hero-title">Khám Phá Phòng Nghỉ Đẳng Cấp</h1>
            <p class="hero-subtitle">
                Trải nghiệm những không gian nghỉ dưỡng sang trọng với view biển tuyệt đẹp 
                và dịch vụ 5 sao tại Ocean Pearl Hotel
            </p>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-container">
        <div class="search-header">
            <h2 class="search-title">Tìm Phòng Phù Hợp</h2>
            <p class="text-gray-600">Nhập thông tin để tìm kiếm phòng khả dụng theo nhu cầu của bạn</p>
        </div>
        
        <form method="GET" action="/phong">
            <div class="search-grid">
                <div class="input-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="checkin">
                        <i class="fas fa-calendar-plus"></i> Ngày nhận phòng
                    </label>
                    <input type="date" 
                           name="checkin" 
                           id="checkin" 
                           class="input-field"
                           value="<?= htmlspecialchars($searchParams['checkin'] ?? '') ?>"
                           min="<?= date('Y-m-d') ?>">
                </div>

                <div class="input-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="checkout">
                        <i class="fas fa-calendar-minus"></i> Ngày trả phòng
                    </label>
                    <input type="date" 
                           name="checkout" 
                           id="checkout" 
                           class="input-field"
                           value="<?= htmlspecialchars($searchParams['checkout'] ?? '') ?>"
                           min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                </div>

                <div class="input-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="guests">
                        <i class="fas fa-users"></i> Số khách
                    </label>
                    <select name="guests" id="guests" class="input-field">
                        <?php for($i = 1; $i <= 6; $i++): ?>
                            <option value="<?= $i ?>" <?= (($searchParams['guests'] ?? 1) == $i) ? 'selected' : '' ?>>
                                <?= $i ?> khách
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="input-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="room_type">
                        <i class="fas fa-bed"></i> Loại phòng
                    </label>
                    <select name="room_type" id="room_type" class="input-field">
                        <option value="">Tất cả loại phòng</option>
                        <?php if(isset($loaiPhongs) && !empty($loaiPhongs)): ?>
                            <?php foreach($loaiPhongs as $loaiPhong): ?>
                                <option value="<?= htmlspecialchars($loaiPhong['ma_loai_phong'] ?? $loaiPhong->ma_loai_phong) ?>" 
                                        <?= (($searchParams['room_type'] ?? '') == ($loaiPhong['ma_loai_phong'] ?? $loaiPhong->ma_loai_phong)) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($loaiPhong['ten'] ?? $loaiPhong->ten) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
                Tìm Phòng Khả Dụng
            </button>
        </form>
    </div>

    <!-- Results Section -->
    <?php if(!empty($phongs)): ?>
        <div class="bg-white bg-opacity-80 p-6 rounded-2xl mb-8 flex justify-between items-center">
            <div class="text-lg text-gray-900 font-semibold">
                Tìm thấy <span class="text-blue-600 font-bold"><?= count($phongs) ?></span> phòng phù hợp
            </div>
            <select class="p-2 border-2 border-gray-200 rounded-lg">
                <option>Sắp xếp theo giá tăng dần</option>
                <option>Sắp xếp theo giá giảm dần</option>
                <option>Sắp xếp theo tên phòng</option>
            </select>
        </div>

        <div class="rooms-grid">
            <?php foreach($phongs as $phong): ?>
                <div class="room-card">
                    <div class="room-image">
                        <i class="fas fa-hotel"></i>
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle"></i>
                            Còn trống
                        </div>
                    </div>
                    
                    <div class="room-content">
                        <div class="mb-5">
                            <h3 class="room-title">
                                <?= htmlspecialchars($phong['ten_phong'] ?? $phong->ten_phong) ?>
                            </h3>
                            <div class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-semibold uppercase">
                                <?= htmlspecialchars($phong['loai_phong'] ?? $phong->loai_phong ?? 'Standard') ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-hashtag text-blue-500"></i>
                                <span>Mã: <?= htmlspecialchars($phong['ma_phong'] ?? $phong->ma_phong) ?></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-water text-blue-500"></i>
                                <span>View biển</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-bed text-blue-500"></i>
                                <span>Giường đôi</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-expand-arrows-alt text-blue-500"></i>
                                <span>35m²</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">Tiện nghi</h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-wifi"></i> WiFi miễn phí
                                </span>
                                <span class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-tv"></i> Smart TV
                                </span>
                                <span class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-snowflake"></i> Điều hòa
                                </span>
                                <span class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-bath"></i> Bồn tắm
                                </span>
                                <span class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-glass-martini-alt"></i> Minibar
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-5 border-t border-gray-200">
                            <div>
                                <div class="text-3xl font-bold text-blue-600">
                                    <?= number_format($phong['gia_phong'] ?? $phong->gia_phong ?? 0, 0, ',', '.') ?>₫
                                </div>
                                <div class="text-sm text-gray-500">mỗi đêm</div>
                            </div>
                            <a href="/phong/<?= $phong['ma_phong'] ?? $phong->ma_phong ?>" class="book-button">
                                <i class="fas fa-calendar-check"></i>
                                Đặt ngay
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="text-6xl text-gray-400 mb-6">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Không tìm thấy phòng phù hợp</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Thử thay đổi tiêu chí tìm kiếm hoặc chọn ngày khác để xem thêm phòng có sẵn
            </p>
            <a href="/phong" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors inline-flex items-center gap-2">
                <i class="fas fa-refresh"></i>
                Xem tất cả phòng
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto update checkout date when checkin changes
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    
    if (checkinInput && checkoutInput) {
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            const nextDay = new Date(checkinDate);
            nextDay.setDate(nextDay.getDate() + 1);
            
            if (!checkoutInput.value || new Date(checkoutInput.value) <= checkinDate) {
                checkoutInput.value = nextDay.toISOString().split('T')[0];
            }
            
            checkoutInput.min = nextDay.toISOString().split('T')[0];
        });
    }

    // Form validation
    const searchForm = document.querySelector('form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            
            if (checkin && checkout && new Date(checkin) >= new Date(checkout)) {
                e.preventDefault();
                alert('Ngày trả phòng phải sau ngày nhận phòng!');
                return false;
            }
        });
    }

    // Simple fade-in animation for room cards
    const roomCards = document.querySelectorAll('.room-card');
    roomCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>