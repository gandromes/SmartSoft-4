<?php
namespace App\Models;

use PDO;

class Review extends Model
{
    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, name, comment FROM reviews ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name, string $comment): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO reviews (name, comment, address) VALUES (?, ?, ?)');
        $stmt->execute([trim($name), trim($comment), '']);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, string $name, string $comment): bool
    {
        $stmt = $this->pdo->prepare('UPDATE reviews SET name = ?, comment = ? WHERE id = ?');
        return $stmt->execute([trim($name), trim($comment), $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM reviews WHERE id = ?');
        return $stmt->execute([$id]);
    }
}

?>


