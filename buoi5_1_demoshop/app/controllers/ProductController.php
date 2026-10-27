<?php
require_once __DIR__ . '/../models/ProductModel.php';

class ProductController {
    private $productModel;

    public function __construct($db) {
        $this->productModel = new ProductModel($db);
    }

    // Hiển thị danh sách
    public function index() {
        $products = $this->productModel->getAll();
        include 'app/views/products/index.php';
    }

    // Thêm mới sản phẩm
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $stock = $_POST['stock'] ?? 0;
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? 'active';

            $this->productModel->create($name, $price, $stock, $description, $status);
            header("Location: index.php?controller=product&action=index");
            exit();
        }
        include 'app/views/products/create.php';
    }

    // Chỉnh sửa sản phẩm
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $stock = $_POST['stock'] ?? 0;
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? 'active';

            $this->productModel->update($id, $name, $price, $stock, $description, $status);
            header("Location: index.php?controller=product&action=index");
            exit();
        }
        include 'app/views/products/edit.php';
    }

    // Xóa sản phẩm (Dùng phương thức POST)
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $this->productModel->delete($id);
        }
        header("Location: index.php?controller=product&action=index");
        exit();
    }
}
?>