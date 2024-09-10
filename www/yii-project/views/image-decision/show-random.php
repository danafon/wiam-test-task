<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Vote for image';

?>

<?php if ($image !== null): ?>
  <div class="image-container">
      <img src="data:image/jpg;base64,<?= base64_encode($image) ?>" alt="Image not found. Please reload." />
  </div>
  <div class="buttons">
      <button id="accept-btn" class="btn btn-success">Одобрить</button>
      <button id="reject-btn" class="btn btn-danger">Отклонить</button>
  </div>
<?php else: ?>
    <h1>Дело сделано! Картинок больше нет.</h1>
<?php endif; ?>


<script>
    document.getElementById('accept-btn').addEventListener('click', function() {
        sendDecision(true);
    });

    document.getElementById('reject-btn').addEventListener('click', function() {
        sendDecision(false);
    });

    function sendDecision(isApproved) {
        fetch('<?= Url::to(['create']) ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: new URLSearchParams({
                'image_id': <?= Html::encode($imageId) ?>,
                'is_approved': isApproved
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('success');
                window.location.reload();
            } else {
                alert('Ошибка при сохранении решения.');
            }
        });
    }
</script>
