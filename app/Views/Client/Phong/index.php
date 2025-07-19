<?php
$title = 'Danh sách Phòng - Ocean Pearl Hotel';
ob_start();
?>

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
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        color: #1e293b;
        line-height: 1.6;
    }

    .main-container {
        max-width: 1200px;
        margin: 30px auto;
    }

    .content-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Hero Section - Full Width */
    .hero-section {
        position: relative;
        min-height: 100vh;
        background:
            url('https://5.imimg.com/data5/SELLER/Default/2023/8/336872951/UC/XC/VH/150189352/hotel-exterior-designing-service-1000x1000.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out;
    }

    /* Floating elements */
    .floating-element {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        pointer-events: none;
        animation: float 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
        width: 16px;
        height: 16px;
        top: 20%;
        left: 15%;
        animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
        width: 12px;
        height: 12px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
        width: 20px;
        height: 20px;
        top: 40%;
        left: 25%;
        animation-delay: 4s;
    }

    .floating-element:nth-child(4) {
        width: 8px;
        height: 8px;
        top: 80%;
        right: 30%;
        animation-delay: 1s;
    }

    .floating-element:nth-child(5) {
        width: 14px;
        height: 14px;
        top: 30%;
        right: 40%;
        animation-delay: 3s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .hero-content {
        position: relative;
        z-index: 10;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        padding: 12px 24px;
        border-radius: 50px;
        color: white;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 32px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.12s ease;
    }

    .hero-badge:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.3);
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        color: white;
        margin-bottom: 24px;
        line-height: 1.1;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .hero-title-highlight {
        display: block;
        background: linear-gradient(45deg, #ffffff, #f0f9ff, #e0f2fe);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: ocean-wave 3s ease-in-out infinite;
    }

    @keyframes ocean-wave {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 800px;
        margin: 0 auto 48px;
        line-height: 1.6;
        font-weight: 500;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.95);
        color: #0ea5e9;
        padding: 16px 32px;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.125rem;
        transition: all 0.12s ease;
        box-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .hero-cta:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 12px 40px rgba(255, 255, 255, 0.4);
        background: white;
    }

    .hero-cta i {
        transition: transform 0.3s ease;
    }

    .hero-cta:hover i {
        transform: scale(1.2);
    }

    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 64px;
        margin-top: 64px;
    }

    .hero-stat {
        text-align: center;
    }

    .hero-stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: white;
        margin-bottom: 8px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .hero-stat-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .scroll-indicator {
        position: absolute;
        bottom: 32px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        53%,
        80%,
        100% {
            transform: translateX(-50%) translateY(0);
        }

        40%,
        43% {
            transform: translateX(-50%) translateY(-10px);
        }

        70% {
            transform: translateX(-50%) translateY(-5px);
        }

        90% {
            transform: translateX(-50%) translateY(-2px);
        }
    }

    /* Search Section */
    .search-section {
        background: white;
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 40px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        animation: fadeInUp 0.8s ease-out 0.2s;
        animation-fill-mode: both;
    }

    .search-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .search-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .search-description {
        color: #64748b;
        font-size: 1rem;
        font-weight: 500;
    }

    .search-form {
        display: flex;
        /* flex-wrap: wrap; */
        gap: 20px;
        margin-bottom: 24px;
        justify-content: space-between;
    }

    .search-form .form-group {
        flex: 1 1 0;
        min-width: 250px;
        margin-bottom: 0;
        max-width: none;
        /* Đảm bảo các item rộng đều, không bị co lại */
        display: flex;
        flex-direction: column;
        justify-content: stretch;
    }

    .search-form .search-button {
        flex: 1 1 100%;
        margin-top: auto;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-input {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.12s ease;
        background: white;
        color: #1f2937;
        height: 100%;
    }

    .form-input:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        transform: translateY(-1px);
    }

    .search-button {
        grid-column: 1 / -1;
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.12s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 54px;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }

    .search-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
        background: linear-gradient(135deg, #0284c7, #0891b2);
    }

    /* Room Statistics Section */
    .stats-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
        animation: fadeInUp 0.8s ease-out 0.4s;
        animation-fill-mode: both;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: all 0.12s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #0ea5e9, #06b6d4);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: #0ea5e9;
        margin-bottom: 16px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Rooms Grid Section */
    .rooms-section {
        animation: fadeInUp 0.8s ease-out 0.6s;
        animation-fill-mode: both;
    }

    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .section-subtitle {
        font-size: 1.125rem;
        color: #64748b;
        max-width: 600px;
        margin: 0 auto;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 32px;
        margin-bottom: 48px;
    }

    .room-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: all 0.4s ease;
        position: relative;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
        border-color: #0ea5e9;
    }

    .room-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .room-card:hover .room-image {
        transform: scale(1.05);
    }

    .room-image-container {
        position: relative;
        overflow: hidden;
    }

    .room-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .room-price {
        position: absolute;
        top: 16px;
        right: 16px;
        background: rgba(255, 255, 255, 0.95);
        color: #0f172a;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 700;
        backdrop-filter: blur(10px);
    }

    .room-content {
        padding: 24px;
    }

    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .room-title {
        font-size: 1.375rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .room-type {
        font-size: 0.875rem;
        color: #0ea5e9;
        font-weight: 600;
        background: rgba(14, 165, 233, 0.1);
        padding: 4px 12px;
        border-radius: 12px;
    }

    .room-description {
        color: #64748b;
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .room-features {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
    }

    .room-feature {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        font-size: 0.875rem;
    }

    .room-feature i {
        color: #0ea5e9;
        font-size: 1rem;
    }

    .room-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }

    .room-price-display {
        display: flex;
        flex-direction: column;
    }

    .room-price-amount {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
    }

    .room-price-unit {
        font-size: 0.875rem;
        color: #64748b;
    }

    .room-actions {
        display: flex;
        gap: 12px;
    }

    .room-btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        text-align: center;
        transition: all 0.12s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-outline {
        background: transparent;
        color: #0ea5e9;
        border: 2px solid #0ea5e9;
    }

    .btn-outline:hover {
        background: #0ea5e9;
        color: white;
        transform: translateY(-2px);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
        background: linear-gradient(135deg, #0284c7, #0891b2);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: white;
        border-radius: 20px;
        border: 2px dashed #cbd5e1;
        margin: 40px 0;
    }

    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 24px;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .empty-description {
        color: #64748b;
        margin-bottom: 32px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .empty-button {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.12s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .empty-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-container {
            padding: 16px;
        }

        .hero-section {
            padding: 60px 24px;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .hero-stats {
            gap: 24px;
        }

        .hero-stat-number {
            font-size: 2rem;
        }

        .hero-cta {
            padding: 14px 24px;
            font-size: 1rem;
        }

        .search-form {
            grid-template-columns: 1fr;
        }

        .stats-section {
            grid-template-columns: 1fr;
        }

        .rooms-grid {
            grid-template-columns: 1fr;
        }

        .room-actions {
            flex-direction: column;
        }

        .section-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .hero-stats {
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hero-stat-number {
            font-size: 1.5rem;
        }

        .hero-cta {
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        .room-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .room-footer {
            flex-direction: column;
            gap: 16px;
            align-items: stretch;
        }
    }
</style>

<!-- Section 1: Hero Section -->
<div class="hero-section">
    <!-- Floating ocean elements -->
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>

    <div class="hero-content">
        <div class="hero-badge">
            <i class="fas fa-gem"></i>
            Ocean Pearl Hotel
        </div>

        <h1 class="hero-title">
            Phòng Nghỉ
            <span class="hero-title-highlight">Cao Cấp</span>
        </h1>

        <p class="hero-subtitle">
            Khám phá các phòng nghỉ sang trọng với thiết kế hiện đại, view biển tuyệt đẹp
            và đầy đủ tiện nghi 5 sao mang đến trải nghiệm nghỉ dưỡng đẳng cấp
        </p>

        <a href="#search" class="hero-cta">
            <i class="fas fa-search"></i>
            Tìm phòng ngay
            <i class="fas fa-arrow-right"></i>
        </a>

        <!-- Quick stats -->
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-number"><?= count($phongs) ?>+</div>
                <div class="hero-stat-label">Phòng nghỉ</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">200m</div>
                <div class="hero-stat-label">Mặt tiền biển</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">4.9★</div>
                <div class="hero-stat-label">Đánh giá</div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down text-2xl"></i>
    </div>
</div>

<div class="main-container">
    <!-- Section 2: Search Section -->
    <div class="content-container">
        <div id="search" class="search-section">
            <div class="search-header">
                <h2 class="search-title">Tìm Kiếm Phòng Nghỉ</h2>
                <p class="search-description">Chọn ngày và loại phòng phù hợp với nhu cầu của bạn</p>
            </div>

            <form method="GET" action="/phong" id="search-form" class="search-form">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar-check"></i>
                        Ngày nhận phòng
                    </label>
                    <input type="date" name="checkin" class="form-input"
                        value="<?= htmlspecialchars($_GET['checkin'] ?? '') ?>" min="<?= date('Y-m-d') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar-times"></i>
                        Ngày trả phòng
                    </label>
                    <input type="date" name="checkout" class="form-input"
                        value="<?= htmlspecialchars($_GET['checkout'] ?? '') ?>"
                        min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-bed"></i>
                        Loại phòng
                    </label>
                    <select name="room_type" class="form-input">
                        <option value="">Tất cả loại phòng</option>
                        <?php if (isset($loaiPhongs) && is_array($loaiPhongs)): ?>
                            <?php foreach ($loaiPhongs as $loaiPhong): ?>
                                <option value="<?= htmlspecialchars($loaiPhong->ma_loai_phong) ?>" <?= ($_GET['room_type'] ?? '') == $loaiPhong->ma_loai_phong ? 'selected' : '' ?>><?= htmlspecialchars($loaiPhong->ten) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                    Tìm kiếm phòng
                </button>
            </form>
        </div>

        <!-- Section 3: Statistics Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-bed"></i>
                </div>
                <div class="stat-number"><?= count($phongs) ?></div>
                <div class="stat-label">Phòng có sẵn</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-number">4.9</div>
                <div class="stat-label">Đánh giá trung bình</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">2,847</div>
                <div class="stat-label">Khách hàng hài lòng</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-award"></i>
                </div>
                <div class="stat-number">5</div>
                <div class="stat-label">Năm kinh nghiệm</div>
            </div>
        </div>

        <!-- Section 4: Rooms Results -->
        <div class="rooms-section" id="search-results">
            <div class="section-header">
                <h2 class="section-title">Phòng Nghỉ Dành Cho Bạn</h2>
                <p class="section-subtitle">
                    Lựa chọn phòng nghỉ phù hợp với nhu cầu và ngân sách của bạn
                </p>
            </div>

            <?php if (isNotEmpty($phongs)): ?>
                <div class="rooms-grid">
                    <?php foreach ($phongs as $index => $phong): ?>
                        <div class="room-card" style="animation-delay: <?= $index * 0.1 ?>s;">
                            <div class="room-image-container">
                                <img src="<?= getFileUrl($phong->anh_bia) ?>"
                                    alt="<?= htmlspecialchars($phong->ten_phong ?? 'Phòng nghỉ') ?>" class="room-image">
                                <div class="room-price"><?= number_format($phong->gia, 0, ',', '.') ?>đ</div>
                            </div>

                            <div class="room-content">
                                <div class="room-header">
                                    <div>
                                        <h3 class="room-title"><?= htmlspecialchars($phong->ten_phong ?? 'Phòng nghỉ') ?></h3>
                                        <div class="room-type">
                                        <?= 
                                            array_find($loaiPhongs, function ($loaiPhong) use ($phong) {
                                                return $loaiPhong->ma_loai_phong === $phong->ma_loai_phong;
                                            })?->ten 
                                        ?>
                                        </div>
                                    </div>
                                </div>

                                <p class="room-description">
                                    <?= htmlspecialchars($phong->mo_ta ?? 'Phòng nghỉ cao cấp với đầy đủ tiện nghi hiện đại, view biển tuyệt đẹp và không gian thoáng mát.') ?>
                                </p>

                                <div class="room-features">
                                    <div class="room-feature">
                                        <i class="fas fa-wifi"></i>
                                        WiFi miễn phí
                                    </div>
                                    <div class="room-feature">
                                        <i class="fas fa-snowflake"></i>
                                        Điều hòa
                                    </div>
                                    <div class="room-feature">
                                        <i class="fas fa-tv"></i>
                                        Smart TV
                                    </div>
                                    <div class="room-feature">
                                        <i class="fas fa-bath"></i>
                                        Phòng tắm riêng
                                    </div>
                                </div>

                                <div class="room-footer">
                                    <div class="room-price-display">
                                        <div class="room-price-amount"><?= number_format($phong->gia, 0, ',', '.') ?>đ</div>
                                        <div class="room-price-unit">mỗi đêm</div>
                                    </div>
                                    <div class="room-actions">
                                        <a href="/phong/show?id=<?= $phong->ma_phong ?>" class="room-btn btn-outline">
                                            <i class="fas fa-eye"></i>
                                            Chi tiết
                                        </a>
                                        <a href="/booking/checkout?room_id=<?= $phong->ma_phong ?>"
                                            class="room-btn btn-primary">
                                            <i class="fas fa-calendar-plus"></i>
                                            Đặt ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h3 class="empty-title">Không tìm thấy phòng phù hợp</h3>
                    <p class="empty-description">
                        Vui lòng thay đổi tiêu chí tìm kiếm hoặc liên hệ với chúng tôi để được hỗ trợ tốt nhất
                    </p>
                    <a href="/contact" class="empty-button">
                        <i class="fas fa-phone"></i>
                        Liên hệ hỗ trợ
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Auto scroll to results if hash present
        if (window.location.hash === '#search-results') {
            const resultBox = document.getElementById('search-results');
            if (resultBox) {
                setTimeout(() => {
                    resultBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 300);
            }
        }

        // Typing effect for hero title
        const heroTitle = document.querySelector('.hero-title');
        if (heroTitle) {
            const titleText = heroTitle.textContent;
            heroTitle.textContent = '';
            heroTitle.style.opacity = '1';

            let i = 0;
            const typeWriter = function () {
                if (i < titleText.length) {
                    heroTitle.textContent += titleText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            };

            setTimeout(typeWriter, 1000);
        }

        // Animate hero stats on scroll
        const heroStats = document.querySelectorAll('.hero-stat-number');
        const animateStats = function () {
            heroStats.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-target')) || parseInt(stat.textContent);
                const current = parseInt(stat.textContent) || 0;
                const increment = target / 100;

                if (current < target) {
                    stat.textContent = Math.ceil(current + increment);
                    setTimeout(animateStats, 20);
                } else {
                    stat.textContent = target;
                }
            });
        };

        // Start animation after page load
        setTimeout(animateStats, 2000);

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Date validation
        const checkinInput = document.querySelector('input[name="checkin"]');
        const checkoutInput = document.querySelector('input[name="checkout"]');

        if (checkinInput && checkoutInput) {
            // Set default dates if empty
            const today = new Date().toISOString().split('T')[0];
            const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];

            if (!checkinInput.value) {
                checkinInput.value = today;
            }
            if (!checkoutInput.value) {
                checkoutInput.value = tomorrow;
            }

            // Update checkout min date when checkin changes
            checkinInput.addEventListener('change', function () {
                const checkinDate = new Date(this.value);
                const minCheckout = new Date(checkinDate.getTime() + 86400000).toISOString().split('T')[0];
                checkoutInput.min = minCheckout;

                if (checkoutInput.value <= this.value) {
                    checkoutInput.value = minCheckout;
                }
            });
        }

        // Form validation & add #search-results to URL
        const searchForm = document.getElementById('search-form');
        if (searchForm) {
            searchForm.addEventListener('submit', function (e) {
                const checkin = checkinInput?.value;
                const checkout = checkoutInput?.value;
                if (checkin && checkout && checkin >= checkout) {
                    e.preventDefault();
                    alert('Ngày trả phòng phải sau ngày nhận phòng!');
                    return false;
                }
                // Thêm #search-results vào url khi submit
                const action = searchForm.getAttribute('action') || window.location.pathname;
                const params = new URLSearchParams(new FormData(searchForm)).toString();
                let url = action + (params ? '?' + params : '');
                url = url.replace(/#.*$/, ''); // Xóa hash cũ nếu có
                url += '#search-results';
                window.location.href = url;
                e.preventDefault();
            });
        }

        // Animate statistics numbers
        function animateNumbers() {
            const numbers = document.querySelectorAll('.stat-number');
            numbers.forEach(number => {
                const finalValue = parseInt(number.textContent.replace(/[^\d]/g, ''));
                if (finalValue && finalValue > 0) {
                    let currentValue = 0;
                    const increment = Math.ceil(finalValue / 50);
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= finalValue) {
                            currentValue = finalValue;
                            clearInterval(timer);
                        }

                        if (finalValue > 1000) {
                            number.textContent = currentValue.toLocaleString('vi-VN');
                        } else {
                            number.textContent = currentValue;
                        }
                    }, 30);
                }
            });
        }

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('stats-section')) {
                        animateNumbers();
                    }

                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe elements for animation
        document.querySelectorAll('.hero-section, .search-section, .stats-section, .rooms-section, .room-card').forEach(el => {
            observer.observe(el);
        });

        // Enhanced card interactions
        document.querySelectorAll('.room-card').forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-12px)';
            });

            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0)';
            });
        });

        // Button ripple effect
        document.querySelectorAll('button, .room-btn, .hero-cta, .empty-button').forEach(button => {
            button.addEventListener('click', function (e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple CSS
        const style = document.createElement('style');
        style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        button, .room-btn, .hero-cta, .empty-button {
            position: relative;
            overflow: hidden;
        }
    `;
        document.head.appendChild(style);

        // Lazy loading for images
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('.room-image').forEach(img => {
            imageObserver.observe(img);
        });

        // Search form auto-suggestion
        const guestsSelect = document.querySelector('select[name="guests"]');
        if (guestsSelect) {
            guestsSelect.addEventListener('change', function () {
                const guests = parseInt(this.value);
                const roomTypeSelect = document.querySelector('select[name="room_type"]');

                if (roomTypeSelect && guests > 4) {
                    // Suggest suite or presidential for large groups
                    if (roomTypeSelect.querySelector('option[value="Suite"]')) {
                        roomTypeSelect.value = 'Suite';
                    }
                }
            });
        }

        // Add parallax effect to hero background
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero-section');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.backgroundPosition = `center ${speed}px`;
            }
        });

        // Animate hero stats numbers
        function animateHeroStats() {
            heroStats.forEach(stat => {
                const finalValue = stat.textContent.replace(/[^\d]/g, '');
                if (finalValue && finalValue > 0) {
                    let currentValue = 0;
                    const increment = Math.ceil(finalValue / 30);
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= finalValue) {
                            currentValue = finalValue;
                            clearInterval(timer);
                        }

                        if (stat.textContent.includes('★')) {
                            stat.textContent = currentValue + '.9★';
                        } else if (stat.textContent.includes('m')) {
                            stat.textContent = currentValue + 'm';
                        } else if (stat.textContent.includes('+')) {
                            stat.textContent = currentValue + '+';
                        } else {
                            stat.textContent = currentValue;
                        }
                    }, 50);
                }
            });
        }
    });
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/app.php';
?>