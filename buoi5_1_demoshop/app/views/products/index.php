<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm</title>
</head>
<body>
    <div style="width: 800px; margin: 20px auto;">
        <h2>Danh sách Sản phẩm</h2>
        <a href="index.php?controller=product&action=create" style="padding: 5px 10px; background: green; color: white; text-decoration: none;">+ Thêm sản phẩm mới</a>
        
        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-top: 20px; border-collapse: collapse;">
            <thead>
                <tr style="background: #f2f2f2;">
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= number_format($row['price']) ?> VNĐ</td>
                        <td><?= htmlspecialchars($row['stock']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td>
                            <a href="index.php?controller=product&action=edit&id=<?= $row['id'] ?>">Sửa</a> |
                            <form action="index.php?controller=product&action=delete" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer; padding: 0; text-decoration: underline;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center;">Chưa có sản phẩm nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>