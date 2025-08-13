<?php
require_once __DIR__ . '/app/autoload.php';

use App\Controllers\ReviewController;

$controller = new ReviewController();
$controller->index();
?>