<?php
// Thực hiện các phép so sánh theo yêu cầu trong slide
$so_sanh_1 = (0 == "0");       // true
$so_sanh_2 = (0 === "0");      // false
$so_sanh_3 = (false == 0);     // true

// Hiển thị kết quả ra màn hình (sử dụng var_export hoặc toán tử điều kiện để in chữ true/false)
echo "0 == \"0\" kết quả là: " . ($so_sanh_1 ? 'true' : 'false') . "<br>";
echo "0 === \"0\" kết quả là: " . ($so_sanh_2 ? 'true' : 'false') . "<br>";
echo "false == 0 kết quả là: " . ($so_sanh_3 ? 'true' : 'false') . "<br>";
?>