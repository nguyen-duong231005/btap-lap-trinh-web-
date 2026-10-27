<?php
// 1. Kết nối CSDL sử dụng PDO
$host = 'localhost';
$db_name = 'shopdemo';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    echo "Lỗi kết nối cơ sở dữ liệu: " . $exception->getMessage();
    exit();
}

// 2. Lấy thông tin điều hướng controller và action từ URL
$controllerName = $_GET['controller'] ?? 'product';
$actionName = $_GET['action'] ?? 'index';

// 3. Gọi Controller tương ứng
if ($controllerName === 'product') {
    require_once 'app/controllers/ProductController.php';
    $controller = new ProductController($db);
    
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        echo "Không tìm thấy hành động (action) này!";
    }
} else {
    echo "Không tìm thấy Controller này!";
}
?>