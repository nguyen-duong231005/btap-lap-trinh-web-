<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Quản lý CRUD cá nhân</h2>

    <!-- Form Thêm mới -->
    <form action="/personal/store" method="POST" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>

    <!-- Bảng hiển thị danh sách dữ liệu -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items) && is_array($items)): ?>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)($item['id'] ?? '')) ?></td>
                        <td><?= htmlspecialchars((string)($item['title'] ?? '')) ?></td>
                        <td><?= htmlspecialchars((string)($item['description'] ?? '')) ?></td>
                        <td>
                            <a href="/personal/delete/<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Không có dữ liệu nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>