<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <div style="width: 500px; margin: 20px auto;">
        <h2>Chỉnh sửa sản phẩm</h2>
        <form action="index.php?controller=product&action=edit&id=<?= isset($product['id']) ? $product['id'] : '' ?>" method="POST">
            <div style="margin-bottom: 10px;">
                <label>Tên sản phẩm:</label><br>
                <input type="text" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required style="width: 100%; padding: 5px;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Giá (VNĐ):</label><br>
                <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price'] ?? 0) ?>" required style="width: 100%; padding: 5px;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Số lượng tồn kho:</label><br>
                <input type="number" name="stock" value="<?= htmlspecialchars($product['stock'] ?? 0) ?>" required style="width: 100%; padding: 5px;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Mô tả:</label><br>
                <textarea name="description" rows="4" style="width: 100%; padding: 5px;"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
            </div>
            <div style="margin-bottom: 10px;">
                <label>Trạng thái:</label><br>
                <select name="status" style="width: 100%; padding: 5px;">
                    <option value="active" <?= (isset($product['status']) && $product['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= (isset($product['status']) && $product['status'] == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" style="padding: 10px 15px; background: blue; color: white; border: none; cursor: pointer;">Cập nhật</button>
            <a href="index.php?controller=product&action=index" style="margin-left: 10px;">Quay lại</a>
        </form>
    </div>
</body>
</html>