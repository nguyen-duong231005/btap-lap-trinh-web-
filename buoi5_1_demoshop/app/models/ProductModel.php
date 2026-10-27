<?php
class ProductModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả sản phẩm
    public function getAll() {
        $query = "SELECT * FROM products ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin 1 sản phẩm theo ID
    public function getById($id) {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm mới sản phẩm
    public function create($name, $price, $stock, $description, $status) {
        $query = "INSERT INTO products (name, price, stock, description, status) VALUES (:name, :price, :stock, :description, :status)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':stock' => $stock,
            ':description' => $description,
            ':status' => $status
        ]);
    }

    // Cập nhật sản phẩm
    public function update($id, $name, $price, $stock, $description, $status) {
        $query = "UPDATE products SET name = :name, price = :price, stock = :stock, description = :description, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':price' => $price,
            ':stock' => $stock,
            ':description' => $description,
            ':status' => $status
        ]);
    }

    // Xóa sản phẩm
    public function delete($id) {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>