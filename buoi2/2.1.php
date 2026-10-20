<?php
// Gán giá trị
$x = "5";
$y = 5;

// In ra màn hình để nhìn thấy code/đề bài
echo "\$x = " . $x . ";<br>";
echo "\$y = " . $y . ";<br><hr>";

// In kiểu dữ liệu
echo "Kiểu dữ liệu của \$x là: " . gettype($x) . "<br>"; 
echo "Kiểu dữ liệu của \$y là: " . gettype($y) . "<br>"; 

// Tính tổng và in kết quả
$tong = $x + $y;
echo "Kết quả của \$x + \$y là: " . $tong; 
?>