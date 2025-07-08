<?php

// show the list of users from NguoiDungController

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f8f9fa;
        }

        .btn {
            margin: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Danh sách người dùng</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($danhSachNguoiDung)): ?>
                    <?php foreach ($danhSachNguoiDung as $nguoiDung): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($nguoiDung->id); ?></td>
                            <td><?php echo htmlspecialchars($nguoiDung->name); ?></td>
                            <td><?php echo htmlspecialchars($nguoiDung->email); ?></td>
                            <td><?php echo htmlspecialchars($nguoiDung->role); ?></td>
                            <td>
                                <a href="?controller=NguoiDungController&action=show&id=<?php echo htmlspecialchars($nguoiDung->id); ?>"
                                    class="btn btn-primary">Xem</a>
                                <a href="?controller=NguoiDungController&action=edit&id=<?php echo htmlspecialchars($nguoiDung->id); ?>"
                                    class="btn btn-secondary">Sửa</a>
                                <form
                                    action="?controller=NguoiDungController&action=destroy&id=<?php echo htmlspecialchars($nguoiDung->id); ?>"
                                    method="POST" style="display:inline;">
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">Xóa</button>
                                </form>
                                <a href="?controller=NguoiDungController&action=create" class="btn btn-success">Thêm mới</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có người dùng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="?controller=NguoiDungController&action=create" class="btn btn-success">Thêm người dùng mới</a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
