<?php
namespace App\Controllers;

use App\Models\Review;
use App\Validation\ReviewValidator;

class ReviewController
{
    private $reviewModel;
    private $validator;

    public function __construct()
    {
        $this->reviewModel = new Review();
        $this->validator = new ReviewValidator();
    }

    public function index(): void
    {
        $reviews = $this->reviewModel->getAll();
        require __DIR__ . '/../Views/reviews/index.php';
    }

    public function listPartial(): void
    {
        $reviews = $this->reviewModel->getAll();
        require __DIR__ . '/../Views/reviews/_list.php';
    }

    public function add(): void
    {
        $validated = $this->validator->validateCreate($_POST);
        if (!$validated['ok']) {
            echo json_encode(['status' => 'error', 'message' => $validated['message']]);
            return;
        }

        $id = $this->reviewModel->create($validated['name'], $validated['comment']);
        echo json_encode([
            'status' => 'OK',
            'id' => $id,
            'name' => htmlspecialchars($validated['name']),
            'comment' => htmlspecialchars($validated['comment'])
        ]);
    }

    public function edit(): void
    {
        $validated = $this->validator->validateEdit($_POST);
        if (!$validated['ok']) {
            echo $validated['message'];
            return;
        }

        $ok = $this->reviewModel->update($validated['id'], $validated['name'], $validated['comment']);
        echo $ok ? 'OK' : 'Ошибка';
    }

    public function delete(): void
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id <= 0) {
            echo 'Неверный запрос';
            return;
        }

        $ok = $this->reviewModel->delete($id);
        echo $ok ? 'OK' : 'Ошибка';
    }
}

?>


