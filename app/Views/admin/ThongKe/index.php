<?php include_once '../layouts/admin.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Thống kê & Báo cáo</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Thống kê</li>
    </ol>

    <!-- Date Range Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Từ ngày</label>
                    <input type="date" class="form-control" id="start_date" value="<?= date('Y-m-01') ?>">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label">Đến ngày</label>
                    <input type="date" class="form-control" id="end_date" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-3">
                    <label for="time_period" class="form-label">Khoảng thời gian</label>
                    <select class="form-select" id="time_period">
                        <option value="today">Hôm nay</option>
                        <option value="week">Tuần này</option>
                        <option value="month" selected>Tháng này</option>
                        <option value="quarter">Quý này</option>
                        <option value="year">Năm này</option>
                        <option value="custom">Tùy chọn</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary" onclick="updateStats()">
                        <i class="fas fa-sync-alt"></i> Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Tổng doanh thu</div>
                            <div class="text-lg fw-bold">125,750,000 VNĐ</div>
                            <div class="text-white-75 small">
                                <i class="fas fa-arrow-up"></i> +12.5% so với tháng trước
                            </div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Số đặt phòng</div>
                            <div class="text-lg fw-bold">148</div>
                            <div class="text-white-75 small">
                                <i class="fas fa-arrow-up"></i> +8.3% so với tháng trước
                            </div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Tỷ lệ lấp đầy</div>
                            <div class="text-lg fw-bold">78.5%</div>
                            <div class="text-white-75 small">
                                <i class="fas fa-arrow-down"></i> -2.1% so với tháng trước
                            </div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-bed fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-75 small">Khách hàng mới</div>
                            <div class="text-lg fw-bold">67</div>
                            <div class="text-white-75 small">
                                <i class="fas fa-arrow-up"></i> +15.7% so với tháng trước
                            </div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Doanh thu theo thời gian
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Doanh thu theo loại phòng
                </div>
                <div class="card-body">
                    <canvas id="roomTypeChart" width="100%" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-crown me-1"></i>
                    Top 10 khách hàng VIP
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Tổng chi tiêu</th>
                                    <th>Số lần đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nguyễn Văn A</td>
                                    <td class="text-success fw-bold">12,500,000 VNĐ</td>
                                    <td>8</td>
                                </tr>
                                <tr>
                                    <td>Trần Thị B</td>
                                    <td class="text-success fw-bold">9,800,000 VNĐ</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td>Lê Văn C</td>
                                    <td class="text-success fw-bold">8,200,000 VNĐ</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Phạm Thị D</td>
                                    <td class="text-success fw-bold">7,650,000 VNĐ</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>Hoàng Văn E</td>
                                    <td class="text-success fw-bold">6,900,000 VNĐ</td>
                                    <td>3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-star me-1"></i>
                    Phòng được ưa chuộng nhất
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Loại phòng</th>
                                    <th>Số lượt đặt</th>
                                    <th>Tỷ lệ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Phòng Deluxe</td>
                                    <td>65</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" style="width: 65%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phòng Standard</td>
                                    <td>45</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phòng Suite</td>
                                    <td>38</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: 38%"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Statistics -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-concierge-bell me-1"></i>
                    Thống kê dịch vụ
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h4 class="text-info">2,450,000 VNĐ</h4>
                            <small class="text-muted">Doanh thu dịch vụ</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 class="text-warning">156</h4>
                            <small class="text-muted">Lượt sử dụng dịch vụ</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 class="text-success">Spa & Massage</h4>
                            <small class="text-muted">Dịch vụ phổ biến nhất</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 class="text-danger">4.8/5</h4>
                            <small class="text-muted">Điểm đánh giá trung bình</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-download me-1"></i>
            Xuất báo cáo
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Báo cáo có sẵn:</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-file-excel text-success"></i> <a href="#" onclick="exportExcel()">Xuất Excel - Doanh thu chi tiết</a></li>
                        <li><i class="fas fa-file-pdf text-danger"></i> <a href="#" onclick="exportPDF()">Xuất PDF - Báo cáo tổng hợp</a></li>
                        <li><i class="fas fa-file-csv text-info"></i> <a href="#" onclick="exportCSV()">Xuất CSV - Dữ liệu thô</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Lên lịch báo cáo tự động:</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="daily_report">
                        <label class="form-check-label" for="daily_report">
                            Báo cáo hàng ngày qua email
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="weekly_report">
                        <label class="form-check-label" for="weekly_report">
                            Báo cáo hàng tuần qua email
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="monthly_report" checked>
                        <label class="form-check-label" for="monthly_report">
                            Báo cáo hàng tháng qua email
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
        datasets: [{
            label: 'Doanh thu (triệu VNĐ)',
            data: [65, 78, 82, 85, 92, 88, 95, 102, 98, 105, 118, 125],
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Room Type Chart
const roomTypeCtx = document.getElementById('roomTypeChart').getContext('2d');
const roomTypeChart = new Chart(roomTypeCtx, {
    type: 'doughnut',
    data: {
        labels: ['Deluxe', 'Standard', 'Suite'],
        datasets: [{
            data: [45, 30, 25],
            backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 99, 132)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// Time period change handler
document.getElementById('time_period').addEventListener('change', function() {
    const customInputs = document.getElementById('start_date').parentElement.parentElement;
    if (this.value === 'custom') {
        customInputs.style.display = 'flex';
    } else {
        customInputs.style.display = 'none';
        // Auto set dates based on period
        const today = new Date();
        let startDate, endDate = today;
        
        switch(this.value) {
            case 'today':
                startDate = today;
                break;
            case 'week':
                startDate = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
                break;
            case 'month':
                startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                break;
            case 'quarter':
                const quarter = Math.floor(today.getMonth() / 3);
                startDate = new Date(today.getFullYear(), quarter * 3, 1);
                break;
            case 'year':
                startDate = new Date(today.getFullYear(), 0, 1);
                break;
        }
        
        document.getElementById('start_date').value = startDate.toISOString().split('T')[0];
        document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
    }
});

function updateStats() {
    // Implement statistics update logic here
    console.log('Updating statistics...');
}

function exportExcel() {
    // Implement Excel export
    alert('Đang xuất file Excel...');
}

function exportPDF() {
    // Implement PDF export
    alert('Đang xuất file PDF...');
}

function exportCSV() {
    // Implement CSV export
    alert('Đang xuất file CSV...');
}
</script>
