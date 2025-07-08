<?php include_once 'app/Views/layouts/app.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">
                        ✏️ Chỉnh sửa tin tức
                    </h1>
                    <p class="text-gray-600">Cập nhật thông tin bài viết</p>
                </div>
                <div class="flex space-x-3">
                    <a href="/tin-tuc/1" 
                       class="inline-flex items-center px-6 py-3 bg-gray-500 text-white font-semibold rounded-xl hover:bg-gray-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Xem chi tiết
                    </a>
                    <a href="/tin-tuc" 
                       class="inline-flex items-center px-6 py-3 bg-cyan-500 text-white font-semibold rounded-xl hover:bg-cyan-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <form id="editNewsForm" class="space-y-0">
                <!-- Basic Information -->
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Thông tin cơ bản
                    </h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề *</label>
                            <input type="text" id="title" required value="Khuyến mãi đặc biệt mùa lễ hội - Giảm giá 30% cho tất cả phòng"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300"
                                   placeholder="Nhập tiêu đề tin tức...">
                            <div class="text-sm text-gray-500 mt-1">
                                <span id="titleCount">70</span>/100 ký tự
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục *</label>
                            <select id="category" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                                <option value="">Chọn danh mục</option>
                                <option value="promotion" selected>Khuyến mãi</option>
                                <option value="event">Sự kiện</option>
                                <option value="announcement">Thông báo</option>
                                <option value="news">Tin tức chung</option>
                                <option value="review">Đánh giá</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái *</label>
                            <select id="status" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                                <option value="draft">Bản nháp</option>
                                <option value="published" selected>Đã xuất bản</option>
                                <option value="hidden">Đã ẩn</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ngày xuất bản</label>
                            <input type="datetime-local" id="publishDate" value="2024-12-15T10:30"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tác giả</label>
                            <input type="text" id="author" value="Admin"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300"
                                   placeholder="Tên tác giả">
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Nội dung bài viết
                    </h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả ngắn *</label>
                            <textarea id="excerpt" rows="3" required
                                      class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300 resize-none"
                                      placeholder="Nhập mô tả ngắn về tin tức...">Nhân dịp lễ hội cuối năm, khách sạn chúng tôi dành tặng chương trình khuyến mãi đặc biệt với mức giảm giá lên đến 30% cho tất cả các loại phòng. Đây là cơ hội tuyệt vời để bạn và gia đình có những kỳ nghỉ đáng nhớ tại khách sạn.</textarea>
                            <div class="text-sm text-gray-500 mt-1">
                                <span id="excerptCount">250</span>/300 ký tự
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung chi tiết *</label>
                            <div class="border border-gray-200 rounded-lg">
                                <!-- Toolbar -->
                                <div class="border-b border-gray-200 p-3 bg-gray-50 rounded-t-lg">
                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-white rounded" onclick="formatText('bold')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-white rounded" onclick="formatText('italic')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4l4 16"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-white rounded" onclick="formatText('underline')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l6 0M9 4v8a3 3 0 006 0V4"/>
                                            </svg>
                                        </button>
                                        <div class="border-l border-gray-300 mx-2"></div>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-white rounded" onclick="insertList('ul')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-white rounded" onclick="insertList('ol')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <textarea id="content" rows="15" required
                                          class="w-full px-4 py-3 border-0 rounded-b-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300 resize-none"
                                          placeholder="Nhập nội dung chi tiết tin tức...">🎉 Chi tiết chương trình khuyến mãi

Chương trình khuyến mãi này được áp dụng cho tất cả các loại phòng từ phòng Standard cho đến phòng Presidential Suite. Quý khách có thể tận hưởng không gian nghỉ dưỡng cao cấp với đầy đủ tiện nghi hiện đại, cùng với dịch vụ chăm sóc khách hàng tận tâm của đội ngũ nhân viên chuyên nghiệp.

Thông tin ưu đãi:
• Giảm giá 30% cho tất cả loại phòng
• Thời gian áp dụng: 20/12/2024 - 05/01/2025
• Áp dụng cho cả khách hàng mới và thành viên
• Miễn phí bữa sáng cho trẻ em dưới 12 tuổi

🏨 Các loại phòng áp dụng

Standard Room - Giá từ 1,400,000 VNĐ (giá gốc: 2,000,000 VNĐ)
Deluxe Room - Giá từ 2,450,000 VNĐ (giá gốc: 3,500,000 VNĐ)
Suite Room - Giá từ 3,500,000 VNĐ (giá gốc: 5,000,000 VNĐ)
Presidential Suite - Giá từ 7,000,000 VNĐ (giá gốc: 10,000,000 VNĐ)

📞 Cách thức đặt phòng

Để tận dụng ưu đãi này, quý khách có thể đặt phòng qua:
• Hotline: 1900-1234
• Email: booking@hotel.com
• Website: www.hotel.com
• Mobile App: Hotel Booking

Lưu ý quan trọng:
• Ưu đãi có giới hạn số lượng phòng
• Cần đặt trước ít nhất 3 ngày
• Không áp dụng cùng với các chương trình khuyến mãi khác
• Có thể hủy miễn phí trước 24h check-in

Đừng bỏ lỡ cơ hội tuyệt vời này! Hãy liên hệ với chúng tôi ngay hôm nay để đặt phòng và tận hưởng kỳ nghỉ đáng nhớ với mức giá ưu đãi đặc biệt.</textarea>
                            </div>
                            <div class="text-sm text-gray-500 mt-1">
                                <span id="contentCount">1540</span> ký tự
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media Section -->
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Hình ảnh
                    </h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện *</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-cyan-400 transition-colors duration-300">
                                <div id="imagePreview">
                                    <img id="previewImg" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=250&fit=crop" alt="Preview" class="mx-auto max-h-48 rounded-lg shadow-lg">
                                    <button type="button" onclick="removeImage()" class="mt-4 text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Thay đổi ảnh
                                    </button>
                                </div>
                                <div id="uploadArea" class="hidden">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="mt-4">
                                        <label for="featuredImage" class="cursor-pointer">
                                            <span class="mt-2 block text-sm font-medium text-gray-900">Chọn ảnh đại diện</span>
                                            <span class="mt-2 block text-sm text-gray-500">PNG, JPG, GIF lên đến 5MB</span>
                                        </label>
                                        <input id="featuredImage" name="featuredImage" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL ảnh (thay thế)</label>
                            <input type="url" id="imageUrl" value="https://images.unsplash.com/photo-1566073771259-6a8506099945"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300"
                                   placeholder="https://example.com/image.jpg">
                        </div>
                    </div>
                </div>

                <!-- SEO Section -->
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Tối ưu SEO
                    </h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <input type="text" id="metaTitle" value="Khuyến mãi mùa lễ hội - Giảm giá 30% khách sạn"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300"
                                   placeholder="Tiêu đề SEO cho trang tin tức">
                            <div class="text-sm text-gray-500 mt-1">
                                <span id="metaTitleCount">50</span>/60 ký tự (khuyến nghị)
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Từ khóa</label>
                            <input type="text" id="keywords" value="khuyến mãi, khách sạn, giảm giá, lễ hội, đặt phòng"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300"
                                   placeholder="khách sạn, tin tức, khuyến mãi">
                        </div>
                        
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <textarea id="metaDescription" rows="3"
                                      class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300 resize-none"
                                      placeholder="Mô tả ngắn gọn về tin tức này để hiển thị trong kết quả tìm kiếm">Chương trình khuyến mãi đặc biệt mùa lễ hội với giảm giá 30% tất cả phòng. Đặt ngay để tận hưởng kỳ nghỉ tuyệt vời tại khách sạn 5 sao.</textarea>
                            <div class="text-sm text-gray-500 mt-1">
                                <span id="metaDescCount">140</span>/160 ký tự (khuyến nghị)
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revision History -->
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Lịch sử chỉnh sửa
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-cyan-500 rounded-full flex items-center justify-center text-white text-sm font-medium mr-3">
                                        A
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Admin</p>
                                        <p class="text-sm text-gray-500">15/12/2024 10:30</p>
                                    </div>
                                </div>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Xuất bản</span>
                            </div>
                            <p class="text-gray-700 text-sm">Xuất bản bài viết lần đầu</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium mr-3">
                                        A
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Admin</p>
                                        <p class="text-sm text-gray-500">15/12/2024 09:45</p>
                                    </div>
                                </div>
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Chỉnh sửa</span>
                            </div>
                            <p class="text-gray-700 text-sm">Cập nhật thông tin giá phòng và thời gian khuyến mãi</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-500 rounded-full flex items-center justify-center text-white text-sm font-medium mr-3">
                                        A
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Admin</p>
                                        <p class="text-sm text-gray-500">14/12/2024 16:20</p>
                                    </div>
                                </div>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">Tạo mới</span>
                            </div>
                            <p class="text-gray-700 text-sm">Tạo bài viết mới với tiêu đề và nội dung cơ bản</p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="p-8 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="notifySubscribers" class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                                <span class="ml-2 text-sm text-gray-700">Gửi thông báo cập nhật</span>
                            </label>
                        </div>
                        
                        <div class="flex space-x-4">
                            <button type="button" 
                                    class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transform hover:scale-105 transition-all duration-300">
                                Xem trước
                            </button>
                            <button type="button" onclick="saveDraft()"
                                    class="px-6 py-3 bg-yellow-500 text-white font-semibold rounded-xl hover:bg-yellow-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                Lưu nháp
                            </button>
                            <button type="submit" 
                                    class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Character counters
function setupCharacterCounter(inputId, counterId, maxLength = null) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    
    input.addEventListener('input', function() {
        const length = this.value.length;
        counter.textContent = length;
        
        if (maxLength && length > maxLength) {
            counter.parentElement.classList.add('text-red-500');
        } else {
            counter.parentElement.classList.remove('text-red-500');
        }
    });
}

// Image preview
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('uploadArea').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('featuredImage').value = '';
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('uploadArea').classList.remove('hidden');
}

// Format text functions
function formatText(command) {
    document.execCommand(command, false, null);
}

function insertList(type) {
    if (type === 'ul') {
        document.execCommand('insertUnorderedList', false, null);
    } else {
        document.execCommand('insertOrderedList', false, null);
    }
}

// Save draft
function saveDraft() {
    const formData = new FormData(document.getElementById('editNewsForm'));
    formData.append('status', 'draft');
    
    // Simulate save
    alert('Tin tức đã được lưu vào bản nháp!');
}

// Form validation and submission
document.getElementById('editNewsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Basic validation
    const title = document.getElementById('title').value;
    const category = document.getElementById('category').value;
    const excerpt = document.getElementById('excerpt').value;
    const content = document.getElementById('content').value;
    
    if (!title || !category || !excerpt || !content) {
        alert('Vui lòng điền đầy đủ các trường bắt buộc!');
        return;
    }
    
    // Simulate form submission
    const button = this.querySelector('button[type="submit"]');
    const originalText = button.textContent;
    button.textContent = 'Đang cập nhật...';
    button.disabled = true;
    
    setTimeout(() => {
        alert('Tin tức đã được cập nhật thành công!');
        button.textContent = originalText;
        button.disabled = false;
        // Redirect to news detail
        // window.location.href = '/tin-tuc/1';
    }, 2000);
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    setupCharacterCounter('title', 'titleCount', 100);
    setupCharacterCounter('excerpt', 'excerptCount', 300);
    setupCharacterCounter('content', 'contentCount');
    setupCharacterCounter('metaTitle', 'metaTitleCount', 60);
    setupCharacterCounter('metaDescription', 'metaDescCount', 160);
});
</script>
