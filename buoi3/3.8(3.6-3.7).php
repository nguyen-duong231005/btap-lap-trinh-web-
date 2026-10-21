<?php
$errors = [];
$success_msg = "";
$submitted_data = null; // Biến lưu thông tin sau khi gửi thành công

$data = [
    'name' => '',
    'email' => '',
    'subject' => '',
    'message' => '',
    'birthday' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu và gán vào mảng
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['subject'] = $_POST['subject'] ?? '';
    $data['message'] = trim($_POST['message'] ?? '');
    $data['birthday'] = $_POST['birthday'] ?? '';

    // 1. Kiểm tra họ tên không rỗng
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ tên.';
    }

    // 2. Kiểm tra email đúng định dạng
    if ($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ.';
    }

    // 3. Kiểm tra nội dung từ 10 đến 500 ký tự
    if (mb_strlen($data['message']) < 10 || mb_strlen($data['message']) > 500) {
        $errors['message'] = 'Nội dung phải từ 10 đến 500 ký tự.';
    }

    // 4. Kiểm tra ngày sinh không rỗng
    if ($data['birthday'] === '') {
        $errors['birthday'] = 'Vui lòng chọn ngày sinh.';
    }

    // 5. Xử lý Upload ảnh đại diện (với 3 kiểm tra bắt buộc: định dạng, kích thước, tính hợp lệ của ảnh)
    $avatar_path = "";
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES['avatar']['name']);
        $target_file = $target_dir . time() . "_" . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra 1: File có phải là hình ảnh thật không
        $check = getimagesize($_FILES['avatar']['tmp_name']);
        if ($check === false) {
            $errors['avatar'] = 'File tải lên không phải là hình ảnh.';
        } 
        // Kiểm tra 2: Định dạng mở rộng cho phép
        elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $errors['avatar'] = 'Chỉ chấp nhận các định dạng ảnh JPG, JPEG, PNG, GIF.';
        } 
        // Kiểm tra 3: Kích thước file (tối đa 2MB)
        elseif ($_FILES['avatar']['size'] > 2 * 1024 * 1024) {
            $errors['avatar'] = 'Kích thước ảnh phải nhỏ hơn 2MB.';
        } 
        else {
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
                $avatar_path = $target_file;
            } else {
                $errors['avatar'] = 'Đã xảy ra lỗi khi lưu file ảnh.';
            }
        }
    } else {
        $errors['avatar'] = 'Vui lòng chọn một ảnh đại diện.';
    }

    // Nếu không có lỗi nào, lưu thông tin vào $submitted_data để hiển thị
    if (empty($errors)) {
        $success_msg = "Gửi liên hệ thành công!";
        $submitted_data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'avatar' => $avatar_path
        ];
    }
}

function e($val) {
    return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f7f9fa; margin: 40px; }
        .container { max-width: 550px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin: auto; }
        h2 { text-align: center; color: #333; }
        p.subtitle { text-align: center; color: #666; font-size: 14px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #444; }
        input[type="text"], input[type="email"], input[type="date"], select, textarea {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        textarea { resize: vertical; height: 100px; }
        .error { color: #d9534f; font-size: 13px; margin-top: 5px; }
        .success { color: #5cb85c; text-align: center; font-weight: bold; margin-bottom: 20px; font-size: 18px; }
        button { width: 100%; padding: 12px; background: #2075c7; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background: #185a9d; }
        
        /* CSS cho phần hiển thị thông tin kết quả */
        .result-box { background: #eef9ff; border: 1px solid #bce8f1; padding: 20px; border-radius: 6px; margin-top: 20px; }
        .result-box h3 { margin-top: 0; color: #31708f; }
        .result-box img { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 2px solid #ccc; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Liên hệ</h2>
    
    <?php if (!empty($success_msg)): ?>
        <div class="success"><?php echo $success_msg; ?></div>
    <?php endif; ?>

    <!-- NẾU ĐÃ GỬI THÀNH CÔNG THÌ HIỂN THỊ KHỐI XEM LẠI THÔNG TIN -->
    <?php if ($submitted_data): ?>
        <div class="result-box">
            <h3>Xem lại thông tin đã gửi:</h3>
            <p><strong>Họ tên:</strong> <?php echo e($submitted_data['name']); ?></p>
            <p><strong>Email:</strong> <?php echo e($submitted_data['email']); ?></p>
            <p><strong>Ngày sinh:</strong> <?php echo e($submitted_data['birthday']); ?></p>
            <p><strong>Chủ đề:</strong> <?php echo e($submitted_data['subject']); ?></p>
            <p><strong>Nội dung:</strong> <?php echo nl2br(e($submitted_data['message'])); ?></p>
            <p><strong>Ảnh đại diện:</strong><br>
                <img src="<?php echo e($submitted_data['avatar']); ?>" alt="Ảnh đại diện">
            </p>
            <br>
            <a href="" style="display:inline-block; padding: 8px 15px; background:#6c757d; color:#fff; text-decoration:none; border-radius:4px;">Gửi liên hệ khác</a>
        </div>
    <?php else: ?>
        <!-- NẾU CHƯA GỬI HOẶC CÓ LỖI THÌ HIỂN THỊ FORM NHẬP -->
        <p class="subtitle">Vui lòng nhập đầy đủ thông tin bên dưới.</p>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Họ tên -->
            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" name="name" value="<?php echo e($data['name']); ?>">
                <?php if (isset($errors['name'])): ?>
                    <div class="error"><?php echo $errors['name']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo e($data['email']); ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="error"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Ngày/tháng/năm sinh -->
            <div class="form-group">
                <label>Ngày sinh</label>
                <input type="date" name="birthday" value="<?php echo e($data['birthday']); ?>">
                <?php if (isset($errors['birthday'])): ?>
                    <div class="error"><?php echo $errors['birthday']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Chủ đề -->
            <div class="form-group">
                <label>Chủ đề</label>
                <select name="subject">
                    <option value="Hỗ trợ kỹ thuật" <?php echo ($data['subject'] === 'Hỗ trợ kỹ thuật') ? 'selected' : ''; ?>>Hỗ trợ kỹ thuật</option>
                    <option value="Tư vấn dịch vụ" <?php echo ($data['subject'] === 'Tư vấn dịch vụ') ? 'selected' : ''; ?>>Tư vấn dịch vụ</option>
                    <option value="Góp ý phản hồi" <?php echo ($data['subject'] === 'Góp ý phản hồi') ? 'selected' : ''; ?>>Góp ý phản hồi</option>
                </select>
            </div>

            <!-- Nội dung -->
            <div class="form-group">
                <label>Nội dung</label>
                <textarea name="message" placeholder="Nhập nội dung liên hệ..."><?php echo e($data['message']); ?></textarea>
                <?php if (isset($errors['message'])): ?>
                    <div class="error"><?php echo $errors['message']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Upload ảnh đại diện -->
            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type="file" name="avatar">
                <?php if (isset($errors['avatar'])): ?>
                    <div class="error"><?php echo $errors['avatar']; ?></div>
                <?php endif; ?>
            </div>

            <button type="submit">Gửi liên hệ</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>