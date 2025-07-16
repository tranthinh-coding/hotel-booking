<?php
$title = 'Danh sách dịch vụ - Hotel Ocean';
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
        animation: fadeInUp 0.8s ease-out;
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

    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .hero-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #059669, #047857);
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
        animation: fadeInUp 0.8s ease-out 0.2s;
        animation-fill-mode: both;
    }

    .search-header {
        text-align: center;
        margin-bottom: 24px;
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
        grid-template-columns: 1fr auto;
        gap: 20px;
        align-items: end;
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
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        transform: translateY(-1px);
    }

    .search-button {
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
        white-space: nowrap;
    }

    .search-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(14, 165, 233, 0.4);
        background: linear-gradient(135deg, #0284c7, #0369a1);
    }

    /* Results Header */
    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px 24px;
        border-radius: 16px;
        border: 1px solid rgba(14, 165, 233, 0.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        animation: slideIn 0.6s ease-out 0.4s;
        animation-fill-mode: both;
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

    /* Services Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 32px;
        margin-bottom: 48px;
    }

    .service-card {
        background: white;
        border: 1px solid rgba(14, 165, 233, 0.1);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        position: relative;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(14, 165, 233, 0.15);
        border-color: rgba(14, 165, 233, 0.3);
    }

    .service-icon-section {
        height: 160px;
        background: linear-gradient(135deg, #0ea5e9, #0284c7, #0369a1);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .service-icon-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.2) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .service-card:hover .service-icon-section::before {
        transform: translateX(100%);
    }

    .service-icon {
        font-size: 3rem;
        color: white;
        position: relative;
        z-index: 2;
    }

    .service-content {
        padding: 28px;
    }

    .service-header {
        margin-bottom: 20px;
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .service-category {
        color: #0ea5e9;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .service-price {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        padding: 16px;
        background: rgba(14, 165, 233, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(14, 165, 233, 0.1);
    }

    .price-amount {
        font-size: 1.875rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0c4a6e, #0369a1);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-right: 8px;
    }

    .price-currency {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
    }

    .service-footer {
        display: flex;
        gap: 12px;
    }

    .service-button {
        flex: 1;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-view {
        background: rgba(14, 165, 233, 0.1);
        color: #0369a1;
        border: 1px solid rgba(14, 165, 233, 0.2);
    }

    .btn-view:hover {
        background: rgba(14, 165, 233, 0.15);
        transform: translateY(-1px);
    }

    .btn-contact {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-contact:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #059669, #047857);
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
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .empty-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #059669, #047857);
    }

    /* Animation keyframes */
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

    .service-card:nth-child(1) { animation-delay: 0.1s; }
    .service-card:nth-child(2) { animation-delay: 0.2s; }
    .service-card:nth-child(3) { animation-delay: 0.3s; }
    .service-card:nth-child(4) { animation-delay: 0.4s; }
    .service-card:nth-child(5) { animation-delay: 0.5s; }
    .service-card:nth-child(6) { animation-delay: 0.6s; }

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
            gap: 16px;
        }

        .services-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .results-header {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .service-content {
            padding: 20px;
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

        .service-footer {
            flex-direction: column;
        }
    }
</style>

<div class="main-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-concierge-bell"></i>
                Ocean Pearl Hotel
            </div>
            <h1 class="hero-title">Dịch Vụ Đẳng Cấp 5 Sao</h1>
            <p class="hero-subtitle">
                Khám phá các dịch vụ cao cấp tại khách sạn của chúng tôi
                với chất lượng phục vụ chuyên nghiệp và tận tâm
            </p>
            <a href="/contact" class="hero-cta">
                <i class="fas fa-calendar-check"></i>
                Liên hệ tư vấn
            </a>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-container">
        <div class="search-header">
            <h2 class="search-title">Tìm Kiếm Dịch Vụ</h2>
            <p class="search-description">Nhập tên dịch vụ để tìm kiếm nhanh chóng</p>
        </div>
        
        <form method="GET" action="/dich-vu">
            <div class="search-grid">
                <input type="text" 
                       name="search" 
                       class="input-field"
                       placeholder="Tìm kiếm dịch vụ..."
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                
                <button type="submit" class="search-button">
                    <i class="fas fa-search"></i>
                    Tìm kiếm
                </button>
            </div>
        </form>
    </div>

    <!-- Results Section -->
    <?php if (isNotEmpty($dichVus)): ?>
        <div class="results-header">
            <div class="results-count">
                Tìm thấy <span class="number"><?= count($dichVus) ?></span> dịch vụ
            </div>
        </div>

        <div class="services-grid">
            <?php foreach ($dichVus as $dichVu): ?>
                <div class="service-card">
                    <div class="service-icon-section">
                        <i class="fas fa-concierge-bell service-icon"></i>
                    </div>
                    
                    <div class="service-content">
                        <div class="service-header">
                            <h3 class="service-title">
                                <?= htmlspecialchars($dichVu->ten_dich_vu) ?>
                            </h3>
                            <div class="service-category">
                                Dịch vụ cao cấp
                            </div>
                        </div>

                        <div class="service-price">
                            <div class="price-amount">
                                <?= number_format($dichVu->gia, 0, ',', '.') ?>
                            </div>
                            <div class="price-currency">VNĐ</div>
                        </div>

                        <div class="service-footer">
                            <a href="/dich-vu/show/<?= $dichVu->ma_dich_vu ?>" class="service-button btn-view">
                                <i class="fas fa-eye"></i>
                                Xem chi tiết
                            </a>
                            <a href="/contact" class="service-button btn-contact">
                                <i class="fas fa-phone"></i>
                                Liên hệ
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <h3 class="empty-title">Hiện tại chưa có dịch vụ nào</h3>
            <p class="empty-description">
                Vui lòng quay lại sau hoặc liên hệ với chúng tôi để biết thêm thông tin
            </p>
            <a href="/contact" class="empty-button">
                <i class="fas fa-phone"></i>
                Liên hệ tư vấn
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    // Search functionality
    document.querySelector('form')?.addEventListener('submit', function(e) {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput.value.trim() === '') {
            e.preventDefault();
            searchInput.focus();
            searchInput.style.borderColor = '#ef4444';
            setTimeout(() => {
                searchInput.style.borderColor = '#e2e8f0';
            }, 2000);
        }
    });

    // Auto search on input
    let searchTimeout;
    document.querySelector('input[name="search"]')?.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (this.value.length >= 2 || this.value.length === 0) {
                this.form.submit();
            }
        }, 500);
    });

    // Service card interactions
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
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

    // Apply animations to service cards
    document.querySelectorAll('.service-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });

    // Button click effects
    document.querySelectorAll('.service-button, .search-button, .hero-cta, .empty-button').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.6)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.left = (e.clientX - e.target.offsetLeft) + 'px';
            ripple.style.top = (e.clientY - e.target.offsetTop) + 'px';
            ripple.style.width = ripple.style.height = '20px';
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add ripple animation CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Smooth scroll for anchor links
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

    // Enhanced price animation
    document.querySelectorAll('.price-amount').forEach(price => {
        const finalValue = parseInt(price.textContent.replace(/[^\d]/g, ''));
        let currentValue = 0;
        const increment = finalValue / 50;
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                currentValue = finalValue;
                clearInterval(timer);
            }
            price.textContent = Math.floor(currentValue).toLocaleString('vi-VN');
        }, 20);
    });
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/app.php';
?>
