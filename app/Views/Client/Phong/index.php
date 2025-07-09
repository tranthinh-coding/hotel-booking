<?php ob_start(); ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
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

    /* Header Section */
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

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(56,189,248,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    }

    .hero-content {
        position: relative;
        z-index: 2;
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

    .search-description {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .search-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }

    .input-group {
        position: relative;
    }

    .input-label {
        display: block;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 8px;
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

    /* Results Section */
    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px 24px;
        border-radius: 16px;
        border: 1px solid rgba(14, 165, 233, 0.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .results-count {
        font-size: 1.125rem;
        color: #1e293b;
        font-weight: 600;
    }

    .results-count .number {
        color: #0ea5e9;
        font-weight: 700;
        font-size: 1.25rem;
    }

    .sort-dropdown {
        padding: 10px 16px;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        color: #1e293b;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sort-dropdown:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    /* Rooms Grid */
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

    .room-image::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.2) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .room-card:hover .room-image::before {
        transform: translateX(100%);
    }

    .room-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .room-content {
        padding: 28px;
    }

    .room-header {
        margin-bottom: 20px;
    }

    .room-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0c4a6e;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .room-type {
        color: #0ea5e9;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(14, 165, 233, 0.1);
        padding: 4px 12px;
        border-radius: 12px;
        display: inline-block;
    }

    .room-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #475569;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .detail-icon {
        color: #0ea5e9;
        width: 16px;
        text-align: center;
    }

    .room-amenities {
        margin-bottom: 24px;
    }

    .amenities-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .amenities-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .amenity-tag {
        background: rgba(14, 165, 233, 0.1);
        border: 1px solid rgba(14, 165, 233, 0.2);
        color: #0369a1;
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: all 0.3s ease;
    }

    .amenity-tag:hover {
        background: rgba(14, 165, 233, 0.15);
        transform: translateY(-1px);
    }

    .room-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid rgba(226, 232, 240, 0.8);
    }

    .room-price {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .price-amount {
        font-size: 1.875rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0c4a6e, #0369a1);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 2px;
    }

    .price-period {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 500;
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
        position: relative;
        overflow: hidden;
    }

    .book-button::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.2) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .book-button:hover::before {
        transform: translateX(100%);
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
        backdrop-filter: blur(20px);
        border-radius: 20px;
        border: 2px dashed rgba(14, 165, 233, 0.3);
        box-shadow: 0 20px 40px rgba(14, 165, 233, 0.1);
    }

    .empty-icon {
        font-size: 4rem;
        color: #64748b;
        margin-bottom: 24px;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .empty-description {
        color: #64748b;
        margin-bottom: 32px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        font-weight: 500;
    }

    .reset-button {
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .reset-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
        background: linear-gradient(135deg, #0284c7, #0369a1);
    }

    /* Animation styles */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .room-card {
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .room-card:nth-child(1) { animation-delay: 0.1s; }
    .room-card:nth-child(2) { animation-delay: 0.2s; }
    .room-card:nth-child(3) { animation-delay: 0.3s; }
    .room-card:nth-child(4) { animation-delay: 0.4s; }
    .room-card:nth-child(5) { animation-delay: 0.5s; }
    .room-card:nth-child(6) { animation-delay: 0.6s; }

    .hero-section {
        animation: fadeInUp 0.8s ease-out;
    }

    .search-container {
        animation: fadeInUp 0.8s ease-out 0.2s;
        animation-fill-mode: both;
    }

    .results-header {
        animation: slideIn 0.6s ease-out 0.4s;
        animation-fill-mode: both;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-container {
            padding: 16px;
        }

        .hero-section {
            padding: 40px 20px;
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.125rem;
        }

        .search-container {
            padding: 24px;
            margin-bottom: 32px;
        }

        .search-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .rooms-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .results-header {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .room-details {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .room-footer {
            flex-direction: column;
            gap: 16px;
            align-items: stretch;
        }

        .book-button {
            width: 100%;
            justify-content: center;
        }

        .price-amount {
            font-size: 1.5rem;
        }

        .empty-state {
            padding: 60px 20px;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }

        .search-container {
            padding: 20px;
        }

        .room-content {
            padding: 20px;
        }

        .amenities-grid {
            gap: 6px;
        }

        .amenity-tag {
            font-size: 0.7rem;
            padding: 4px 8px;
        }
    }

    /* Loading Animation */
    .loading-shimmer {
        background: linear-gradient(90deg, rgba(71, 85, 105, 0.3) 25%, rgba(71, 85, 105, 0.5) 50%, rgba(71, 85, 105, 0.3) 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
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
            <p class="search-description">Nhập thông tin để tìm kiếm phòng khả dụng theo nhu cầu của bạn</p>
        </div>
        
        <form method="GET" action="/phong">
            <div class="search-grid">
                <div class="input-group">
                    <label class="input-label" for="checkin">
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
                    <label class="input-label" for="checkout">
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
                    <label class="input-label" for="guests">
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
                    <label class="input-label" for="room_type">
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
        <div class="results-header">
            <div class="results-count">
                Tìm thấy <span class="number"><?= count($phongs) ?></span> phòng phù hợp
            </div>
            <select class="sort-dropdown">
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
                        <div class="room-badge">
                            <i class="fas fa-check-circle"></i>
                            Còn trống
                        </div>
                    </div>
                    
                    <div class="room-content">
                        <div class="room-header">
                            <h3 class="room-title">
                                <?= htmlspecialchars($phong['ten_phong'] ?? $phong->ten_phong) ?>
                            </h3>
                            <div class="room-type">
                                <?= htmlspecialchars($phong['loai_phong'] ?? $phong->loai_phong) ?>
                            </div>
                        </div>

                        <div class="room-details">
                            <div class="detail-item">
                                <i class="fas fa-hashtag detail-icon"></i>
                                <span>Mã: <?= htmlspecialchars($phong['ma_phong'] ?? $phong->ma_phong) ?></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-water detail-icon"></i>
                                <span>View biển</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-bed detail-icon"></i>
                                <span>Giường đôi</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-expand-arrows-alt detail-icon"></i>
                                <span>35m²</span>
                            </div>
                        </div>

                        <div class="room-amenities">
                            <h4 class="amenities-title">Tiện nghi</h4>
                            <div class="amenities-grid">
                                <span class="amenity-tag">
                                    <i class="fas fa-wifi"></i> WiFi miễn phí
                                </span>
                                <span class="amenity-tag">
                                    <i class="fas fa-tv"></i> Smart TV
                                </span>
                                <span class="amenity-tag">
                                    <i class="fas fa-snowflake"></i> Điều hòa
                                </span>
                                <span class="amenity-tag">
                                    <i class="fas fa-bath"></i> Bồn tắm
                                </span>
                                <span class="amenity-tag">
                                    <i class="fas fa-glass-martini-alt"></i> Minibar
                                </span>
                                <span class="amenity-tag">
                                    <i class="fas fa-concierge-bell"></i> Room service
                                </span>
                            </div>
                        </div>

                        <div class="room-footer">
                            <div class="room-price">
                                <div class="price-amount">
                                    <?= number_format($phong['gia_phong'] ?? $phong->gia_phong, 0, ',', '.') ?>₫
                                </div>
                                <div class="price-period">mỗi đêm</div>
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
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="empty-title">Không tìm thấy phòng phù hợp</h3>
            <p class="empty-description">
                Thử thay đổi tiêu chí tìm kiếm hoặc chọn ngày khác để xem thêm phòng có sẵn
            </p>
            <a href="/phong" class="reset-button">
                <i class="fas fa-refresh"></i>
                Xem tất cả phòng
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    // Auto update checkout date when checkin changes
    document.getElementById('checkin')?.addEventListener('change', function() {
        const checkinDate = new Date(this.value);
        const checkoutInput = document.getElementById('checkout');
        const nextDay = new Date(checkinDate);
        nextDay.setDate(nextDay.getDate() + 1);
        
        if (!checkoutInput.value || new Date(checkoutInput.value) <= checkinDate) {
            checkoutInput.value = nextDay.toISOString().split('T')[0];
        }
        
        checkoutInput.min = nextDay.toISOString().split('T')[0];
    });

    // Form validation
    document.querySelector('form')?.addEventListener('submit', function(e) {
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;
        
        if (checkin && checkout && new Date(checkin) >= new Date(checkout)) {
            e.preventDefault();
            alert('Ngày trả phòng phải sau ngày nhận phòng!');
            return false;
        }
    });

    // Sort functionality
    document.querySelector('.sort-dropdown')?.addEventListener('change', function() {
        const sortValue = this.value;
        const roomsGrid = document.querySelector('.rooms-grid');
        const roomCards = Array.from(roomsGrid.children);
        
        roomCards.sort((a, b) => {
            if (sortValue.includes('giá tăng')) {
                const priceA = parseInt(a.querySelector('.price-amount').textContent.replace(/[^\d]/g, ''));
                const priceB = parseInt(b.querySelector('.price-amount').textContent.replace(/[^\d]/g, ''));
                return priceA - priceB;
            } else if (sortValue.includes('giá giảm')) {
                const priceA = parseInt(a.querySelector('.price-amount').textContent.replace(/[^\d]/g, ''));
                const priceB = parseInt(b.querySelector('.price-amount').textContent.replace(/[^\d]/g, ''));
                return priceB - priceA;
            } else if (sortValue.includes('tên')) {
                const nameA = a.querySelector('.room-title').textContent.trim();
                const nameB = b.querySelector('.room-title').textContent.trim();
                return nameA.localeCompare(nameB, 'vi');
            }
            return 0;
        });
        
        roomCards.forEach(card => roomsGrid.appendChild(card));
    });

    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Apply animations to room cards
    document.querySelectorAll('.room-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>