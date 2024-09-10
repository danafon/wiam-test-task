<?php
use yii\helpers\Html;

$this->title = 'Администрирование';

?>

<h1>Администрирование</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID изображения</th>
            <th>Решение</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($decisions as $decision): ?>
            <tr>
                <td>
                    <a href="https://picsum.photos/id/<?= $decision->image_id ?>/600/500" target="_blank">
                        <?= Html::encode($decision->image_id) ?>
                    </a>
                </td>
                <td><?= $decision->is_approved ? 'Одобрено' : 'Отклонено' ?></td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="deleteDecision(<?= $decision->id ?>)">
                        Отменить решение
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function deleteDecision(itemId) {
        if (confirm("Вы уверены, что хотите удалить этот элемент?")) {
            fetch(`/admin/${itemId}?token=<?= Yii::$app->request->get('token') ?>`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Ошибка при удалении элемента');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Ошибка при удалении элемента');
            });
        }
    }
</script>

