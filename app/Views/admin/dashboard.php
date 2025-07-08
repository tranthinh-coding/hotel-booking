<?php include_once 'app/Views/layouts/app.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Header -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-cyan-500">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">
                        👨‍💼 Dashboard Quản trị
                    </h1>
                    <p class="text-gray-600">Chào mừng trở lại! Tổng quan hoạt động khách sạn hôm nay</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Hôm nay</p>
                        <p class="text-lg font-semibold text-gray-800" id="currentDate"></p>
                    </div>
                    <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Xuất báo cáo
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Doanh thu hôm nay</p>
                        <p class="text-3xl font-bold" id="todayRevenue">0</p>
                        <p class="text-green-200 text-sm mt-1">+12% so với hôm qua</p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 p-3 rounded-full">
                        <svg class="w-8 h-8 text-green-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Đặt phòng hôm nay</p>
                        <p class="text-3xl font-bold" id="todayBookings">0</p>
                        <p class="text-blue-200 text-sm mt-1">+8% so với hôm qua</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m0 0V7a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V9a2 2 0 012-2m8 0V7a2 2 0 00-2-2H8a2 2 0 00-2 2v0"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Tỷ lệ lấp đầy</p>
                        <p class="text-3xl font-bold" id="occupancyRate">0%</p>
                        <p class="text-purple-200 text-sm mt-1">72/100 phòng</p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 p-3 rounded-full">
                        <svg class="w-8 h-8 text-purple-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v0"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm">Khách hàng mới</p>
                        <p class="text-3xl font-bold" id="newCustomers">0</p>
                        <p class="text-orange-200 text-sm mt-1">+25% so với tuần trước</p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 p-3 rounded-full">
                        <svg class="w-8 h-8 text-orange-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Doanh thu 7 ngày gần đây</h2>
                    <select class="px-3 py-2 border border-gray-200 rounded-lg text-sm">
                        <option>7 ngày</option>
                        <option>30 ngày</option>
                        <option>3 tháng</option>
                    </select>
                </div>
                <div class="h-64 flex items-end justify-between space-x-2">
                    <div class="flex flex-col items-center">
                        <div class="bg-cyan-500 w-8 rounded-t" style="height: 60%"></div>
                        <span class="text-xs text-gray-500 mt-2">T2</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-cyan-500 w-8 rounded-t" style="height: 80%"></div>
                        <span class="text-xs text-gray-500 mt-2">T3</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-cyan-500 w-8 rounded-t" style="height: 45%"></div>
                        <span class="text-xs text-gray-500 mt-2">T4</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-cyan-500 w-8 rounded-t" style="height: 90%"></div>
                        <span class="text-xs text-gray-500 mt-2">T5</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-cyan-500 w-8 rounded-t" style="height: 75%"></div>
                        <span class="text-xs text-gray-500 mt-2">T6</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-cyan-500 w-8 rounded-t" style="height: 95%"></div>
                        <span class="text-xs text-gray-500 mt-2">T7</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-blue-500 w-8 rounded-t" style="height: 85%"></div>
                        <span class="text-xs text-gray-500 mt-2">CN</span>
                    </div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-4">
                    <span>0M</span>
                    <span>50M</span>
                    <span>100M</span>
                </div>
            </div>

            <!-- Booking Chart -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Loại phòng được đặt nhiều nhất</h2>
                    <button class="text-cyan-500 text-sm hover:text-cyan-700">Xem tất cả</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-cyan-500 rounded mr-3"></div>
                            <span class="text-gray-700">Deluxe Room</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-cyan-100 rounded-full px-3 py-1 text-cyan-800 text-sm font-medium mr-2">45%</div>
                            <span class="text-gray-600 text-sm">128 đặt</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded mr-3"></div>
                            <span class="text-gray-700">Standard Room</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-full px-3 py-1 text-blue-800 text-sm font-medium mr-2">30%</div>
                            <span class="text-gray-600 text-sm">85 đặt</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded mr-3"></div>
                            <span class="text-gray-700">Suite Room</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-green-100 rounded-full px-3 py-1 text-green-800 text-sm font-medium mr-2">20%</div>
                            <span class="text-gray-600 text-sm">57 đặt</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-purple-500 rounded mr-3"></div>
                            <span class="text-gray-700">Presidential Suite</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-purple-100 rounded-full px-3 py-1 text-purple-800 text-sm font-medium mr-2">5%</div>
                            <span class="text-gray-600 text-sm">14 đặt</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Recent Bookings -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Đặt phòng gần đây</h2>
                    <a href="/hoa-don" class="text-cyan-500 text-sm hover:text-cyan-700">Xem tất cả</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-cyan-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                NH
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Nguyễn Văn Huy</p>
                                <p class="text-sm text-gray-500">Deluxe Room • 2 đêm</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-800">5,600,000 VNĐ</p>
                            <p class="text-sm text-green-600">Đã thanh toán</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                LM
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Lê Thị Mai</p>
                                <p class="text-sm text-gray-500">Standard Room • 3 đêm</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-800">4,500,000 VNĐ</p>
                            <p class="text-sm text-yellow-600">Chờ thanh toán</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                PT
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Phạm Minh Tuấn</p>
                                <p class="text-sm text-gray-500">Suite Room • 1 đêm</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-800">5,500,000 VNĐ</p>
                            <p class="text-sm text-green-600">Đã thanh toán</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                VT
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Vũ Thị Thanh</p>
                                <p class="text-sm text-gray-500">Deluxe Room • 4 đêm</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-800">11,200,000 VNĐ</p>
                            <p class="text-sm text-red-600">Đã hủy</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Thao tác nhanh</h2>
                <div class="space-y-4">
                    <a href="/hoa-don/create" class="flex items-center w-full p-4 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-lg hover:from-cyan-600 hover:to-blue-600 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tạo đặt phòng mới
                    </a>
                    
                    <a href="/phong" class="flex items-center w-full p-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v0"/>
                        </svg>
                        Quản lý phòng
                    </a>
                    
                    <a href="/tai-khoan" class="flex items-center w-full p-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Quản lý khách hàng
                    </a>
                    
                    <a href="/danh-gia" class="flex items-center w-full p-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-yellow-600 hover:to-orange-600 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Xem đánh giá
                    </a>
                    
                    <a href="/tin-tuc/create" class="flex items-center w-full p-4 bg-gradient-to-r from-indigo-500 to-blue-500 text-white rounded-lg hover:from-indigo-600 hover:to-blue-600 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/>
                        </svg>
                        Đăng tin tức
                    </a>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Trạng thái hệ thống</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-800 font-medium">Hệ thống đặt phòng</p>
                            <p class="text-green-600 text-sm">Hoạt động bình thường</p>
                        </div>
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                </div>
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-800 font-medium">Cổng thanh toán</p>
                            <p class="text-green-600 text-sm">Hoạt động bình thường</p>
                        </div>
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                </div>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-800 font-medium">Email service</p>
                            <p class="text-yellow-600 text-sm">Chậm hơn bình thường</p>
                        </div>
                        <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Set current date
document.getElementById('currentDate').textContent = new Date().toLocaleDateString('vi-VN', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
});

// Animate numbers
function animateNumber(element, target, suffix = '') {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target.toLocaleString('vi-VN') + suffix;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current).toLocaleString('vi-VN') + suffix;
        }
    }, 20);
}

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate statistics
    setTimeout(() => {
        animateNumber(document.getElementById('todayRevenue'), 45600000, ' VNĐ');
    }, 500);
    
    setTimeout(() => {
        animateNumber(document.getElementById('todayBookings'), 23);
    }, 700);
    
    setTimeout(() => {
        animateNumber(document.getElementById('occupancyRate'), 72, '%');
    }, 900);
    
    setTimeout(() => {
        animateNumber(document.getElementById('newCustomers'), 156);
    }, 1100);
});

// Auto refresh data every 5 minutes
setInterval(() => {
    // Simulate data refresh
    console.log('Refreshing dashboard data...');
}, 300000);
</script>
