<?php include_once 'app/Views/layouts/app.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">
                        📖 Chi tiết tin tức
                    </h1>
                    <p class="text-gray-600">Xem thông tin chi tiết bài viết</p>
                </div>
                <div class="flex space-x-3">
                    <a href="/tin-tuc" 
                       class="inline-flex items-center px-6 py-3 bg-gray-500 text-white font-semibold rounded-xl hover:bg-gray-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Quay lại
                    </a>
                    <a href="/tin-tuc/1/edit" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-indigo-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Article Content -->
                <article class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <!-- Featured Image -->
                    <div class="relative h-96 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=400&fit=crop" 
                             alt="Khuyến mãi mùa lễ hội" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="flex items-center space-x-4 text-white mb-4">
                                <span class="bg-green-500 px-3 py-1 rounded-full text-sm font-medium">Đã xuất bản</span>
                                <span class="bg-cyan-500 px-3 py-1 rounded-full text-sm font-medium">Khuyến mãi</span>
                            </div>
                            <h1 class="text-3xl lg:text-4xl font-bold text-white leading-tight">
                                Khuyến mãi đặc biệt mùa lễ hội - Giảm giá 30% cho tất cả phòng
                            </h1>
                        </div>
                    </div>

                    <!-- Article Info -->
                    <div class="p-8">
                        <div class="flex flex-wrap items-center text-sm text-gray-500 mb-6 space-x-6">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Tác giả: Admin
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m0 0V7a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V9a2 2 0 012-2m8 0V7a2 2 0 00-2-2H8a2 2 0 00-2 2v0"/>
                                </svg>
                                15/12/2024 10:30
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                1,234 lượt xem
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                5 phút đọc
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div class="prose prose-lg max-w-none">
                            <div class="text-xl text-gray-600 mb-6 leading-relaxed">
                                Nhân dịp lễ hội cuối năm, khách sạn chúng tôi dành tặng chương trình khuyến mãi đặc biệt với mức giảm giá lên đến 30% cho tất cả các loại phòng. Đây là cơ hội tuyệt vời để bạn và gia đình có những kỳ nghỉ đáng nhớ tại khách sạn.
                            </div>

                            <h2 class="text-2xl font-bold text-gray-800 mb-4 mt-8">🎉 Chi tiết chương trình khuyến mãi</h2>
                            
                            <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-6 rounded-xl mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin ưu đãi:</h3>
                                <ul class="space-y-2 text-gray-700">
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <strong>Giảm giá 30%</strong> cho tất cả loại phòng
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Thời gian áp dụng: <strong>20/12/2024 - 05/01/2025</strong>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Áp dụng cho cả khách hàng mới và thành viên
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Miễn phí bữa sáng cho trẻ em dưới 12 tuổi
                                    </li>
                                </ul>
                            </div>

                            <p class="text-gray-700 leading-relaxed mb-6">
                                Chương trình khuyến mãi này được áp dụng cho tất cả các loại phòng từ phòng Standard cho đến phòng Presidential Suite. Quý khách có thể tận hưởng không gian nghỉ dưỡng cao cấp với đầy đủ tiện nghi hiện đại, cùng với dịch vụ chăm sóc khách hàng tận tâm của đội ngũ nhân viên chuyên nghiệp.
                            </p>

                            <h2 class="text-2xl font-bold text-gray-800 mb-4 mt-8">🏨 Các loại phòng áp dụng</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">Standard Room</h4>
                                    <p class="text-gray-600 text-sm mb-2">Phòng tiêu chuẩn với đầy đủ tiện nghi cơ bản</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-red-500 line-through">2,000,000 VNĐ</span>
                                        <span class="text-green-600 font-bold">1,400,000 VNĐ</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">Deluxe Room</h4>
                                    <p class="text-gray-600 text-sm mb-2">Phòng cao cấp với view biển và ban công riêng</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-red-500 line-through">3,500,000 VNĐ</span>
                                        <span class="text-green-600 font-bold">2,450,000 VNĐ</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">Suite Room</h4>
                                    <p class="text-gray-600 text-sm mb-2">Phòng suite rộng rãi với phòng khách riêng</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-red-500 line-through">5,000,000 VNĐ</span>
                                        <span class="text-green-600 font-bold">3,500,000 VNĐ</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">Presidential Suite</h4>
                                    <p class="text-gray-600 text-sm mb-2">Phòng tổng thống với đầy đủ tiện nghi cao cấp</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-red-500 line-through">10,000,000 VNĐ</span>
                                        <span class="text-green-600 font-bold">7,000,000 VNĐ</span>
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-2xl font-bold text-gray-800 mb-4 mt-8">📞 Cách thức đặt phòng</h2>
                            
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Để tận dụng ưu đãi này, quý khách có thể đặt phòng qua các kênh sau:
                            </p>
                            
                            <div class="bg-gray-50 p-6 rounded-xl mb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-3">Liên hệ trực tiếp:</h4>
                                        <div class="space-y-2 text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                Hotline: 1900-1234
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                Email: booking@hotel.com
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-3">Đặt phòng online:</h4>
                                        <div class="space-y-2 text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"/>
                                                </svg>
                                                Website: www.hotel.com
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                                Mobile App: Hotel Booking
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-6">
                                <div class="flex">
                                    <svg class="w-6 h-6 text-yellow-400 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-yellow-800 mb-2">Lưu ý quan trọng:</h4>
                                        <ul class="text-yellow-700 space-y-1">
                                            <li>• Ưu đãi có giới hạn số lượng phòng</li>
                                            <li>• Cần đặt trước ít nhất 3 ngày</li>
                                            <li>• Không áp dụng cùng với các chương trình khuyến mãi khác</li>
                                            <li>• Có thể hủy miễn phí trước 24h check-in</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <p class="text-gray-700 leading-relaxed">
                                Đừng bỏ lỡ cơ hội tuyệt vời này! Hãy liên hệ với chúng tôi ngay hôm nay để đặt phòng và tận hưởng kỳ nghỉ đáng nhớ với mức giá ưu đãi đặc biệt. Đội ngũ nhân viên của chúng tôi luôn sẵn sàng hỗ trợ và tư vấn để mang đến cho bạn trải nghiệm nghỉ dưỡng tuyệt vời nhất.
                            </p>
                        </div>

                        <!-- Social Sharing -->
                        <div class="border-t border-gray-200 pt-6 mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Chia sẻ bài viết:</h3>
                            <div class="flex space-x-4">
                                <button class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                    Twitter
                                </button>
                                <button class="flex items-center px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    Facebook
                                </button>
                                <button class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                    LinkedIn
                                </button>
                                <button class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    Sao chép link
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Article Info -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Thông tin bài viết</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID:</span>
                            <span class="font-medium">#TT001</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Trạng thái:</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Đã xuất bản</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Danh mục:</span>
                            <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full text-sm">Khuyến mãi</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ngày tạo:</span>
                            <span class="font-medium">15/12/2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Lần sửa cuối:</span>
                            <span class="font-medium">15/12/2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Lượt xem:</span>
                            <span class="font-medium">1,234</span>
                        </div>
                    </div>
                </div>

                <!-- Related Articles -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tin tức liên quan</h3>
                    <div class="space-y-4">
                        <div class="flex space-x-3">
                            <img src="https://images.unsplash.com/photo-1520637736862-4d197d17c90a?w=100&h=80&fit=crop" 
                                 alt="Related news" class="w-16 h-12 object-cover rounded-lg">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-800 line-clamp-2 mb-1">
                                    Gala dinner đón năm mới 2025 - Đêm tiệc hoành tráng
                                </h4>
                                <p class="text-xs text-gray-500">20/12/2024</p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-3">
                            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=100&h=80&fit=crop" 
                                 alt="Related news" class="w-16 h-12 object-cover rounded-lg">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-800 line-clamp-2 mb-1">
                                    Khách sạn đạt chứng nhận 5 sao quốc tế
                                </h4>
                                <p class="text-xs text-gray-500">18/12/2024</p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-3">
                            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=100&h=80&fit=crop" 
                                 alt="Related news" class="w-16 h-12 object-cover rounded-lg">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-800 line-clamp-2 mb-1">
                                    Spa mới với các liệu pháp thư giãn độc đáo
                                </h4>
                                <p class="text-xs text-gray-500">22/12/2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Thao tác nhanh</h3>
                    <div class="space-y-3">
                        <button class="w-full flex items-center justify-center px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Chỉnh sửa
                        </button>
                        <button class="w-full flex items-center justify-center px-4 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Sao chép
                        </button>
                        <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                            </svg>
                            Ẩn bài viết
                        </button>
                        <button class="w-full flex items-center justify-center px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Xóa bài viết
                        </button>
                    </div>
                </div>

                <!-- Tags -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Từ khóa</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm">khuyến mãi</span>
                        <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm">lễ hội</span>
                        <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm">giảm giá</span>
                        <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm">đặt phòng</span>
                        <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm">khách sạn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose h2 {
    color: #1f2937;
    font-weight: bold;
}

.prose h3 {
    color: #374151;
    font-weight: 600;
}

.prose h4 {
    color: #4b5563;
    font-weight: 600;
}
</style>
