<?php
$title = isset($tinTuc) ? htmlspecialchars($tinTuc->tieu_de) . ' - Ocean Pearl Hotel' : 'Chi tiết tin tức - Ocean Pearl Hotel';
ob_start();
?>

<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50">
    <div class="container mx-auto px-4 py-8">
        
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex text-sm text-gray-600">
                <li><a href="/" class="hover:text-blue-600">Trang chủ</a></li>
                <li class="mx-2">/</li>
                <li><a href="/tin-tuc" class="hover:text-blue-600">Tin tức</a></li>
                <li class="mx-2">/</li>
                <li class="text-gray-800"><?= isset($tinTuc) ? htmlspecialchars($tinTuc->tieu_de) : 'Chi tiết tin tức' ?></li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <article class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <?php if (isset($tinTuc)): ?>
                        <?php if (!empty($tinTuc->hinh_anh)): ?>
                            <div class="h-64 bg-cover bg-center" style="background-image: url('<?= htmlspecialchars($tinTuc->hinh_anh) ?>');">
                                <div class="h-full bg-black bg-opacity-30 flex items-end">
                                    <div class="p-6 text-white">
                                        <h1 class="text-3xl font-bold mb-2"><?= htmlspecialchars($tinTuc->tieu_de) ?></h1>
                                        <div class="flex items-center text-sm">
                                            <span class="mr-4">
                                                <i class="fas fa-calendar mr-1"></i>
                                                <?= date('d/m/Y', strtotime($tinTuc->ngay_dang ?? date('Y-m-d'))) ?>
                                            </span>
                                            <span class="mr-4">
                                                <i class="fas fa-user mr-1"></i>
                                                <?= htmlspecialchars($tinTuc->tac_gia ?? 'Admin') ?>
                                            </span>
                                            <span>
                                                <i class="fas fa-eye mr-1"></i>
                                                <?= number_format($tinTuc->luot_xem ?? 0) ?> lượt xem
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="p-8 border-b">
                                <h1 class="text-3xl font-bold mb-4 text-gray-800"><?= htmlspecialchars($tinTuc->tieu_de) ?></h1>
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-4">
                                        <i class="fas fa-calendar mr-1"></i>
                                        <?= date('d/m/Y', strtotime($tinTuc->ngay_dang ?? date('Y-m-d'))) ?>
                                    </span>
                                    <span class="mr-4">
                                        <i class="fas fa-user mr-1"></i>
                                        <?= htmlspecialchars($tinTuc->tac_gia ?? 'Admin') ?>
                                    </span>
                                    <span>
                                        <i class="fas fa-eye mr-1"></i>
                                        <?= number_format($tinTuc->luot_xem ?? 0) ?> lượt xem
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="p-8">
                            <?php if (!empty($tinTuc->tom_tat)): ?>
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-6">
                                    <h4 class="font-semibold text-blue-800 mb-2">Tóm tắt:</h4>
                                    <p class="text-blue-700"><?= nl2br(htmlspecialchars($tinTuc->tom_tat)) ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="prose prose-lg max-w-none">
                                <?= nl2br(htmlspecialchars($tinTuc->noi_dung ?? 'Nội dung đang được cập nhật...')) ?>
                            </div>

                            <?php if (!empty($tinTuc->tags)): ?>
                                <div class="mt-8 pt-6 border-t">
                                    <h6 class="font-semibold mb-3">Tags:</h6>
                                    <div class="flex flex-wrap gap-2">
                                        <?php foreach (explode(',', $tinTuc->tags) as $tag): ?>
                                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm"><?= htmlspecialchars(trim($tag)) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="mt-8 pt-6 border-t">
                                <h6 class="font-semibold mb-3">Chia sẻ:</h6>
                                <div class="flex gap-2">
                                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                                        <i class="fab fa-facebook-f mr-1"></i> Facebook
                                    </a>
                                    <a href="#" class="bg-sky-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-sky-600">
                                        <i class="fab fa-twitter mr-1"></i> Twitter
                                    </a>
                                    <a href="#" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600">
                                        <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="p-8 text-center">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                                <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                                <h4 class="text-xl font-semibold text-yellow-800 mb-2">Không tìm thấy tin tức</h4>
                                <p class="text-yellow-700 mb-4">Tin tức bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
                                <a href="/tin-tuc" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-arrow-left mr-2"></i> Quay lại danh sách tin tức
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Tin tức liên quan</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <img src="https://via.placeholder.com/300x150/007bff/ffffff?text=Tin+tức+1" class="w-full h-24 object-cover rounded-lg mb-2" alt="Tin tức 1">
                            <h6 class="font-semibold text-sm mb-1">Khuyến mãi đặc biệt cuối năm</h6>
                            <p class="text-xs text-gray-600 mb-2">Giảm giá lên đến 30% cho tất cả các loại phòng...</p>
                            <a href="/tin-tuc/2" class="text-blue-600 text-xs hover:underline">Đọc thêm →</a>
                        </div>
                        <div class="border-b pb-4">
                            <img src="https://via.placeholder.com/300x150/28a745/ffffff?text=Tin+tức+2" class="w-full h-24 object-cover rounded-lg mb-2" alt="Tin tức 2">
                            <h6 class="font-semibold text-sm mb-1">Khai trương nhà hàng mới</h6>
                            <p class="text-xs text-gray-600 mb-2">Chúng tôi vui mừng giới thiệu nhà hàng cao cấp mới...</p>
                            <a href="/tin-tuc/3" class="text-blue-600 text-xs hover:underline">Đọc thêm →</a>
                        </div>
                        <div>
                            <img src="https://via.placeholder.com/300x150/ffc107/ffffff?text=Tin+tức+3" class="w-full h-24 object-cover rounded-lg mb-2" alt="Tin tức 3">
                            <h6 class="font-semibold text-sm mb-1">Sự kiện âm nhạc cuối tuần</h6>
                            <p class="text-xs text-gray-600 mb-2">Tham gia sự kiện âm nhạc đặc biệt tại khách sạn...</p>
                            <a href="/tin-tuc/4" class="text-blue-600 text-xs hover:underline">Đọc thêm →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/app.php';
?>
