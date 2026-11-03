<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Controller;
use App\Repository\PersonalRepository;

final class PersonalController extends Controller
{
    public function __construct(private PersonalRepository $personalRepo)
    {
    }

    // Hiển thị danh sách CRUD cá nhân
    public function index(): void
    {
        $items = $this->personalRepo->all();
        $this->render('personal/index', [
            'items' => $items
        ]);
    }

    // Xử lý thêm mới dữ liệu
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            if ($title !== '' && $description !== '') {
                $this->personalRepo->create($title, $description);
            }
            
            header('Location: /personal');
            exit;
        }
    }

    // Xử lý xóa bản ghi theo ID
    public function delete(int $id): void
    {
        $this->personalRepo->delete($id);
        header('Location: /personal');
        exit;
    }
}