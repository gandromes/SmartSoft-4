<?php
namespace App\Validation;

class ReviewValidator
{
    private $maxNameLength = 50;
    private $maxTextLength = 250;

    public function validateCreate(array $data)
    {
        return $this->validateNameAndComment($data);
    }

    public function validateEdit(array $data)
    {
        $result = $this->validateNameAndComment($data);
        if (!$result['ok']) {
            return $result;
        }

        $id = isset($data['id']) ? (int)$data['id'] : 0;
        if ($id <= 0) {
            return [
                'ok' => false,
                'message' => 'Неверный запрос'
            ];
        }

        $result['id'] = $id;
        return $result;
    }

    private function validateNameAndComment(array $data)
    {
        $name = isset($data['name']) ? trim($data['name']) : '';
        $comment = isset($data['comment']) ? trim($data['comment']) : '';

        if ($name === '' || $comment === '') {
            return [
                'ok' => false,
                'message' => 'Заполните все поля'
            ];
        }

        if (mb_strlen($name) > $this->maxNameLength) {
            return [
                'ok' => false,
                'message' => 'Имя не должно превышать ' . $this->maxNameLength . ' символов'
            ];
        }

        if (mb_strlen($comment) > $this->maxTextLength) {
            return [
                'ok' => false,
                'message' => 'Отзыв не должен превышать ' . $this->maxTextLength . ' символов'
            ];
        }

        return [
            'ok' => true,
            'name' => $name,
            'comment' => $comment
        ];
    }
}

?>


