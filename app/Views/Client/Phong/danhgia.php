<?php
$title = 'Đánh giá phòng - Ocean Pearl Hotel';
ob_start();
?>

<div class="max-w-2xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-slate-900 mb-6">Đánh giá phòng <?= htmlspecialchars($phong->ten_phong ?? '') ?></h1>

    <?php if (isset($canReview) && $canReview): ?>
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Gửi đánh giá của bạn</h2>
            <form action="/phong/danhgia" method="POST">
                <input type="hidden" name="phong_id" value="<?= $phong->ma_phong ?>">
                <div class="mb-4">
                    <label for="rating" class="block font-medium mb-2">Chấm điểm:</label>
                    <select name="rating" id="rating" class="form-input w-full" required>
                        <option value="">Chọn điểm</option>
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <option value="<?= $i ?>"><?= $i ?> sao</option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="comment" class="block font-medium mb-2">Nhận xét:</label>
                    <textarea name="comment" id="comment" rows="4" class="form-input w-full" required></textarea>
                </div>
                <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-semibold">Gửi đánh giá</button>
            </form>
        </div>
    <?php else: ?>
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-8 text-yellow-800">
            <i class="fas fa-info-circle mr-2"></i>
            Bạn chỉ có thể đánh giá phòng sau khi đã trả phòng.
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Danh sách đánh giá</h2>
        <?php if (!empty($danhGias)): ?>
            <?php foreach ($danhGias as $danhGia): ?>
                <div class="border-b border-slate-200 py-4">
                    <div class="flex items-center mb-2">
                        <span class="font-bold text-blue-700 mr-2"><?= htmlspecialchars($danhGia->tai_khoan ?? 'Ẩn danh') ?></span>
                        <span class="text-yellow-500">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star<?= $i <= $danhGia->diem ? '' : '-o' ?>"></i>
                            <?php endfor; ?>
                        </span>
                        <span class="ml-4 text-xs text-slate-500"><?= date('d/m/Y H:i', strtotime($danhGia->created_at)) ?></span>
                    </div>
                    <div class="text-slate-700"><?= nl2br(htmlspecialchars($danhGia->nhan_xet)) ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-slate-500">Chưa có đánh giá nào cho phòng này.</div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
