<?php
namespace App\Models;

use PDO;

class User extends Model
{
    // Заглушки для ТЗ. В проекте пока не используется, но структура предусмотрена
    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, name FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }
}

?>


