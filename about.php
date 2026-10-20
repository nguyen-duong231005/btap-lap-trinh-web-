<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu bản thân - Lập trình Web</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f4f4f9; color: #333; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #0056b3; }
        .project-list { list-style-type: none; padding: 0; }
        .project-item { background: #e9ecef; margin-bottom: 10px; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Giới thiệu bản thân</h1>
    <p><strong>Họ và tên:</strong> [Nguyễn Thùy Dương]</p>
    <p><strong>Lớp/Mã sinh viên:</strong> [224001715]</p>
    <p><strong>Giới thiệu:</strong> Là sinh viên lớp TUD D2024</p>

    <h2>Các dự án đã thực hiện</h2>
    <ul class="project-list">
        <li class="project-item">
            <h3>1. Ứng dụng Quản lý Câu lạc bộ Thể thao</h3>
            <p>Xây dựng hệ thống quản lý thành viên, lịch tập luyện,...</p>
        </li>
        <li class="project-item">
            <h3>2. Phần mềm quản lý thư viện</h3>
            <p>Xây dựng hệ thống quản lý độc giả, mượn, trả sách,...</p>
        </li>
        <li class="project-item">
            <h3>3. Phần mềm quản lý vận tải</h3>
            <p>Xây dựng hệ thống quản lý các đơn hàng, các phương tiện giao hàng,...</p>
        </li>
    </ul>

    <h2>Thông tin hệ thống học tập</h2>
    <p>Thời gian hiện tại xem trang: <?php echo date("d/m/Y H:i:s"); ?></p>
</div>

</body>
</html>