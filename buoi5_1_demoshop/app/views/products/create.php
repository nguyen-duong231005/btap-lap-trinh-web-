<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm mới</title>
</head>
<body>
    <div style="width: 500px; margin: 20px auto;">
        <h2>Thêm sản phẩm mới</h2>
        <form action="index.php?controller=product&action=create" method="POST">
            <div style="margin-bottom: 10px;">
                <label>Tên sản phẩm:</label><br>
                <input type="text" name="name" required style="width: 100%; padding: 5px;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Giá (VNĐ):</label><br>
                <input type="number" step="0.01" name="price" required style="width: 100%; padding: 5px;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Số lượng tồn kho:</label><br>
                <input type="number" name="stock" value="0" required style="width: 100%; padding: 5px;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Mô tả:</label><br>
                <textarea name="description" rows="4" style="width: 100%; padding: 5px;"></textarea>
            </div>
            <div style="margin-bottom: 10px;">
                <label>Trạng thái:</label><br>
                <select name="status" style="width: 100%; padding: 5px;">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" style="padding: 10px 15px; background: green; color: white; border: none; cursor: pointer;">Lưu sản phẩm</button>
            <a href="index.php?controller=product&action=index" style="margin-left: 10px;">Quay lại</a>
        </form>
    </div>
</body>
</html>