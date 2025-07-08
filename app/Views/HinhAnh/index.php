<?php include_once 'app/Views/layouts/app.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-cyan-500">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">
                        🖼️ Quản lý Hình ảnh
                    </h1>
                    <p class="text-gray-600">Quản lý thư viện hình ảnh của khách sạn</p>
                </div>
                <div class="flex space-x-3">
                    <button onclick="openUploadModal()" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tải lên hình ảnh
                    </button>
                    <button onclick="openBulkUploadModal()" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Tải nhiều file
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter and Search -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm hình ảnh..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <select id="categoryFilter" class="px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                    <option>Tất cả danh mục</option>
                    <option>Phòng nghỉ</option>
                    <option>Dịch vụ</option>
                    <option>Nhà hàng</option>
                    <option>Spa</option>
                    <option>Sự kiện</option>
                    <option>Khuyến mãi</option>
                </select>
                <select id="typeFilter" class="px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                    <option>Tất cả loại</option>
                    <option>JPG</option>
                    <option>PNG</option>
                    <option>GIF</option>
                    <option>WEBP</option>
                </select>
                <select id="sortBy" class="px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300">
                    <option>Mới nhất</option>
                    <option>Cũ nhất</option>
                    <option>Tên A-Z</option>
                    <option>Tên Z-A</option>
                    <option>Kích thước lớn</option>
                    <option>Kích thước nhỏ</option>
                </select>
            </div>
        </div>

        <!-- View Toggle -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Hiển thị:</span>
                <div class="flex bg-gray-100 rounded-lg p-1">
                    <button onclick="setView('grid')" id="gridView" class="px-3 py-2 text-sm rounded-md bg-cyan-500 text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button onclick="setView('list')" id="listView" class="px-3 py-2 text-sm rounded-md text-gray-600 hover:bg-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Đã chọn: <span id="selectedCount">0</span></span>
                <button onclick="deleteSelected()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors disabled:bg-gray-300" disabled id="deleteBtn">
                    Xóa đã chọn
                </button>
            </div>
        </div>

        <!-- Images Grid -->
        <div id="imageGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <!-- Image Card 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 image-card">
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=300&h=200&fit=crop" 
                         alt="Deluxe Room" class="w-full h-48 object-cover">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button onclick="viewImage(1)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button onclick="editImage(1)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button onclick="downloadImage(1)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Checkbox -->
                    <div class="absolute top-2 left-2">
                        <input type="checkbox" class="image-checkbox w-4 h-4 text-cyan-600 border-2 border-white rounded focus:ring-cyan-500" onchange="updateSelection()">
                    </div>
                    
                    <!-- Type Badge -->
                    <div class="absolute top-2 right-2">
                        <span class="bg-cyan-500 text-white px-2 py-1 rounded-full text-xs font-medium">JPG</span>
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-1 truncate">deluxe-room-view.jpg</h3>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span>1920×1080</span>
                        <span>2.5 MB</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Phòng nghỉ</span>
                        <span class="text-xs text-gray-500">15/12/2024</span>
                    </div>
                </div>
            </div>

            <!-- Image Card 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 image-card">
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=300&h=200&fit=crop" 
                         alt="Restaurant" class="w-full h-48 object-cover">
                    
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button onclick="viewImage(2)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button onclick="editImage(2)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button onclick="downloadImage(2)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="absolute top-2 left-2">
                        <input type="checkbox" class="image-checkbox w-4 h-4 text-cyan-600 border-2 border-white rounded focus:ring-cyan-500" onchange="updateSelection()">
                    </div>
                    
                    <div class="absolute top-2 right-2">
                        <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">PNG</span>
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-1 truncate">restaurant-dining.png</h3>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span>1600×900</span>
                        <span>3.1 MB</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs">Nhà hàng</span>
                        <span class="text-xs text-gray-500">14/12/2024</span>
                    </div>
                </div>
            </div>

            <!-- Image Card 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 image-card">
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=300&h=200&fit=crop" 
                         alt="Spa" class="w-full h-48 object-cover">
                    
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button onclick="viewImage(3)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <button onclick="editImage(3)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                            <button onclick="downloadImage(3)" class="p-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="absolute top-2 left-2">
                        <input type="checkbox" class="image-checkbox w-4 h-4 text-cyan-600 border-2 border-white rounded focus:ring-cyan-500" onchange="updateSelection()">
                    </div>
                    
                    <div class="absolute top-2 right-2">
                        <span class="bg-cyan-500 text-white px-2 py-1 rounded-full text-xs font-medium">JPG</span>
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-1 truncate">spa-wellness.jpg</h3>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span>1800×1200</span>
                        <span>4.2 MB</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">Spa</span>
                        <span class="text-xs text-gray-500">13/12/2024</span>
                    </div>
                </div>
            </div>

            <!-- More image cards... -->
        </div>

        <!-- List View (Hidden by default) -->
        <div id="imageList" class="hidden space-y-4">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center space-x-4">
                    <input type="checkbox" class="image-checkbox w-5 h-5 text-cyan-600 rounded focus:ring-cyan-500">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=100&h=80&fit=crop" 
                         alt="Image" class="w-20 h-16 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800">deluxe-room-view.jpg</h3>
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mt-1">
                            <span>1920×1080</span>
                            <span>2.5 MB</span>
                            <span>JPG</span>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Phòng nghỉ</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="p-2 text-gray-500 hover:text-cyan-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-500 hover:text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-500 hover:text-green-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3"/>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-500 hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
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
                <button class="px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">3</button>
                <button class="px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    Sau
                </button>
            </nav>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-cyan-100">Tổng hình ảnh</p>
                        <p class="text-3xl font-bold">1,247</p>
                    </div>
                    <svg class="w-12 h-12 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Dung lượng</p>
                        <p class="text-3xl font-bold">15.6 GB</p>
                    </div>
                    <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2z"/>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100">Tháng này</p>
                        <p class="text-3xl font-bold">156</p>
                    </div>
                    <svg class="w-12 h-12 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100">Danh mục</p>
                        <p class="text-3xl font-bold">12</p>
                    </div>
                    <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tải lên hình ảnh</h2>
            <button onclick="closeUploadModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center mb-6">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <label for="imageUpload" class="cursor-pointer">
                <span class="mt-2 block text-sm font-medium text-gray-900">Chọn file hoặc kéo thả</span>
                <span class="mt-2 block text-sm text-gray-500">PNG, JPG, GIF lên đến 10MB</span>
            </label>
            <input id="imageUpload" type="file" class="sr-only" accept="image/*" multiple>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500">
                    <option>Phòng nghỉ</option>
                    <option>Dịch vụ</option>
                    <option>Nhà hàng</option>
                    <option>Spa</option>
                    <option>Sự kiện</option>
                    <option>Khuyến mãi</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
                <textarea rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500" placeholder="Mô tả về hình ảnh..."></textarea>
            </div>
        </div>
        
        <div class="flex space-x-4 mt-6">
            <button onclick="closeUploadModal()" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                Hủy
            </button>
            <button class="flex-1 px-4 py-3 bg-cyan-500 text-white rounded-lg hover:bg-cyan-600">
                Tải lên
            </button>
        </div>
    </div>
</div>

<script>
// Modal functions
function openUploadModal() {
    document.getElementById('uploadModal').classList.remove('hidden');
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
}

function openBulkUploadModal() {
    // Open bulk upload modal (implement separately)
    alert('Chức năng tải nhiều file sẽ được cập nhật!');
}

// View toggle
function setView(viewType) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const imageGrid = document.getElementById('imageGrid');
    const imageList = document.getElementById('imageList');
    
    if (viewType === 'grid') {
        gridView.classList.add('bg-cyan-500', 'text-white');
        gridView.classList.remove('text-gray-600');
        listView.classList.add('text-gray-600');
        listView.classList.remove('bg-cyan-500', 'text-white');
        
        imageGrid.classList.remove('hidden');
        imageList.classList.add('hidden');
    } else {
        listView.classList.add('bg-cyan-500', 'text-white');
        listView.classList.remove('text-gray-600');
        gridView.classList.add('text-gray-600');
        gridView.classList.remove('bg-cyan-500', 'text-white');
        
        imageList.classList.remove('hidden');
        imageGrid.classList.add('hidden');
    }
}

// Selection management
function updateSelection() {
    const checkboxes = document.querySelectorAll('.image-checkbox:checked');
    const count = checkboxes.length;
    document.getElementById('selectedCount').textContent = count;
    document.getElementById('deleteBtn').disabled = count === 0;
}

function deleteSelected() {
    const checkboxes = document.querySelectorAll('.image-checkbox:checked');
    if (checkboxes.length > 0) {
        if (confirm(`Bạn có chắc muốn xóa ${checkboxes.length} hình ảnh đã chọn?`)) {
            // Simulate deletion
            alert('Đã xóa hình ảnh thành công!');
            updateSelection();
        }
    }
}

// Image actions
function viewImage(id) {
    alert(`Xem hình ảnh #${id}`);
}

function editImage(id) {
    alert(`Chỉnh sửa hình ảnh #${id}`);
}

function downloadImage(id) {
    alert(`Tải xuống hình ảnh #${id}`);
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const imageCards = document.querySelectorAll('.image-card');
    
    imageCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        if (title.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateSelection();
});
</script>
