<?php include_once 'app/Views/layouts/app.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-cyan-500">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">
                        🏨 Quản lý Danh mục Phòng
                    </h1>
                    <p class="text-gray-600">Quản lý các loại phòng và danh mục phòng trong khách sạn</p>
                </div>
                <a href="/danh-muc-phong/create" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Thêm danh mục mới
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm danh mục..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <select class="px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                    <option>Tất cả trạng thái</option>
                    <option>Hoạt động</option>
                    <option>Tạm dừng</option>
                </select>
                <select class="px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                    <option>Sắp xếp theo</option>
                    <option>Tên A-Z</option>
                    <option>Tên Z-A</option>
                    <option>Giá thấp - cao</option>
                    <option>Giá cao - thấp</option>
                    <option>Mới nhất</option>
                </select>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="categoriesGrid">
            <!-- Category Card 1 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 category-card">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&h=300&fit=crop" 
                         alt="Standard Room" class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Hoạt động</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">25 phòng</span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Standard Room</h3>
                        <div class="flex items-center text-yellow-500">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium">4.5</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản, phù hợp cho khách du lịch và công tác. Diện tích 25m² với thiết kế hiện đại và thoải mái.
                    </p>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Diện tích:</span>
                            <span class="font-medium">25m²</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Sức chứa:</span>
                            <span class="font-medium">2 người</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Giá từ:</span>
                            <span class="font-bold text-green-600 text-lg">1,500,000 VNĐ</span>
                        </div>
                    </div>
                    
                    <!-- Features -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-800 mb-2">Tiện nghi:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">WiFi</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">TV</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Điều hòa</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Mini Bar</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="/danh-muc-phong/1" class="flex-1 bg-cyan-500 text-white text-center py-2 rounded-lg hover:bg-cyan-600 transition-colors text-sm font-medium">
                            Xem chi tiết
                        </a>
                        <a href="/danh-muc-phong/1/edit" class="flex-1 bg-blue-500 text-white text-center py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                            Chỉnh sửa
                        </a>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
                            Xóa
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Card 2 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 category-card">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500&h=300&fit=crop" 
                         alt="Deluxe Room" class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Hoạt động</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">18 phòng</span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Deluxe Room</h3>
                        <div class="flex items-center text-yellow-500">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium">4.8</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Phòng cao cấp với view biển tuyệt đẹp và ban công riêng. Thiết kế sang trọng với đầy đủ tiện nghi hiện đại cho trải nghiệm tuyệt vời.
                    </p>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Diện tích:</span>
                            <span class="font-medium">35m²</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Sức chứa:</span>
                            <span class="font-medium">2-3 người</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Giá từ:</span>
                            <span class="font-bold text-green-600 text-lg">2,800,000 VNĐ</span>
                        </div>
                    </div>
                    
                    <!-- Features -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-800 mb-2">Tiện nghi:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">WiFi</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Smart TV</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Ban công</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">View biển</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Bồn tắm</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="/danh-muc-phong/2" class="flex-1 bg-cyan-500 text-white text-center py-2 rounded-lg hover:bg-cyan-600 transition-colors text-sm font-medium">
                            Xem chi tiết
                        </a>
                        <a href="/danh-muc-phong/2/edit" class="flex-1 bg-blue-500 text-white text-center py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                            Chỉnh sửa
                        </a>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
                            Xóa
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Card 3 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 category-card">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=500&h=300&fit=crop" 
                         alt="Suite Room" class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Hoạt động</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">8 phòng</span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Suite Room</h3>
                        <div class="flex items-center text-yellow-500">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium">4.9</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Phòng suite cao cấp với phòng khách riêng biệt, phòng ngủ rộng rãi và đầy đủ tiện nghi đẳng cấp 5 sao. Phù hợp cho gia đình và nhóm khách VIP.
                    </p>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Diện tích:</span>
                            <span class="font-medium">60m²</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Sức chứa:</span>
                            <span class="font-medium">4-6 người</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Giá từ:</span>
                            <span class="font-bold text-green-600 text-lg">5,500,000 VNĐ</span>
                        </div>
                    </div>
                    
                    <!-- Features -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-800 mb-2">Tiện nghi:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Phòng khách</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Bếp nhỏ</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Jacuzzi</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Butler</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="/danh-muc-phong/3" class="flex-1 bg-cyan-500 text-white text-center py-2 rounded-lg hover:bg-cyan-600 transition-colors text-sm font-medium">
                            Xem chi tiết
                        </a>
                        <a href="/danh-muc-phong/3/edit" class="flex-1 bg-blue-500 text-white text-center py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                            Chỉnh sửa
                        </a>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
                            Xóa
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Card 4 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 category-card">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=500&h=300&fit=crop" 
                         alt="Presidential Suite" class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">Tạm dừng</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-medium">2 phòng</span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Presidential Suite</h3>
                        <div class="flex items-center text-yellow-500">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium">5.0</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Phòng tổng thống đẳng cấp cao nhất với không gian sống hoàn chỉnh, dịch vụ butler 24/7 và các tiện ích độc quyền dành cho khách VIP.
                    </p>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Diện tích:</span>
                            <span class="font-medium">120m²</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Sức chứa:</span>
                            <span class="font-medium">8-10 người</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Giá từ:</span>
                            <span class="font-bold text-green-600 text-lg">15,000,000 VNĐ</span>
                        </div>
                    </div>
                    
                    <!-- Features -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-800 mb-2">Tiện nghi:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Sân thượng</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Bể bơi riêng</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Butler 24/7</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-xs">Phòng gym</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="/danh-muc-phong/4" class="flex-1 bg-cyan-500 text-white text-center py-2 rounded-lg hover:bg-cyan-600 transition-colors text-sm font-medium">
                            Xem chi tiết
                        </a>
                        <a href="/danh-muc-phong/4/edit" class="flex-1 bg-blue-500 text-white text-center py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                            Chỉnh sửa
                        </a>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
                            Xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <nav class="flex items-center space-x-2">
                <button class="px-4 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 disabled:opacity-50">
                    Trước
                </button>
                <button class="px-4 py-2 text-white bg-cyan-500 border border-cyan-500 rounded-lg">1</button>
                <button class="px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">2</button>
                <button class="px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    Sau
                </button>
            </nav>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-cyan-100">Tổng danh mục</p>
                        <p class="text-3xl font-bold" id="totalCategories">4</p>
                    </div>
                    <svg class="w-12 h-12 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Tổng phòng</p>
                        <p class="text-3xl font-bold" id="totalRooms">53</p>
                    </div>
                    <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v0"/>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100">Phòng trống</p>
                        <p class="text-3xl font-bold" id="availableRooms">37</p>
                    </div>
                    <svg class="w-12 h-12 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100">Doanh thu/ngày</p>
                        <p class="text-3xl font-bold" id="dailyRevenue">125M</p>
                    </div>
                    <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const categoryCards = document.querySelectorAll('.category-card');
    
    categoryCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('p').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in-out';
        } else {
            card.style.display = 'none';
        }
    });
});

// Animate numbers
function animateNumber(element, target) {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 30);
}

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    animateNumber(document.getElementById('totalCategories'), 4);
    animateNumber(document.getElementById('totalRooms'), 53);
    animateNumber(document.getElementById('availableRooms'), 37);
});

// CSS Animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
`;
document.head.appendChild(style);
</script>
