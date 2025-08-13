<?php

require_once __DIR__ . '/../app/autoload.php';

use App\Controllers\ReviewController;

header('Content-Type: text/plain; charset=utf-8');

$controller = new ReviewController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'add') {
        header('Content-Type: application/json; charset=utf-8');
        $controller->add();
        exit;
    }

    if ($action === 'edit') {
        $controller->edit();
        exit;
    }

    if ($action === 'delete') {
        $controller->delete();
        exit;
    }

    echo 'Неверный запрос';
}

?>


