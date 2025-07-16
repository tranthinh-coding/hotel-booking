<?php
$title = 'Liên hệ - Hotel Ocean';
ob_start();
?>

<!-- Contact Page Container with Unique Design -->
<div class="contact-page-wrapper relative min-h-screen">
    <!-- Background Design -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-purple-25 to-pink-50 overflow-hidden">
        <!-- Geometric Shapes -->
        <div class="geometric-bg">
            <div class="geo-shape geo-1"></div>
            <div class="geo-shape geo-2"></div>
            <div class="geo-shape geo-3"></div>
            <div class="geo-shape geo-4"></div>
        </div>
        
        <!-- Floating Particles -->
        <div class="particles-container">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
            <div class="particle particle-4"></div>
            <div class="particle particle-5"></div>
            <div class="particle particle-6"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-16">
        <!-- Header with Modern Design -->
        <div class="text-center mb-16 contact-header">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-6 shadow-xl">
                <i class="fas fa-comments text-white text-2xl"></i>
            </div>
            <h1 class="text-5xl font-bold bg-gradient-to-r from-indigo-700 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-6 contact-title">
                Kết nối với chúng tôi
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Đội ngũ tư vấn chuyên nghiệp của Hotel Ocean luôn sẵn sàng hỗ trợ bạn 24/7. 
                Hãy liên hệ để được tư vấn và trải nghiệm dịch vụ tốt nhất.
            </p>
            
            <!-- Contact Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 max-w-4xl mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-150 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-indigo-600 mb-2">< 1h</div>
                    <div class="text-gray-600">Thời gian phản hồi</div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-150 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-purple-600 mb-2">24/7</div>
                    <div class="text-gray-600">Hỗ trợ trực tuyến</div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-150 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-pink-600 mb-2">99%</div>
                    <div class="text-gray-600">Khách hàng hài lòng</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Contact Form - Takes 2 columns -->
            <div class="xl:col-span-2">
                <div class="contact-form-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-md p-8 border border-white/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-envelope text-white text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-700 to-purple-600 bg-clip-text text-transparent">
                            Gửi tin nhắn cho chúng tôi
                        </h2>
                    </div>

                    <form action="/contact" method="POST" class="space-y-6 contact-form">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group-modern">
                                <label for="ho_ten" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-user mr-2 text-indigo-500"></i> Họ và tên *
                                </label>
                                <input type="text" 
                                       id="ho_ten" 
                                       name="ho_ten" 
                                       value="<?= htmlspecialchars(old('ho_ten') ?? '') ?>"
                                       class="modern-input w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all duration-150 bg-gray-50/50 hover:bg-white"
                                       required
                                       placeholder="Nhập họ và tên của bạn">
                            </div>

                            <div class="form-group-modern">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-envelope mr-2 text-purple-500"></i> Email *
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="<?= htmlspecialchars(old('email') ?? '') ?>"
                                       class="modern-input w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all duration-150 bg-gray-50/50 hover:bg-white"
                                       required
                                       placeholder="Nhập địa chỉ email">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group-modern">
                                <label for="so_dien_thoai" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-phone mr-2 text-pink-500"></i> Số điện thoại
                                </label>
                                <input type="tel" 
                                       id="so_dien_thoai" 
                                       name="so_dien_thoai" 
                                       value="<?= htmlspecialchars(old('so_dien_thoai') ?? '') ?>"
                                       class="modern-input w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-100 transition-all duration-150 bg-gray-50/50 hover:bg-white"
                                       placeholder="Nhập số điện thoại">
                            </div>

                            <div class="form-group-modern">
                                <label for="chu_de" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-tag mr-2 text-emerald-500"></i> Chủ đề *
                                </label>
                                <select id="chu_de" 
                                        name="chu_de" 
                                        class="modern-input w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all duration-150 bg-gray-50/50 hover:bg-white"
                                        required>
                                    <option value="">Chọn chủ đề</option>
                                    <option value="dat_phong" <?= old('chu_de') === 'dat_phong' ? 'selected' : '' ?>>🏨 Đặt phòng</option>
                                    <option value="dich_vu" <?= old('chu_de') === 'dich_vu' ? 'selected' : '' ?>>🛎️ Dịch vụ</option>
                                    <option value="khieu_nai" <?= old('chu_de') === 'khieu_nai' ? 'selected' : '' ?>>⚠️ Khiếu nại</option>
                                    <option value="gop_y" <?= old('chu_de') === 'gop_y' ? 'selected' : '' ?>>💡 Góp ý</option>
                                    <option value="su_kien" <?= old('chu_de') === 'su_kien' ? 'selected' : '' ?>>🎉 Tổ chức sự kiện</option>
                                    <option value="khac" <?= old('chu_de') === 'khac' ? 'selected' : '' ?>>📝 Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label for="noi_dung" class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-comment mr-2 text-blue-500"></i> Nội dung tin nhắn *
                            </label>
                            <textarea id="noi_dung" 
                                      name="noi_dung" 
                                      rows="6"
                                      class="modern-input w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-150 bg-gray-50/50 hover:bg-white resize-none"
                                      required
                                      placeholder="Nhập nội dung tin nhắn của bạn. Hãy mô tả chi tiết để chúng tôi có thể hỗ trợ bạn tốt nhất..."><?= htmlspecialchars(old('noi_dung') ?? '') ?></textarea>
                        </div>

                        <!-- Privacy Checkbox -->
                        <div class="flex items-start p-4 bg-indigo-50/50 rounded-2xl border border-indigo-100">
                            <input type="checkbox" 
                                   id="dong_y_xu_ly" 
                                   name="dong_y_xu_ly" 
                                   value="1" 
                                   class="mt-1.5 w-5 h-5 rounded-lg border-2 border-indigo-300 text-indigo-500 focus:ring-indigo-500 focus:outline-none"
                                   required>
                            <label for="dong_y_xu_ly" class="ml-3 text-sm text-gray-700 leading-relaxed">
                                Tôi đồng ý để Hotel Ocean xử lý thông tin cá nhân của tôi để phản hồi yêu cầu này theo 
                                <a href="/privacy-policy" class="text-indigo-600 hover:text-indigo-700 underline font-semibold">Chính sách bảo mật</a> *
                            </label>
                        </div>

                        <button type="submit" 
                                class="modern-submit-btn w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white py-4 px-8 rounded-2xl font-bold text-lg transition-all duration-150 transform hover:scale-105 shadow-md relative overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-3"></i>
                                Gửi tin nhắn ngay
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-150"></div>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Information Sidebar -->
            <div class="space-y-6">
                <!-- Contact Details Card -->
                <div class="contact-info-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-md p-8 border border-white/30 hover:shadow-lg transition-all duration-150">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-info-circle text-white text-lg"></i>
                        </div>
                        <h2 class="text-xl font-bold bg-gradient-to-r from-emerald-700 to-teal-600 bg-clip-text text-transparent">
                            Thông tin liên hệ
                        </h2>
                    </div>

                    <div class="space-y-6">
                        <div class="contact-item flex items-start group hover:transform hover:scale-105 transition-all duration-150">
                            <div class="w-14 h-14 bg-gradient-to-r from-indigo-100 to-indigo-200 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:shadow-sm transition-all">
                                <i class="fas fa-map-marker-alt text-indigo-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Địa chỉ</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    123 Đường Trần Phú, Phường Lộc Thọ<br>
                                    Thành phố Nha Trang, Khánh Hòa<br>
                                    Việt Nam
                                </p>
                            </div>
                        </div>

                        <div class="contact-item flex items-start group hover:transform hover:scale-105 transition-all duration-150">
                            <div class="w-14 h-14 bg-gradient-to-r from-green-100 to-green-200 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:shadow-sm transition-all">
                                <i class="fas fa-phone text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Điện thoại</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    <a href="tel:+84123456789" class="hover:text-indigo-600 transition-colors font-semibold">Hotline: (+84) 123 456 789</a><br>
                                    <a href="tel:+84987654321" class="hover:text-purple-600 transition-colors font-semibold">Đặt phòng: (+84) 987 654 321</a>
                                </p>
                            </div>
                        </div>

                        <div class="contact-item flex items-start group hover:transform hover:scale-105 transition-all duration-150">
                            <div class="w-14 h-14 bg-gradient-to-r from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:shadow-sm transition-all">
                                <i class="fas fa-envelope text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Email</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    <a href="mailto:info@hotelocean.com" class="hover:text-indigo-600 transition-colors font-semibold">info@hotelocean.com</a><br>
                                    <a href="mailto:booking@hotelocean.com" class="hover:text-purple-600 transition-colors font-semibold">booking@hotelocean.com</a>
                                </p>
                            </div>
                        </div>

                        <div class="contact-item flex items-start group hover:transform hover:scale-105 transition-all duration-150">
                            <div class="w-14 h-14 bg-gradient-to-r from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:shadow-sm transition-all">
                                <i class="fas fa-clock text-purple-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Giờ làm việc</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    <span class="font-semibold text-indigo-600">Lễ tân:</span> 24/7<br>
                                    <span class="font-semibold text-purple-600">Văn phòng:</span> 8:00 - 22:00<br>
                                    <span class="font-semibold text-pink-600">Nhà hàng:</span> 6:00 - 23:00
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Card -->
                <div class="contact-info-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-md p-8 border border-white/30 hover:shadow-lg transition-all duration-150">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-share-alt text-white text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-r from-pink-700 to-rose-600 bg-clip-text text-transparent">
                            Kết nối với chúng tôi
                        </h3>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="#" class="social-link flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl hover:from-blue-100 hover:to-blue-200 transition-all duration-150 transform hover:scale-105 hover:shadow-sm">
                            <i class="fab fa-facebook-f text-blue-600 text-xl mr-3"></i>
                            <span class="text-gray-700 font-semibold">Facebook</span>
                        </a>
                        <a href="#" class="social-link flex items-center p-4 bg-gradient-to-r from-pink-50 to-pink-100 rounded-2xl hover:from-pink-100 hover:to-pink-200 transition-all duration-150 transform hover:scale-105 hover:shadow-sm">
                            <i class="fab fa-instagram text-pink-600 text-xl mr-3"></i>
                            <span class="text-gray-700 font-semibold">Instagram</span>
                        </a>
                        <a href="#" class="social-link flex items-center p-4 bg-gradient-to-r from-red-50 to-red-100 rounded-2xl hover:from-red-100 hover:to-red-200 transition-all duration-150 transform hover:scale-105 hover:shadow-sm">
                            <i class="fab fa-youtube text-red-600 text-xl mr-3"></i>
                            <span class="text-gray-700 font-semibold">YouTube</span>
                        </a>
                        <a href="#" class="social-link flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-2xl hover:from-green-100 hover:to-green-200 transition-all duration-150 transform hover:scale-105 hover:shadow-sm">
                            <i class="fab fa-tripadvisor text-green-600 text-xl mr-3"></i>
                            <span class="text-gray-700 font-semibold">TripAdvisor</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Map Section -->
        <div class="mt-16">
            <div class="map-section bg-white/90 backdrop-blur-xl rounded-3xl shadow-md overflow-hidden border border-white/30">
                <div class="p-8 border-b border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-map text-white text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold bg-gradient-to-r from-cyan-700 to-blue-600 bg-clip-text text-transparent">
                            Vị trí khách sạn
                        </h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Hotel Ocean tọa lạc tại vị trí đắc địa ngay trung tâm thành phố Nha Trang, 
                        chỉ cách bãi biển 50m và sân bay quốc tế Cam Ranh 30km. Hãy ghé thăm chúng tôi!
                    </p>
                </div>
                <div class="h-96 bg-gradient-to-br from-cyan-100 to-blue-100 flex items-center justify-center relative overflow-hidden">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2757.3035413869093!2d109.20266030684559!3d12.220083192456686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31706700768e164d%3A0x87faf37222cf7d07!2zMDMgSG_DoG5nIERp4buHdQ!5e0!3m2!1svi!2s!4v1752672587228!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <!-- Enhanced FAQ Section -->
        <div class="mt-16">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-amber-500 to-orange-600 rounded-full mb-6 shadow-md">
                    <i class="fas fa-question-circle text-white text-xl"></i>
                </div>
                <h2 class="text-4xl font-bold bg-gradient-to-r from-amber-700 via-orange-600 to-red-600 bg-clip-text text-transparent mb-4">
                    Câu hỏi thường gặp
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Tìm hiểu những thông tin hữu ích về dịch vụ và tiện ích tại Hotel Ocean
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="faq-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-sm p-8 border border-white/30 hover:shadow-md transition-all duration-150 transform hover:-translate-y-1">
                    <div class="flex items-start mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-bed text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">
                            Làm thế nào để đặt phòng?
                        </h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed pl-14">
                        Bạn có thể đặt phòng trực tuyến trên website, gọi hotline hoặc đến trực tiếp khách sạn. 
                        Chúng tôi chấp nhận thanh toán bằng tiền mặt, thẻ tín dụng và chuyển khoản.
                    </p>
                </div>

                <div class="faq-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-sm p-8 border border-white/30 hover:shadow-md transition-all duration-150 transform hover:-translate-y-1">
                    <div class="flex items-start mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-calendar-times text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">
                            Chính sách hủy phòng như thế nào?
                        </h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed pl-14">
                        Bạn có thể hủy phòng miễn phí trước 24 giờ. Hủy muộn hơn sẽ bị tính phí 1 đêm. 
                        Trong peak season, chính sách có thể khác nhau.
                    </p>
                </div>

                <div class="faq-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-sm p-8 border border-white/30 hover:shadow-md transition-all duration-150 transform hover:-translate-y-1">
                    <div class="flex items-start mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-plane text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">
                            Có dịch vụ đưa đón sân bay không?
                        </h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed pl-14">
                        Có, chúng tôi cung cấp dịch vụ đưa đón sân bay 24/7. Vui lòng đặt trước ít nhất 2 giờ 
                        để chúng tôi chuẩn bị phương tiện phù hợp.
                    </p>
                </div>

                <div class="faq-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-sm p-8 border border-white/30 hover:shadow-md transition-all duration-150 transform hover:-translate-y-1">
                    <div class="flex items-start mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-yellow-600 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-paw text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg">
                            Khách sạn có cho phép thú cưng không?
                        </h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed pl-14">
                        Chúng tôi cho phép thú cưng ở một số phòng nhất định với phí bổ sung. 
                        Vui lòng thông báo trước khi đặt phòng để được tư vấn.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Testimonials Section -->
        <div class="mt-20">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-rose-500 to-pink-600 rounded-full mb-6 shadow-md">
                    <i class="fas fa-heart text-white text-xl"></i>
                </div>
                <h2 class="text-4xl font-bold bg-gradient-to-r from-rose-700 via-pink-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Khách hàng nói gì về chúng tôi
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Những chia sẻ chân thật từ khách hàng đã trải nghiệm dịch vụ tại Hotel Ocean
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-sm p-6 border border-white/30 hover:shadow-md transition-all duration-150 transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="ml-2 text-sm text-gray-600">5.0/5</span>
                    </div>
                    <blockquote class="text-gray-700 mb-6 leading-relaxed italic">
                        "Dịch vụ tuyệt vời! Nhân viên rất thân thiện và chuyên nghiệp. Phòng sạch sẽ, view biển đẹp. Chắc chắn sẽ quay lại!"
                    </blockquote>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm">AN</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">Anh Nguyễn</div>
                            <div class="text-sm text-gray-600">Hà Nội</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-sm p-6 border border-white/30 hover:shadow-md transition-all duration-150 transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="ml-2 text-sm text-gray-600">5.0/5</span>
                    </div>
                    <blockquote class="text-gray-700 mb-6 leading-relaxed italic">
                        "Honeymoon tuyệt vời tại đây! Spa thư giãn, món ăn ngon. Nhân viên hỗ trợ nhiệt tình từ lúc check-in đến check-out."
                    </blockquote>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-red-600 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm">LH</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">Chị Linh</div>
                            <div class="text-sm text-gray-600">TP.HCM</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card bg-white/90 backdrop-blur-xl rounded-3xl shadow-sm p-6 border border-white/30 hover:shadow-md transition-all duration-150 transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="ml-2 text-sm text-gray-600">5.0/5</span>
                    </div>
                    <blockquote class="text-gray-700 mb-6 leading-relaxed italic">
                        "Vị trí hoàn hảo! Gần biển, gần trung tâm. Bể bơi đẹp, phòng gym đầy đủ thiết bị. Rất đáng tiền!"
                    </blockquote>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm">DT</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">Anh Tuấn</div>
                            <div class="text-sm text-gray-600">Đà Nẵng</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Why Choose Us Section -->
        <div class="mt-20">
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-12 text-white relative overflow-hidden">
                <!-- Background decoration -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full transform translate-x-32 -translate-y-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full transform -translate-x-24 translate-y-24"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold mb-6">
                            Tại sao chọn Hotel Ocean?
                        </h2>
                        <p class="text-xl text-white/80 max-w-3xl mx-auto">
                            Chúng tôi cam kết mang đến trải nghiệm khó quên với những ưu điểm vượt trội
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Vị trí đắc địa</h3>
                            <p class="text-white/80 leading-relaxed">
                                Ngay trung tâm Nha Trang, cách biển chỉ 50m
                            </p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-crown text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Dịch vụ 5 sao</h3>
                            <p class="text-white/80 leading-relaxed">
                                Đội ngũ chuyên nghiệp, phục vụ tận tâm 24/7
                            </p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-utensils text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Ẩm thực đẳng cấp</h3>
                            <p class="text-white/80 leading-relaxed">
                                Nhà hàng cao cấp với chef quốc tế
                            </p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-spa text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Spa & Wellness</h3>
                            <p class="text-white/80 leading-relaxed">
                                Trung tâm spa hiện đại, thư giãn tuyệt đối
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact CTA Section -->
        <div class="mt-20 text-center">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-md p-12 border border-white/30">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full mb-6 shadow-lg">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>
                <h2 class="text-4xl font-bold bg-gradient-to-r from-emerald-700 to-teal-600 bg-clip-text text-transparent mb-6">
                    Sẵn sàng trải nghiệm?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8 leading-relaxed">
                    Đội ngũ Hotel Ocean luôn sẵn sàng hỗ trợ bạn tạo nên những kỷ niệm khó quên. 
                    Hãy liên hệ ngay để được tư vấn chi tiết!
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:+84123456789" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-2xl font-bold text-lg transition-all duration-150 transform hover:scale-105 shadow-md">
                        <i class="fas fa-phone mr-3"></i>
                        Gọi ngay: (+84) 123 456 789
                    </a>
                    
                    <a href="/phong" 
                       class="inline-flex items-center px-8 py-4 bg-white border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-2xl font-bold text-lg transition-all duration-150 transform hover:scale-105">
                        <i class="fas fa-calendar-check mr-3"></i>
                        Đặt phòng ngay
                    </a>
                </div>
                
                <div class="mt-8 flex justify-center space-x-6 text-gray-500">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-emerald-600"></i>
                        <span class="text-sm">Bảo đảm giá tốt nhất</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-undo mr-2 text-emerald-600"></i>
                        <span class="text-sm">Hủy miễn phí</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2 text-emerald-600"></i>
                        <span class="text-sm">Hỗ trợ 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Contact Page Unique Styling */
.contact-page-wrapper {
    position: relative;
    overflow-x: hidden;
}

/* Geometric Background Animation */
.geometric-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

.geo-shape {
    position: absolute;
    opacity: 0.1;
    animation: float 20s ease-in-out infinite;
}

.geo-1 {
    width: 200px;
    height: 200px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-radius: 50% 20% 50% 20%;
    top: 10%;
    left: 5%;
    animation-delay: 0s;
}

.geo-2 {
    width: 150px;
    height: 150px;
    background: linear-gradient(45deg, #f093fb, #f5576c);
    border-radius: 20% 50% 20% 50%;
    top: 60%;
    right: 10%;
    animation-delay: 5s;
}

.geo-3 {
    width: 100px;
    height: 100px;
    background: linear-gradient(45deg, #4facfe, #00f2fe);
    border-radius: 30%;
    top: 30%;
    right: 30%;
    animation-delay: 10s;
}

.geo-4 {
    width: 120px;
    height: 120px;
    background: linear-gradient(45deg, #43e97b, #38f9d7);
    border-radius: 50% 10% 50% 10%;
    bottom: 20%;
    left: 20%;
    animation-delay: 15s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    25% {
        transform: translateY(-20px) rotate(90deg);
    }
    50% {
        transform: translateY(-10px) rotate(180deg);
    }
    75% {
        transform: translateY(-30px) rotate(270deg);
    }
}

/* Floating Particles */
.particles-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-radius: 50%;
    opacity: 0.6;
    animation: particle-float 15s linear infinite;
}

.particle-1 { left: 10%; animation-delay: 0s; }
.particle-2 { left: 20%; animation-delay: 2s; }
.particle-3 { left: 30%; animation-delay: 4s; }
.particle-4 { left: 70%; animation-delay: 6s; }
.particle-5 { left: 80%; animation-delay: 8s; }
.particle-6 { left: 90%; animation-delay: 10s; }

@keyframes particle-float {
    0% {
        transform: translateY(100vh) scale(0);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100px) scale(1);
        opacity: 0;
    }
}

/* Header Animations */
.contact-header {
    animation: fadeInUp 0.2s ease-out;
}

.contact-title {
    animation: slideInFromLeft 0.2s ease-out 0.1s both;
}

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

@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Form Styling */
.contact-form-card {
    animation: slideInFromRight 0.2s ease-out 0.15s both;
    backdrop-filter: blur(20px);
}

.form-group-modern {
    animation: staggerFadeIn 0.15s ease-out both;
}

.form-group-modern:nth-child(1) { animation-delay: 0.2s; }
.form-group-modern:nth-child(2) { animation-delay: 0.25s; }
.form-group-modern:nth-child(3) { animation-delay: 0.3s; }
.form-group-modern:nth-child(4) { animation-delay: 0.35s; }
.form-group-modern:nth-child(5) { animation-delay: 0.4s; }

@keyframes staggerFadeIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInFromRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Input Styling */
.modern-input {
    position: relative;
    transition: all 0.15s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.modern-input:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px -4px rgba(99, 102, 241, 0.15);
}

.modern-input:hover {
    transform: translateY(-0.5px);
    box-shadow: 0 2px 8px -2px rgba(99, 102, 241, 0.1);
}

/* Button Styling */
.modern-submit-btn {
    position: relative;
    overflow: hidden;
}

.modern-submit-btn:hover {
    box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.25);
}

.modern-submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.15s;
}

.modern-submit-btn:hover::before {
    left: 100%;
}

/* Contact Info Cards */
.contact-info-card {
    animation: slideInFromBottom 0.2s ease-out both;
    backdrop-filter: blur(20px);
}

.contact-info-card:nth-child(1) { animation-delay: 0.18s; }
.contact-info-card:nth-child(2) { animation-delay: 0.22s; }
.contact-info-card:nth-child(3) { animation-delay: 0.26s; }

@keyframes slideInFromBottom {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Contact Item Hover Effects */
.contact-item {
    transition: all 0.15s ease;
}

/* Social Links */
.social-link:hover {
    box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.08);
}

/* Quick Action Buttons */
.quick-action-btn {
    font-weight: 600;
    transition: all 0.15s ease;
}

.quick-action-btn:hover {
    box-shadow: 0 4px 12px -2px rgba(255, 255, 255, 0.2);
}

/* FAQ Cards */
.faq-card {
    animation: cardSlideIn 0.2s ease-out both;
}

.faq-card:nth-child(1) { animation-delay: 0.3s; }
.faq-card:nth-child(2) { animation-delay: 0.32s; }
.faq-card:nth-child(3) { animation-delay: 0.34s; }
.faq-card:nth-child(4) { animation-delay: 0.36s; }

@keyframes cardSlideIn {
    from {
        opacity: 0;
        transform: translateY(20px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Map Section */
.map-section {
    animation: zoomIn 0.2s ease-out 0.4s both;
}

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.98);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Animation Delays */
.animation-delay-1000 { animation-delay: 1s; }
.animation-delay-2000 { animation-delay: 2s; }

/* Responsive Design */
@media (max-width: 1024px) {
    .contact-form-card {
        animation: fadeInUp 0.15s ease-out 0.1s both;
    }
    
    .geo-shape {
        display: none; /* Hide geometric shapes on mobile for performance */
    }
}

@media (max-width: 768px) {
    .contact-title {
        font-size: 2.5rem;
    }
    
    .particles-container {
        display: none; /* Hide particles on mobile */
    }
}

/* Purple color variations */
.purple-25 {
    --tw-bg-opacity: 1;
    background-color: rgb(252 251 255 / var(--tw-bg-opacity));
}

/* Focus states - no black outline */
input:focus,
textarea:focus,
select:focus,
button:focus {
    outline: none !important;
}

/* Remove default focus rings */
*:focus {
    outline: none !important;
}

/* Minimal shadow utilities */
.shadow-xs {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
</style>

<script>
// Enhanced form interactions and animations
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initializeAnimations();
    
    // Enhanced form validation and interactions
    setupFormInteractions();
    
    // Parallax and scroll effects
    setupScrollEffects();
    
    // Interactive elements
    setupInteractiveElements();
});

function initializeAnimations() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    document.querySelectorAll('.contact-info-card, .faq-card, .map-section').forEach(el => {
        observer.observe(el);
    });
}

function setupFormInteractions() {
    const contactForm = document.querySelector('form[action="/contact"]');
    const noiDungTextarea = document.getElementById('noi_dung');
    const phoneInput = document.getElementById('so_dien_thoai');
    
    // Enhanced textarea auto-resize
    if (noiDungTextarea) {
        noiDungTextarea.addEventListener('input', function() {
            autoResize(this);
            
            // Character counter visual feedback
            const length = this.value.length;
            const maxLength = 1000;
            
            if (length > maxLength) {
                this.value = this.value.substring(0, maxLength);
                this.style.borderColor = '#f56565';
            } else if (length > maxLength * 0.8) {
                this.style.borderColor = '#ed8936';
            } else {
                this.style.borderColor = '';
            }
        });
    }
    
    // Enhanced phone number formatting
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            let value = this.value.replace(/[^\d+\s\-()]/g, '');
            
            // Auto-format Vietnamese phone numbers
            if (value.startsWith('0')) {
                value = value.replace(/^0/, '+84');
            }
            
            this.value = value;
        });
        
        // Add visual feedback
        phoneInput.addEventListener('blur', function() {
            if (this.value && !isValidPhone(this.value)) {
                this.style.borderColor = '#f56565';
                showTooltip(this, 'Số điện thoại không hợp lệ');
            } else {
                this.style.borderColor = '';
                hideTooltip(this);
            }
        });
    }
    
    // Enhanced form validation
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateContactForm()) {
                submitForm(this);
            }
        });
    }
    
    // Add real-time validation for all inputs
    document.querySelectorAll('.modern-input').forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('focus', function() {
            this.classList.add('focused');
            hideTooltip(this);
        });
        
        input.addEventListener('blur', function() {
            this.classList.remove('focused');
        });
    });
}

function setupScrollEffects() {
    // Parallax effect for background elements
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        // Move geometric shapes
        document.querySelectorAll('.geo-shape').forEach((shape, index) => {
            const speed = 0.3 + (index * 0.1);
            shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
        });
        
        // Parallax particles
        document.querySelectorAll('.particle').forEach((particle, index) => {
            const speed = 0.2 + (index * 0.05);
            particle.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

function setupInteractiveElements() {
    // Add hover effects to contact items
    document.querySelectorAll('.contact-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02) translateX(5px)';
            this.style.transition = 'all 0.15s ease';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) translateX(0)';
        });
    });
    
    // Enhanced social link interactions
    document.querySelectorAll('.social-link').forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) rotate(1deg)';
            this.style.transition = 'all 0.15s ease';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });
    
    // FAQ card interactions
    document.querySelectorAll('.faq-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px) scale(1.01)';
            this.style.transition = 'all 0.15s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
}

// Utility functions
function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

function isValidPhone(phone) {
    const phoneRegex = /^(\+84|84|0)[0-9]{8,9}$/;
    return phoneRegex.test(phone.replace(/[\s\-()]/g, ''));
}

function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let message = '';
    
    switch (field.type) {
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            isValid = emailRegex.test(value);
            message = 'Email không hợp lệ';
            break;
        case 'tel':
            isValid = !value || isValidPhone(value);
            message = 'Số điện thoại không hợp lệ';
            break;
        default:
            if (field.required) {
                isValid = value.length > 0;
                message = 'Trường này không được để trống';
            }
    }
    
    if (field.id === 'noi_dung' && value.length < 10 && value.length > 0) {
        isValid = false;
        message = 'Nội dung phải có ít nhất 10 ký tự';
    }
    
    if (isValid) {
        field.style.borderColor = '#10b981';
        field.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
        hideTooltip(field);
    } else if (value.length > 0 || field.required) {
        field.style.borderColor = '#f56565';
        field.style.boxShadow = '0 0 0 3px rgba(245, 101, 101, 0.1)';
        showTooltip(field, message);
    }
    
    return isValid;
}

function validateContactForm() {
    const form = document.querySelector('form[action="/contact"]');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    // Special validation for privacy checkbox
    const dongY = document.getElementById('dong_y_xu_ly');
    if (dongY && !dongY.checked) {
        isValid = false;
        showNotification('Vui lòng đồng ý với việc xử lý thông tin cá nhân', 'error');
    }
    
    return isValid;
}

function submitForm(form) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const btnText = submitBtn.querySelector('span');
    const originalText = btnText.textContent;
    
    // Show loading state
    submitBtn.disabled = true;
    btnText.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Đang gửi...';
    submitBtn.style.background = 'linear-gradient(to right, #6b7280, #9ca3af)';
    
    // Simulate form submission (replace with actual submission)
    setTimeout(() => {
        // Reset button state
        submitBtn.disabled = false;
        btnText.textContent = originalText;
        submitBtn.style.background = '';
        
        // Show success message
        showNotification('Tin nhắn đã được gửi thành công! Chúng tôi sẽ phản hồi trong vòng 24h.', 'success');
        
        // Reset form
        form.reset();
        
        // Reset all field styles
        form.querySelectorAll('.modern-input').forEach(input => {
            input.style.borderColor = '';
            input.style.boxShadow = '';
        });
    }, 2000);
}

function showTooltip(element, message) {
    hideTooltip(element);
    
    const tooltip = document.createElement('div');
    tooltip.className = 'field-tooltip absolute bg-red-500 text-white text-xs px-3 py-1 rounded-lg mt-1 z-10';
    tooltip.textContent = message;
    tooltip.style.fontSize = '12px';
    
    element.parentNode.style.position = 'relative';
    element.parentNode.appendChild(tooltip);
    
    // Position tooltip
    setTimeout(() => {
        const rect = element.getBoundingClientRect();
        const tooltipRect = tooltip.getBoundingClientRect();
        tooltip.style.left = '0px';
        tooltip.style.top = `${element.offsetHeight + 5}px`;
    }, 10);
}

function hideTooltip(element) {
    const tooltip = element.parentNode.querySelector('.field-tooltip');
    if (tooltip) {
        tooltip.remove();
    }
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-2xl max-w-sm transform translate-x-full transition-all duration-500 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-3 text-lg"></i>
            <span class="flex-1">${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(full)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 500);
    }, 5000);
}

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

// Add loading states to quick action buttons
document.querySelectorAll('.quick-action-btn').forEach(btn => {
    if (btn.href && btn.href.includes('tel:')) {
        btn.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
