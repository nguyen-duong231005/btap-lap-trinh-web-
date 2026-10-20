<?php
$ket_qua = "";

// Xử lý khi người dùng nhập điểm và bấm nút Kiểm tra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diem = $_POST["diem"] ?? "";

    // Kiểm tra xem có phải là số hợp lệ từ 0 đến 10 hay không
    if (is_numeric($diem) && $diem >= 0 && $diem <= 10) {
        
        // Điều kiện xếp loại (sắp xếp từ cao xuống thấp theo hướng dẫn)
        if ($diem >= 8) {
            $ket_qua = "Giỏi";
        } elseif ($diem >= 6.5) {
            $ket_qua = "Khá";
        } elseif ($diem >= 5) {
            $ket_qua = "Trung bình";
        } else {
            $ket_qua = "Chưa đạt";
        }

        $thong_bao = "Điểm của bạn là $diem - Xếp loại: <strong>$ket_qua</strong>";
    } else {
        $thong_bao = "Vui lòng nhập một số hợp lệ từ 0 đến 10!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xếp loại học lực</title>
</head>
<body>
    <h3>Bài tập: Xếp loại điểm số</h3>
    
    <form method="POST" action="">
        <label for="diem">Nhập điểm số:</label>
        <input type="text" id="diem" name="diem" required>
        <button type="submit">Xếp loại</button>
    </form>

    <?php if (!empty($thong_bao)) { ?>
        <p style="margin-top: 15px;"><?php echo $thong_bao; ?></p>
    <?php } ?>
</body>
</html>