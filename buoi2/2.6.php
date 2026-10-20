<?php
$ket_qua = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_tai_lieu = $_POST["ten_tai_lieu"] ?? "";
    
    // Lấy số lượng và ép kiểu số nguyên
    $so_luong = (int)($_POST["so_luong"] ?? 0);
    
    // Lấy đơn giá thô người dùng nhập
    $don_gia_raw = $_POST["don_gia"] ?? "0";
    
    // Tự động loại bỏ dấu chấm (.) và dấu phẩy (,) nếu người dùng lỡ nhập vào
    $don_gia_clean = str_replace(['.', ','], '', $don_gia_raw);
    $don_gia = (float)$don_gia_clean;

    // Tính tổng số tiền
    $tong_tien = $so_luong * $don_gia;

    // Định dạng số tiền hiển thị chuẩn tiếng Việt (ví dụ: 230.000 đ)
    $tong_tien_formatted = number_format($tong_tien, 0, ',', '.') . " đ";

    if (!empty($ten_tai_lieu)) {
        $ket_qua = htmlspecialchars($ten_tai_lieu) . " : " . $tong_tien_formatted;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tính tiền tài liệu</title>
</head>
<body>

    <form method="POST" action="">
        <input type="text" name="ten_tai_lieu" placeholder="Tên tài liệu" required>
        <!-- type="number" giúp xuất hiện nút bấm tăng/giảm số lượng -->
        <input type="number" name="so_luong" placeholder="Số lượng" min="1" value="1" required>
        <input type="text" name="don_gia" placeholder="Đơn giá" required>
        <button type="submit">Tính</button>
    </form>

    <br>

    <?php if (!empty($ket_qua)) { ?>
        <p><?php echo $ket_qua; ?></p>
    <?php } ?>

</body>
</html>